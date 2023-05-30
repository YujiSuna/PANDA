<?php
$allAlunos = $cUsuario->getAllUser($categorized = true, $category = "aluno");
?>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/virtual-select-plugin@1.0.16/dist/virtual-select.min.css" integrity="sha256-umM1c7RyV/yt71xjIgPErO3PYajUHRxxvWJn+YRWSWw=" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/virtual-select-plugin@1.0.16/dist/virtual-select.min.js" integrity="sha256-6PuvJQXKao5OMgfl/WZUzznOvrd0J3hZcaT0XpJRDO0=" crossorigin="anonymous"></script>
</head>

<div id="alunoCardContent" class='cardContent mx-3'>
    <p class="title-cadastro col-12 m-0 d-none d-md-flex"><strong>Remover Aluno</strong></p>
    <form class="row col-12 m-0 needs-validation" id="alunoForm" novalidate>
        <div class="col-6">
            <div class="form-control">
                <label for="id_turma" class="form-label">Turma</label>
                <div id="id_turma"></div>
            </div>
        </div>

        <div class="col-6">
            <div class="form-control">
                <label for="id_aluno" class="form-label">Alunos</label>
                <div id="id_aluno"></div>
            </div>
        </div>

        <div class="col-12">
            <button class="btn btn-primary w-100 mt-2 submitBtn" type="submit">
                <h5>criar</h5>
            </button>
        </div>
    </form>
</div>

<script>
    var alunoElement = document.getElementById('alunoCardContent');
    var alunoHTML = alunoElement.outerHTML;
    setAJAXaluno();

    // Loop over them and prevent submission
    function setAJAXaluno() {
        alunoForm = document.getElementById('alunoForm');
        alunoForm.addEventListener('submit', function(event) {
            // console.log("alunoForm submit");
            event.preventDefault();
            event.stopPropagation();

            if (alunoForm.checkValidity()) {
                // console.log('entrou aluno');
                let data = new FormData(alunoForm);
                let page = "/PANDA/src/php/includes/ferramentas/ajaxPost/ajaxPostAluno.php";

                ajaxPOST(data, page, (answer) => {
                    if (answer.includes('true')) {
                        document.getElementById('turmaForm').classList.remove('was-validated');
                        redirectPageAluno();
                    } else {
                        console.error(answer);
                    }
                    // console.log(answer);
                });
            } else {
                console.error("alunoForm error");
                event.preventDefault();
                event.stopPropagation();
            }

            alunoForm.classList.add('was-validated');
        }, false);
        initVSaluno();
    }

    function redirectPageAluno() {
        let alunoCardContent = document.getElementById('alunoCardContent');
        let navTabContent = document.getElementById('nav-tabContent');
        redirectPage = "/PANDA/src/php/includes/ferramentas/cadastros/cadastrado/aluno-cadastrado.php";

        ajaxPOST(null, redirectPage, (answer) => {
            let origin = document.location.origin;
            let pathname = document.location.pathname;
            let search = document.location.search;
            let url = origin + pathname + search

            alunoCardContent.innerHTML = answer;
            navTabContent.style.backgroundColor = '#4dff4d';
            document.getElementById('otherAluno').addEventListener('click', () => {
                url = url + '#nav-2-tab';
                document.location = url;
                document.location.reload(true);
            });
            document.getElementById('goToTurma').addEventListener('click', () => {
                url = url + '#nav-1-tab';
                document.location = url;
                document.location.reload(true);
            });
        });
    }

    function initVSaluno() {
        VirtualSelect.init({
            ele: '#id_turma',
            name: 'id_turma',
            placeholder: 'selecione a turma',
            options: [
                <?php
                if (count($allTurmas) > 0) {
                    foreach ($allTurmas as $key => $turma) {
                        $value = intval($turma["id_turma"]);
                        $label = $turma['name_turma'];
                        echo "{ label: '$label', value: $value },";
                    }
                } else {
                    echo "{ label: 'nenhuma turma encontrada', value: '' }";
                }
                ?>
            ],
            search: true,
            keepAlwaysOpen: true,
        });

        VirtualSelect.init({
            ele: '#id_aluno',
            name: 'id_aluno',
            placeholder: 'selecione os alunos',
            options: [
                <?php
                if ($allAlunos) {
                    foreach ($allAlunos as $aluno) {
                        $label = $aluno['name'] . ' ' . $aluno['surname'];
                        $value = intval($aluno['id_user']);
                        echo "{ label: '$label', value: $value},";
                    }
                } else {
                    echo "{ label: 'nenhum aluno encontrado', value: '' },";
                }
                ?>
            ],
            multiple: true,
            keepAlwaysOpen: true,
        });

        inputs = document.getElementsByClassName('vscomp-hidden-input');
        for (const input of inputs) {
            input.classList.add('form-control');
            input.setAttribute('required', '');
        }
    }

    function ajaxPOST(data, page, func = false) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", page);
        // What to do when server responds
        xhr.onload = function() {
            let answer = this.response;

            if (func != false) {
                func(answer);
            } else {
                console.log("no function detected.");
            }
        };

        if (data != null) {
            xhr.send(data);
        } else {
            xhr.send();
        }
    }
</script>
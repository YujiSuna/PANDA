<?php
require_once '/xampp/htdocs/PANDA/src/php/class.php/Turma.class.php';
$cTurma = new Turma();
$allTurmas = $cTurma->getAllTurma();

$allProfessors = $cUsuario->getAllUser($categorized = true, $category = "professor", $item = "*");
?>

<!-- d-flex align-content-around flex-wrap -->
<div id="turmaCardContent" class='cardContent mx-3'>
    <p class="title-cadastro col-12 m-0 d-none d-md-flex"><strong>Remover Turma</strong></p>
    <form class="row col-12 m-0 needs-validation" id="turmaForm" novalidate>
        <div class="col-md-12 m-0">
            <label for="id_turma" class="form-label">Turma</label>
            <select class="form-select form-select-lg" name="id_turma" id="id_turma" required>
                <?php
                echo '<option selected disabled value="">Escolha turma</option>';
                if ($allTurmas) {
                    foreach ($allTurmas as $turma) {
                        $id_turma = $turma["id_turma"];
                        $name_turma = $turma['name_turma'];
                        echo "<option value='$id_turma'>$name_turma</option>";
                    }
                } else {
                    echo '<option disabled value="">nenhuma turma encontrado</option>';
                }
                ?>
            </select>
        </div>

        <div class="col-md-12 m-0">
            <button class="btn btn-primary w-100 mt-2 submitBtn" type="submit">
                <h5>Desativar esta turma</h5>
            </button>
        </div>
    </form>
</div>

<script>
    var turmaElement = document.getElementById('turmaCardContent');
    var turmaHTML = turmaElement.outerHTML;
    setAJAXturma();

    // Loop over them and prevent submission
    function setAJAXturma() {
        turmaForm = document.getElementById('turmaForm');
        turmaForm.addEventListener('submit', function(event) {
            console.log("turmaForm submit");

            event.preventDefault();
            event.stopPropagation();

            if (turmaForm.checkValidity()) {
                // console.log('entrou turma');
                let data = new FormData(turmaForm);
                let page = "/PANDA/src/php/includes/ferramentas/ajaxPost/desativaTarget.php";

                data.append('listedElement', 'turmas');
                data.append('id_target', data.get('id_turma'))

                ajaxPOST(data, page, (answer) => {
                    if (answer.includes('true')) {
                        document.getElementById('turmaForm').classList.remove('was-validated');
                        redirectPageTurma();
                    } else {
                        console.error(answer);
                    }
                });
            } else {
                console.error("turmaForm error");
                event.preventDefault();
                event.stopPropagation();
            }

            turmaForm.classList.add('was-validated');
        }, false)
    }

    function redirectPageTurma() {
        let turmaHTML = document.getElementById('turmaCardContent').outerHTML;
        let turmaCardContent = document.getElementById('turmaCardContent');
        let navTabContent = document.getElementById('nav-tabContent');
        redirectPage = "/PANDA/src/php/includes/ferramentas/cadastros/cadastrado/turma-cadastrado.php";

        ajaxPOST(null, redirectPage, (answer) => {
            let origin = document.location.origin;
            let pathname = document.location.pathname;
            let search = document.location.search;
            let url = origin + pathname + search

            turmaCardContent.innerHTML = answer;
            navTabContent.style.backgroundColor = '#4dff4d';
            document.getElementById('otherTurma').addEventListener('click', () => {
                turmaCardContent.outerHTML = turmaHTML;
                navTabContent.style.backgroundColor = 'white';
                setAJAXturma();
            });
            document.getElementById('goToAluno').addEventListener('click', () => {
                url = url + '#nav-2-tab';
                document.location = url;
                document.location.reload(true);
            });
        });
    }
</script>

<script>
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

    function teste() {
        alert('testando')
    }
</script>
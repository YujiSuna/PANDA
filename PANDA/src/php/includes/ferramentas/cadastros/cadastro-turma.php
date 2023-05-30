<?php
$allProfessors = $cUsuario->getAllUser($categorized = true, $category = "professor", $item = "*");
?>

<!-- d-flex align-content-around flex-wrap -->
<div id="turmaCardContent" class='cardContent mx-3'>
    <p class="title-cadastro col-12 m-0 d-none d-md-flex"><strong>cadastro-turma</strong></p>
    <form class="row col-12 m-0 needs-validation" id="turmaForm" novalidate>
        <div class="col-md-6 m-0">
            <label for="name_turma" class="form-label">Nome</label>
            <input type="text" class="form-control form-control-lg" name="name_turma" id="name_turma" placeholder="nome do curso" required>
        </div>
        <div class="col-md-6 m-0">
            <label for="id_professor" class="form-label">Professor</label>
            <select class="form-select form-select-lg" name="id_professor" id="id_professor" required>
                <?php
                if ($nivel != 0) {
                    $user = $cUsuario->getUser($id);
                    $name_user = $user['name'] . ' ' . $user['surname'];
                    echo "<option selected value='$id'>$name_user</option>";
                } else {
                    echo '<option selected disabled value="">Nome do Professor</option>';
                    if ($allProfessors) {
                        foreach ($allProfessors as $professor) {
                            $id_professor = $professor["id_user"];
                            $name_professor = $professor['name'] . ' ' . $professor['surname'];
                            echo "<option value='$id_professor'>$name_professor</option>";
                        }
                    } else {
                        echo '<option disabled value="">nenhum professor encontrado</option>';
                    }
                }
                ?>
            </select>
        </div>

        <div class="col-md-12 m-0">
            <label for="detalhe" class="form-label">Detalhe</label>
            <textarea class="form-control" name="detalhe" id="detalhe" style="resize:none" placeholder="detalhe(opcional)"></textarea>
        </div>

        <div class="col-md-12 m-0">
            <button class="btn btn-primary w-100 mt-2 submitBtn" type="submit">
                <h5>criar</h5>
            </button>
        </div>
    </form>

    <div class="mt-2 text-center">
        <a class="btn btn-outline-secondary" onclick="backHistory()" style="text-decoration: none;">
            <span>Voltar</span>
        </a>
    </div>
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
                console.log('entrou turma');
                let data = new FormData(turmaForm);
                let page = "/PANDA/src/php/includes/ferramentas/ajaxPost/ajaxPostTurma.php";

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
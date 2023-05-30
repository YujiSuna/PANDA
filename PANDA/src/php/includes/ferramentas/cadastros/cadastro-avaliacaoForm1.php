<?php
$allProfessors = $cUsuario->getAllUser(true, "professor");

?>
<!-- d-flex align-content-around flex-wrap -->
<div id="avaliacaoCardContent" class='cardContent mx-3'>
    <!-- <p class="title-cadastro col-12 m-0 d-none d-md-flex"><strong>cadastro-avaliacao</strong></p> -->
    <form class="row col-12 m-0 needs-validation" id="avaliacaoForm" novalidate>
        <div class="col-md-6 m-0">
            <label for="name_avaliacao" class="form-label">Titulo</label>
            <input type="text" class="form-control form-control-lg" name="name_avaliacao" id="name_avaliacao" placeholder="Ex: Avaliacao 2" required>

            <label for="dataAvaliacao" class="form-label">Titulo</label>
            <input type="date" class="form-control form-control-lg" name="dataAvaliacao" id="dataAvaliacao" required>
        </div>

        <div class="col-md-6 m-0">
            <label for="id_user" class="form-label">Professor</label>
            <select class="form-select form-select-lg" name="id_user" id="id_user" required>
                <?php
                if ($nivel != 0) {
                    $user = $pa->getUser($id)[0];
                    // echo '<script>console.log("' . $id . '")</script>';
                    echo '<option selected value="' . $id . '">' . $user['name'] . ' ' . $user['surname'] . '</option>';
                } else {
                    echo '<option selected disabled value="">Escolha...</option>';
                    if ($allProfessors) {
                        foreach ($allProfessors as $Professor) {
                            $id_professor = $Professor['id_user'];
                            $name_professor = $Professor['name'];
                            $surname_professor = $Professor['surname'];
                            echo "<option value='$id_professor'>$name_professor $surname_professor</option>";
                        }
                    } else {
                        echo '<option disabled value="">nenhum professor encontrado</option>';
                    }
                }
                ?>
            </select>

            <label for="tipo_avaliacao" class="form-label">Tipo de Avaliacao</label>
            <select class="form-select form-select-lg" name="tipo_avaliacao" id="tipo_avaliacao" required>
                <option disabled value="" selected>Escolha...</option>
                <option value="0">Avaliacao para uma Turma</option>
                <option value="1">Avaliacao para um Aluno</option>
            </select>
        </div>

        <div class="col-md-12 m-0">

            <label for="detalhe" class="form-label">Detalhe</label>
            <textarea required class="form-control" name="detalhe" id="detalhe" style="resize:none; min-height: 86.5%;" placeholder="detalhe sobre a avaliacao"></textarea>

            <div class="btn-toolbar mt-2 w-100 justify-content-between" role="group">
                <div class="btn-group me-2 text-center">
                    <a class="btn btn-outline-secondary" onclick="backHistory()" style="text-decoration: none;">
                        <h5 class="m-0 align-middle">Voltar</h5>
                    </a>
                </div>

                <div class="btn-group w-75">
                    <button class="btn btn-primary submitBtn" type="submit">
                        <h5 class="m-0 align-middle">Criar</h5>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    var avaliacaoElement = document.getElementById('avaliacaoCardContent');
    var avaliacaoHTML = avaliacaoElement.outerHTML;
</script>
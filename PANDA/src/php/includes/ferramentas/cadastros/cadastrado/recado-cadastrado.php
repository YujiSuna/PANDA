<?php
$tipo = intval($_POST['tipo']);
if ($tipo == 0 || $tipo == 1) {
    // echo 'tipo: ' . $tipo;
}
?>

<div id="recadoTurmaCardContent" class='cardContent mx-3'>
    <p class="title-cadastro col-12 m-0 d-none d-md-flex"><strong>cadastro-recado</strong></p>
    <form class="row col-12 m-0 needs-validation" id="recadoForm0" novalidate>
        <div class="col-6">
            <label for="id_recado" class="form-label">Recados</label>
            <div id="id_recado"></div>
        </div>

        <div class="col-6">
            <label for="id_turma" class="form-label">Turma</label>
            <div id="id_turma"></div>
        </div>

        <div class="col-12">
            <button class="btn btn-primary w-100 mt-2 submitBtn" type="submit">
                <h5>criar</h5>
            </button>
        </div>
    </form>
</div>
<?php $button = ($nivel_user == '2') ? 'Visualizar Avaliação' : 'Realizar Avaliação'; ?>

<div class="row m-0 p-0 g-0 pt-3">
    <div class="col-4 border-end ps-3">
        <p id="name_avaliacao" class="card-title text-center fs-1 fw-bold">nome da avaliacao</p>
        <span class="fs-5">Tipo da avaliacao:</span>
        <p id="tipo_avaliacao" class="fs-3 fw-bold"></p>
        <span class="fs-5">Professor:</span>
        <p id="name_professor" class="fs-3 fw-bold"></p>
        <span class="fs-5">Avaliado(s):</span>
        <p id="name_avaliados" class="fs-3 fw-bold"></p>
    </div>
    <div class="col-8 ps-5">
        <span class="fs-5">Detalhe:</span>
        <div class="scroll p-3">
            <p id="detalhe_avaliacao" class="text-break"></p>
        </div>
        <form action="/PANDA/src/php/pages/avaliacao.php" method="get">
            <input type="hidden" name="id_avaliacao" value="<?php echo $id_avaliacao; ?>">
            <div class="d-flex justify-content-between">
                <a href="/PANDA/src/php/pages/painel.php" class="btn btn-outline-secondary mt-2">voltar</a>
                <button class="btn btn-primary mt-2"><?php echo $button ?></button>
            </div>
        </form>
    </div>
</div>
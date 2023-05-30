<?php
switch ($nivel_user) {
    case '2':
        $textPergunta = '<h1>De qual data deseja visualizar sua presença?</h1>';
        $textButton1 = 'Visualizar';
        $textButton2 = 'Visualizar HOJE';
        break;

    default:
        $textPergunta = '<h1>De qual data deseja realizar chamada?</h1>';
        $textButton1 = 'Realizar Chamada';
        $textButton2 = 'Realizar Chamada de HOJE';
        break;
}
?>

<div class="row">
    <div class="col-12 d-flex justify-content-around align-items-center">
        <?php echo $textPergunta ?>
    </div>
</div>

<div class="div-table row">
    <form class="col-12 needs-validation" action="/PANDA/src/php/pages/turma.php" method="get" novalidate>
        <input type="hidden" name="turma_nav" id="inputTurmaNav" value="chamada">
        <input type="date" name="chamada_data" id="inputDate" class="form-control mt-2 col-6" required>
        <div class="invalid-feedback">
            Por favor selecione uma data.
        </div>
        <button class="btn btn-primary w-100 mt-2 col-6"><?php echo $textButton1 ?></button>
    </form>

    <form class="col-12" action="/PANDA/src/php/pages/turma.php" method="get">
        <input type="hidden" name="turma_nav" id="inputTurmaNav" value="chamada">
        <input type="hidden" name="chamada_data" id="inputDateNow" value="<?php echo $data ?>">
        <button class="btn btn-outline-primary w-100 mt-2"><?php echo $textButton2 ?></button>
    </form>
</div>

<script src="/PANDA/src/js/turma.chamada.js"></script>
<script>
    document.querySelector("#inputDate").focus();
    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation');

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                        document.querySelector("#inputDate").focus();
                    }

                    form.classList.add('was-validated');
                }, false)
            })
    })();
</script>
<?php
require_once '/xampp/htdocs/PANDA/src/php/class.php/Avaliacao.class.php';
$cAvaliacoes = new Avaliacao();
$avaliacoes = $cAvaliacoes->getAllAvaliacoesBy($id_turma, 'fk_id_destino', 1);
?>

<?php
if ($nivel_user == '2') {
    $textButton1 = 'Visualizar Avaliação';
}else{
    $textButton1 = 'Realizar Avaliação';
}
?>

<div class="div-table row">
    <div class="col-12">
        <input type="hidden" name="turma_nav" id="inputTurmaNav" value="avaliacao">
        <label for="data_avaliacao" class="h6">Filtro por data</label>
        <input type="month" name="data_avaliacao" id="inputDate" class="form-control mt-2 col-6">
    </div>

    <form class="col-12 needs-validation" action="/PANDA/src/php/pages/avaliacao.php" method="get" novalidate>
        <select name="id_avaliacao" id="selectAvaliacao" class="form-select  mt-2 col-6" required>
            <option selected disabled value="">Selecione uma avaliação</option>
            <?php
            foreach ($avaliacoes as $avaliacao) {
                $id_avaliacao = $avaliacao["id_avaliacao"];
                $name_avaliacao = $avaliacao["name_avaliacao"];
                $data_avaliacao = new DateTime($avaliacao["data_marcada"]);
                $data_avaliacao = $data_avaliacao->format('d/m/Y');
                echo "<option value='$id_avaliacao'>$data_avaliacao - $name_avaliacao</option>";
            }
            ?>
        </select>
        <div class="invalid-feedback">
            Por favor selecione uma avaliação.
        </div>
        <button class="btn btn-primary w-100 mt-2 col-6"><?php echo $textButton1?></button>
    </form>


    <!-- <form class="col-12" action="/PANDA/src/php/pages/turma.php" method="get">
        <input type="hidden" name="turma_nav" id="inputTurmaNav" value="chamada">
        <input type="hidden" name="chamada_data" id="inputDateNow" value="<?php echo $data ?>">
        <button class="btn btn-outline-primary w-100 mt-2">Ver todas as avas</button>
    </form> -->
</div>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/virtual-select-plugin@1.0.16/dist/virtual-select.min.css" integrity="sha256-umM1c7RyV/yt71xjIgPErO3PYajUHRxxvWJn+YRWSWw=" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/virtual-select-plugin@1.0.16/dist/virtual-select.min.js" integrity="sha256-6PuvJQXKao5OMgfl/WZUzznOvrd0J3hZcaT0XpJRDO0=" crossorigin="anonymous"></script>
</head>

<script src="/PANDA/src/js/turma.chamada.js"></script>
<script>
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
                    }

                    form.classList.add('was-validated');
                }, false)
            })
    })();
</script>
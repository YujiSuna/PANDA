<form class="row col-12 m-0 needs-validation" id="recadoForm1" novalidate>
    <div class="col-md-6 m-0">
        <label for="name_recado" class="form-label">Titulo</label>
        <input type="text" class="form-control form-control-lg" name="name_recado" id="name_recado" placeholder="Ex: Sobre Proxima Aula" required>

        <label for="id_professor" class="form-label">Professor</label>
        <select class="form-select form-select-lg" name="id_professor" id="id_professor" required>
            <?php
            if ($nivel != 0) {
                $user = $pa->getUser($id)[0];
                // echo '<script>console.log("' . $id . '")</script>';
                echo '<option selected value="' . $id . '">' . $user['name'] . ' ' . $user['surname'] . '</option>';
            } else {
                echo '<option selected disabled value="">Escolha...</option>';
                if ($allProfessors) {
                    foreach ($allProfessors as $Professor) {
                        $id_professor = $Professor["id_user"];
                        $name_professor = $Professor['name'] . " " . $Professor["surname"];
                        echo "<option value='$id_professor'>$name_professor</option>";
                    }
                } else {
                    echo '<option disabled value="">nenhum professor encontrado</option>';
                }
            }
            ?>
        </select>

        <label for="tipo_recado" class="form-label">Tipo de Recado</label>
        <select class="form-select form-select-lg" name="tipo_recado" id="tipo_recado" required>
            <option disabled value="" selected>Escolha...</option>
            <option value="1">Recado para uma Turma</option>
            <option value="2">Recado para um Aluno</option>
        </select>
    </div>

    <div class="col-md-6 m-0">
        <label for="mensagem" class="form-label">Mensagem</label>
        <textarea required class="form-control" name="mensagem" id="mensagem" style="resize:none; min-height: 86.5%;" placeholder="mensagem"></textarea>
    </div>

    <div class="col-md-6 m-0">
        <label for="dateMarcado" class="form-label">Data Marcado</label>
        <input type="date" class="form-control" name="dateMarcado" id="dateMarcado" value="<?php echo date('Y-m-d'); ?>" required></input>
    </div>

    <div class="col-md-6 m-0">
        <label for="" class="form-label"></label>
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
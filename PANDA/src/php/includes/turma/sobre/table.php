<div class="row">
    <div class="col-12 mt-2  d-flex justify-content-start align-items-center">
        <p class="m-0 fs-5" id="name_professor">Professor: </p>
    </div>

    <div class="col-12 mt-2  d-flex justify-content-start align-items-center">
        <p class="m-0 fs-5" id="num_alunos">N° de alunos: </p>
    </div>

    <div class="col-12 mt-2 d-flex flex-column align-items-start">
        <p class="m-0 fs-5">Detalhe: </p>
        <div class="scroll p-3">
            <p id="detalhe_turma" class="text-break"></p>
        </div>
    </div>
</div>

<script src="/PANDA/src/js/turma.sobre.js"></script>
<script>
    window.onload = setTurmaSobreInfo(prof, numAlunos, turma);
</script>
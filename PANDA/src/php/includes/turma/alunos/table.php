<div class="row">
    <div class="col-12 d-flex justify-content-center align-items-center">
        <p class="m-0 mx-5 fs-1 fw-bolder text-break text-center text-md-center">Alunos</p>
    </div>
</div>

<div class="div-table">
    <table class="table recados table-hover table-bordered m-0">
        <thead>
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">Sobrenome</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<script src="/PANDA/src/js/turma.alunos.js"></script>
<script>
    // criando lista de Alunos
    window.addEventListener("load", () => {
        setListaAlunos(alunos);
    });
</script>
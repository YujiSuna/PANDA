<div class="row">
    <div class="col-12 d-flex justify-content-center align-items-center">
        <p class="m-0 mx-5 fs-1 fw-bolder text-break text-center text-md-center">Recados</p>
    </div>
</div>

<div class="div-table">
    <table class="table recados table-hover table-bordered m-0">
        <thead>
            <tr>
                <th scope="col">Titulo</th>
                <th scope="col">Mensagem</th>
                <th scope="col" class="d-none d-md-table-cell">Data Criado</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<div class="d-none d-flex justify-content-center">
    <p class="fw-bold">Nenhum Recado associado a esta turma.</p>
</div>

<script src="/PANDA/src/js/turma.recados.js"></script>
<script>
    // criando lista de Recados
    window.addEventListener("load", () => {
        if (!setListaRecados(recados)) {
            $(".d-none").removeClass("d-none");
            $(".div-table").addClass("d-none");
        }
    });
</script>
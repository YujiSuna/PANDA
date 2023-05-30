<div class="row">
    <div class="col-12 d-flex justify-content-around align-items-center">
        <a datahref="<?php echo $previousDate ?>" class="previous triangle triangle-left"></a>
        <p class="m-0 fs-1 fw-bolder text-break text-center text-md-center"><?php echo $currentDate ?></p>
        <a datahref="<?php echo $nextDate ?>" class="next triangle triangle-right"></a>
    </div>
</div>

<div class="div-table">
    <table class="table presenca table-hover table-bordered m-0">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Presença</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

    <div class="d-flex justify-content-between">
        <button class="btn btn-outline-secondary w-25 mt-2" onclick="backToCalendar()">voltar</button>
        <button class="btn btn-primary w-25 mt-2" onclick="backToCalendar()">salvar</button>
    </div>
</div>

<script src="/PANDA/src/js/turma.chamada.js"></script>
<script>
    console.log(window.location.search.split('=')[0].slice(1));
    // criando lista de presenca
    window.addEventListener("load", () => {
        setListaPresenca(alunos);
        let triangles = document.getElementsByClassName("triangle");
        for (const triangle of triangles) {
            triangle.addEventListener("click", (event) => {
                event.preventDefault();
                let datahref = triangle.getAttribute("datahref");
                let wl = window.location;

                let form = document.createElement("form");
                form.action = wl.pathname.split("/").pop();

                let input = document.createElement("input");
                input.name = "chamada_data";
                input.value = datahref;

                let input2 = document.createElement("input");
                input2.name = "turma_nav";
                input2.value = "chamada";

                document.body.append(form);
                form.append(input2);
                form.append(input);
                form.submit();
            });
        }
    });
</script>

<style>
    .triangle {
        width: 0;
        height: 0;
        border-style: solid;
    }

    .triangle-left {
        border-width: 12.5px 21.7px 12.5px 0;
        border-color: transparent #000000 transparent transparent;
    }

    .triangle-right {
        border-width: 12.5px 0 12.5px 21.7px;
        border-color: transparent transparent transparent #000000;
    }

    .triangle-left:hover {
        border-color: transparent #D1D1D1 transparent transparent;
    }

    .triangle-right:hover {
        border-width: 12.5px 0 12.5px 21.7px;
        border-color: transparent transparent transparent #D1D1D1;
    }
</style>
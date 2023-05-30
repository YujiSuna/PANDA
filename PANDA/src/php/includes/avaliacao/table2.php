<?php $buttonSalvarDisplay = ($nivel_user == '2') ? 'd-none' : ''; ?>

<div class="div-table">
    <table class="table presenca table-hover table-bordered m-0">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col" class="w-0">Aprovação</th>
                <th scope="col" class="w-0">Falta</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

    <div class="d-flex justify-content-between">
        <button class="btn btn-outline-secondary w-25 mt-2" onclick="backHistory()">voltar</button>
        <button class="btn btn-primary w-25 mt-2 <?php echo $buttonSalvarDisplay?>" onclick="backHistory()">salvar</button>
    </div>
</div>

<script>
    window.onload = setListaAvaliados(alunos);

    if (<?php echo $nivel_user ?> == '2') {
        for (const input of $('.form-check-input')) {
            input.disabled = true;
        }
    }

    function checkInput(input) {
        input.checked = !input.checked;
    }

    function setListaAvaliados(alunos) {
        alunos.sort((a, b) => {
            if (a.name > b.name) {
                return 1;
            }
            if (a.name < b.name) {
                return -1;
            }
            // a must be equal to b
            return 0;
        });

        for (let i = 0; i < alunos.length; i++) {
            let aluno = alunos[i];
            let alunoName = aluno.name + ' ' + aluno.surname;
            let tr = document.createElement("tr");
            let th = document.createElement("th");
            let td1 = document.createElement("td");
            let td2 = document.createElement("td");
            let td3 = document.createElement("td");
            let div1 = document.createElement("div");
            let div2 = document.createElement("div");
            let input1 = document.createElement("input");
            let input2 = document.createElement("input");

            tr.className = "tr-avaliacao";
            th.setAttribute("scope", "row");
            th.className = "text-center";
            th.innerText = i + 1;
            td1.innerText = alunoName;
            td2.className = "td-avaliacao";
            td3.className = "td-avaliacao";

            div1.classList.add("form-check");
            div1.classList.add("form-switch");
            div1.classList.add("d-flex");
            div1.classList.add("justify-content-center");

            div2.classList.add("form-check");
            div2.classList.add("form-switch");
            div2.classList.add("d-flex");
            div2.classList.add("justify-content-center");

            input1.className = "form-check-input";
            input1.setAttribute("type", "checkbox");
            input1.setAttribute("name", "aprovacao");
            input1.setAttribute("id_user", aluno.id_user);
            input1.setAttribute("id_avaliacao", aluno.id_avaliacao);

            input2.className = "form-check-input";
            input2.setAttribute("type", "checkbox");
            input2.setAttribute("name", "falta");
            input2.setAttribute("id_user", aluno.id_user);
            input2.setAttribute("id_avaliacao", aluno.id_avaliacao);

            input1.checked = aluno.avaliacao_log.aprovado == "1";
            input2.checked = aluno.avaliacao_log.falta == "1";

            if (input2.checked) {
                input1.checked = false;
                input1.disabled = true;
            } else {
                input1.disabled = false;
            }

            input1.addEventListener("click", (event) => {
                updateAvaliacaoLog(aluno, input1, input2);
            });

            input2.addEventListener("click", (event) => {
                if (input2.checked) {
                    input1.checked = false;
                    input1.disabled = true;
                } else {
                    input1.disabled = false;
                }
                updateAvaliacaoLog(aluno, input1, input2);
            });

            document.getElementsByTagName("tbody")[0].append(tr);
            tr.append(th);
            tr.append(td1);
            tr.append(td2);
            tr.append(td3);
            td2.append(div1);
            td3.append(div2);
            div1.append(input1);
            div2.append(input2);
        }
    }

    // atualizando presenca no banco com XMLHttpRequest pelo /includes/.../update.php
    function updateAvaliacaoLog(aluno, input1, input2) {
        let xhr = new XMLHttpRequest();
        let data = new FormData();
        let newValue1 = input1.checked ? 1 : 0;
        let newValue2 = input2.checked ? 1 : 0;

        data.append("id_user", aluno.id_user);
        data.append("id_avaliacao", aluno.id_avaliacao);
        data.append("aprovacao", newValue1);
        data.append("falta", newValue2);

        xhr.open("POST", "/PANDA/src/php/includes/avaliacao/update.php");
        xhr.responseType = "json";

        xhr.onload = function() {
            let answerAprovacao = this.response;
            console.log(answerAprovacao);
            if (answerAprovacao != null) {
                console.log("Success");
            } else {
                console.error("Not success");
            }
        };

        xhr.send(data);
    }

    function backHistory() {
        location.href = "/PANDA/src/php/pages/avaliacao.php";
    }
</script>
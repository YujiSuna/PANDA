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

<script>
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
            let div = document.createElement("div");
            let input = document.createElement("input");

            tr.className = "tr-avaliacao";
            th.setAttribute("scope", "row");
            th.className = "text-center";
            th.innerText = i + 1;
            td1.innerText = alunoName;
            td2.className = "td-avaliacao";
            div.classList.add("form-check");
            div.classList.add("form-switch");
            input.className = "form-check-input";
            input.setAttribute("type", "checkbox");
            input.setAttribute("name", "avaliacao");
            input.setAttribute("date", aluno.date);
            input.setAttribute("id_user", aluno.id_user);
            input.setAttribute("id_avaliacao", id_avaliacao);

            aluno.presenca == "1" ? checkInput(input) : false;

            input.addEventListener("click", (event) => {
                event.preventDefault();
                updatePresenca(aluno, input);
            });

            document.getElementsByTagName("tbody")[0].append(tr);
            tr.append(th);
            tr.append(td1);
            tr.append(td2);
            td2.append(div);
            div.append(input);
        }
    }

    // atualizando presenca no banco com XMLHttpRequest pelo /includes/.../update.php
    function updatePresenca(aluno, input) {
        let xhr = new XMLHttpRequest();
        let data = new FormData();
        let newPresenca = input.checked ? 1 : 0;

        data.append("date", aluno.date);
        data.append("id_user", aluno.id_user);
        data.append("id_avaliacao", aluno.id_avaliacao);
        data.append("presenca", newPresenca);

        xhr.open("POST", "/PANDA/src/php/includes/turma/chamada/update.php");
        xhr.responseType = "json";

        xhr.onload = function() {
            let answerPresenca = this.response;
            console.log(answerPresenca);
            let inputs = document.querySelectorAll(".form-check-input");
            for (let input of inputs) {
                let date = input.getAttribute("date");
                let id_user = input.getAttribute("id_user");
                let id_avaliacao = input.getAttribute("id_avaliacao");

                let condition = true;
                condition = condition && date == answerPresenca.date;
                condition = condition && id_user == answerPresenca.fk_id_user;
                condition = condition && id_avaliacao == answerPresenca.fk_id_avaliacao;

                if (condition) {
                    checkInput(input);
                }
            }
        };

        xhr.send(data);
    }

    function backToCalendar() {
        location.href = "/PANDA/src/php/pages/turma.php?turma_nav=chamada";
    }
</script>
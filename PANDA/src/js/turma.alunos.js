function setListaAlunos(alunos) {
    alunos.sort((a, b)=>{
        if (a.name > b.name) {
            return 1;
        }
        if (a.name < b.name) {
            return -1;
        }
        // a must be equal to b
        return 0;
    });

    for (const aluno of alunos) {
        let tr = document.createElement("tr");
        let td1 = document.createElement("td");
        let td2 = document.createElement("td");
        let id_aluno = aluno.fk_id_user;

        tr.className = "tr-presenca";
        td1.innerText = aluno.name;
        td2.innerText = aluno.surname;

        document.getElementsByTagName("tbody")[0].append(tr);
        tr.append(td1);
        tr.append(td2);

        tr.addEventListener("click", (event) => {
            event.preventDefault();
            let xml = new XMLHttpRequest();
            let data = new FormData();

            data.append("id_target", id_aluno);
            xml.open("post", "/PANDA/src/php/includes/perfil/perfil.redirect.php", true);
            xml.onload = () => {
                let response = xml.response;
                window.location = response;
            }
            xml.send(data);
        });
    }
}
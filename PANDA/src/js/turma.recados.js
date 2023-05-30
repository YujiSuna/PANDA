function setListaRecados(recados) {
    if (!recados) {
        return false;
    }
    for (const recado of recados) {
        let titulo = recado.name_recado;

        let tr = document.createElement("tr");
        let th = document.createElement("th");
        let td1 = document.createElement("td");
        let td2 = document.createElement("td");

        tr.className = "tr-presenca";
        tr.setAttribute("id_recado", recado.id_recado);
        th.setAttribute("scope", "row");
        th.innerText = titulo.length >= 10 ? titulo.slice(0, 10).concat("...") : titulo;
        td1.innerText = recado.mensagem.length >= 20 ? recado.mensagem.slice(0, 20).concat("...") : recado.mensagem;
        td2.innerText = recado.data_criada;
        td2.className = "d-none d-md-table-cell"


        document.getElementsByTagName("tbody")[0].append(tr);
        tr.append(th);
        tr.append(td1);
        tr.append(td2);

        tr.addEventListener("click", (event) => {
            event.preventDefault();
            //copy modalTemplete
            var temp = document.getElementById("modalTemplate");
            var clon = temp.content.cloneNode(true);
            document.body.appendChild(clon);

            //set texts
            $(".modal-title")[0].innerText = recado.name_recado;
            $(".modal-title")[1].innerText = "Criado em: " + recado.data_criada;
            $(".modal-body")[0].innerText = recado.mensagem;

            var modal = $(".modal")[0];
            modal.addEventListener("hidden.bs.modal", () => { modal.remove() });
            new bootstrap.Modal(modal).toggle();

            var btnLink = $(".btn.btn-primary.btnLink");
            btnLink.click(()=>{
                event.preventDefault();

                let xml = new XMLHttpRequest();
                let data = new FormData();
                data.append("id_recado", recado.id_recado);
                xml.open("post", "/PANDA/src/php/includes/recado/recado.redirect.php", true);
                xml.onload = () => {
                    let response = xml.response;
                    window.location = response;
                }
                xml.send(data);
            });
        });
    }
    return true;
}
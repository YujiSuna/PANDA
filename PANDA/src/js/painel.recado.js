console.log(recados);
if (recados.length > 0) {
    console.log(recados);
    for (const recado of recados) {
        let id_recado = recado.id_recado;
        let name_recado = recado.name_recado.toUpperCase();
        let name_professor = recado.name_professor;
        
        createListItem(id_recado, name_recado, name_professor);
    }
}

function createListItem(id_recado, name_recado, name_professor) {
    let ul = document.getElementsByClassName("list-recado")[0];
    
    let a = document.createElement("a");
    a.className = "list-group-item list-group-item-action py-3";
    
    let div = document.createElement("div");
    div.className = "text-center p-0 m-0";

    let h5 = document.createElement("h5");
    h5.className = "desc1 m-0";
    h5.textContent = name_recado;

    let h6 = document.createElement("h6");
    h6.className = "decs2 m-0 text-muted";
    h6.textContent = name_professor;

    ul.appendChild(a);
    a.appendChild(div);
    div.appendChild(h5);
    div.appendChild(h6);

    a.addEventListener("click", (event)=>{
        event.preventDefault();
        
        let xml = new XMLHttpRequest();
        let data = new FormData();
        data.append("id_recado", id_recado);
        xml.open("post", "/PANDA/src/php/includes/recado/recado.redirect.php", true);
        xml.onload = ()=>{
            let response = xml.response;
            window.location = response;
        }
        xml.send(data);
    });
}
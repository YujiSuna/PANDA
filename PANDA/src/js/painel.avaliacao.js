console.log(avaliacoes);
if (avaliacoes.length > 0) {
    for (const avaliacao of avaliacoes) {
        let id_avaliacao = avaliacao.id_avaliacao;
        let name_avaliacao = avaliacao.name_avaliacao.toUpperCase();
        let name_professor = avaliacao.name_professor;
        
        createListItem(id_avaliacao, name_avaliacao, name_professor);
    }
}

function createListItem(id_avaliacao, name_avaliacao, name_professor) {
    let ul = document.getElementsByClassName("list-avaliacao")[0];
    
    let a = document.createElement("a");
    a.className = "list-group-item list-group-item-action py-3";
    
    let div = document.createElement("div");
    div.className = "text-center p-0 m-0";

    let h5 = document.createElement("h5");
    h5.className = "desc1 m-0";
    h5.textContent = name_avaliacao;

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
        data.append("id_avaliacao", id_avaliacao);
        xml.open("post", "/PANDA/src/php/includes/avaliacao/avaliacao.redirect.php", true);
        xml.onload = ()=>{
            let response = xml.response;
            window.location = response;
        }
        xml.send(data);
    });
}
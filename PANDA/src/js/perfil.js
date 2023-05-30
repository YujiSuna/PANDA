function setInfoTarget(target) {
    var count = 0;
    for (const key in target) {
        if (Object.hasOwnProperty.call(target, key)) {
            if (key == "nivel") {
                continue;
            }
            let info = target[key];
            info = formatInfoTarget(info, key);
            $(".info-target")[count].innerText += " " + info;
        }
        count++;
    }
    return true;
}

function formatInfoTarget(info, key) {
    const genders = ["m", "f", "n"];
    const gendersFormatted = ["Masculino", "Feminino", "Não especificado"];
    if (genders.includes(info)) {
        //formata genero
        let index = genders.indexOf(info);
        return gendersFormatted[index];
    } else if (key == "phone") {
        //formata telefone
        var cleaned = ('' + info).replace(/\D/g, '');
        var match = cleaned.match(/^(\d{2})(\d{5})(\d{4})$/);
        if (match) {
            return '(' + match[1] + ') ' + match[2] + '-' + match[3];
        }
    } else if (key == "birthday") {
        return info.replaceAll(" ", "");
    }
    return info;
}

function setInfoKey(array, key) {
    if (array.length > 0) {
        array.sort((a, b) => {
            if (a.name > b.name) {
                return 1;
            }
            if (a.name < b.name) {
                return -1;
            }
            // a must be equal to b
            return 0;
        });

        for (const element of array) {
            let id = element.id;
            let name = element.name.toUpperCase();

            createListItem(id, name, key);
        }
    }
}

function createListItem(id, name, key) {
    let ul = document.getElementsByClassName("info-" + key)[0];

    let a = document.createElement("a");
    a.className = "list-group-item list-group-item-action py-3";

    let div = document.createElement("div");
    div.className = "text-center p-0 m-0";

    let h5 = document.createElement("h5");
    h5.className = "desc1 m-0";
    h5.textContent = name;

    ul.appendChild(a);
    a.appendChild(div);
    div.appendChild(h5);

    a.addEventListener("click", (event) => {
        event.preventDefault();

        let xml = new XMLHttpRequest();
        let data = new FormData();
        data.append("id_" + key, id);
        data.append("page", key + ".php");
        xml.open("post", "/PANDA/src/php/includes/" + key + "/" + key + ".redirect.php", true);
        xml.onload = () => {
            let response = xml.response;
            window.location = response;
        }
        xml.send(data);
    });
}

function openModal(array, key, func) {
    var temp = document.getElementById("cardPandaTemplate");
    var clon = temp.content.cloneNode(true);
    document.body.appendChild(clon);
    let modalTitle;
    let addclass;

    switch (key) {
        case 'turma':
            modalTitle = "TURMAS";
            addclass = "info-turma";
            break;

        case 'recado':
            modalTitle = "RECADOS";
            addclass = "info-recado";
            break;

        case 'avaliacao':
            modalTitle = "AVALIACOES";
            addclass = "info-avaliacao";
            break;
    }

    //set texts
    $(".modal-title")[0].innerText = modalTitle;
    $(".modal-body > .list-group")[0].classList.add(addclass);

    func(array, key);

    var modal = $(".modal")[0];
    modal.addEventListener("hidden.bs.modal", () => { modal.remove() });
    new bootstrap.Modal(modal).toggle();
}
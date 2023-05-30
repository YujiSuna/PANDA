function setRecado(recado) {
    $("#tipo_recado").text(recado.tipo);
    $("#detalhe_avaliacao").text(recado.mensagem);
    $("#name_recado").text(recado.name_recado);
    $("#name_professor").text(recado.professor.fullName);
    $("#name_receptor").text(recado.receptor.name_receptor);

    $("#name_professor").click((event) => {
        event.preventDefault();
        let id_professor = recado.fk_id_professor;
        let xml = new XMLHttpRequest();
        let data = new FormData();

        data.append("id_target", id_professor);
        xml.open(
            "post",
            "/PANDA/src/php/includes/perfil/perfil.redirect.php",
            true
        );
        xml.onload = () => {
            let response = xml.response;
            window.location = response;
        };
        xml.send(data);
    });

    $("#name_receptor").click((event) => {
        event.preventDefault();
        let id_receptor = recado.receptor.id_receptor[1];
        let xml = new XMLHttpRequest();
        let data = new FormData();

        data.append("id_target", id_receptor);
        console.log(data.get("id_target"));
        console.log(recado.redirect);

        xml.open("post", recado.redirect, true);
        xml.onload = () => {
            let response = xml.response;
            window.location = response;
        };
        xml.send(data);
    });
}

function setAJAXrecado(formNum) {
    console.log("setAJAXrecado(" + formNum + ")");
    
    var recadoForm = document.getElementById("recadoForm" + formNum);
    recadoForm.addEventListener("submit", function (event) {
        event.preventDefault();
        event.stopPropagation();

        if (recadoForm.checkValidity()) {
            console.log("Passou recado checkValidity");
            let data = new FormData(recadoForm);
            let page = "/PANDA/src/php/includes/ferramentas/ajaxPost/ajaxPostRecado.php";
            data.append("formNum", formNum);

            ajaxPOST(data, page, (answer) => {
                if (!answer.toLowerCase().includes("Erro")) {
                    if (formNum == 1) {
                        let redirectLink =
                            "/PANDA/src/php/pages/ferramentas/cadastroRecado.php?bGFzdEFkZGVkUmVjYWRvSWQNCg=" +
                            answer;
                        window.location = redirectLink;
                    } else if (formNum == 2) {
                        alert("Recado Associado com sucesso");
                        window.location.reload();
                    }
                } else {
                    console.error("ajaxPost " + answer);
                }
            });
        } else {
            console.error("recadoForm error");
            event.preventDefault();
            event.stopPropagation();
        }

        recadoForm.classList.add("was-validated");
    }, false);
}

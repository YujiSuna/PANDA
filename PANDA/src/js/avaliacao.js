function setAvaliacao(avaliacao) {
    $("#tipo_avaliacao").text(avaliacao.tipoText);
    $("#detalhe_avaliacao").text(avaliacao.detalhe);
    $("#name_avaliacao").text(avaliacao.name_avaliacao);
    $("#name_professor").text(avaliacao.professor.fullName);
    $("#name_avaliados").text(avaliacao.avaliado.name_avaliado);
    
    $("#name_professor").click((event) => {
        event.preventDefault();
        let id_professor = avaliacao.fk_id_professor;
        let xml = new XMLHttpRequest();
        let data = new FormData();

        data.append("id_target", id_professor);
        xml.open("post", "/PANDA/src/php/includes/perfil/perfil.redirect.php", true);
        xml.onload = () => {
            let response = xml.response;
            window.location = response;
        }
        xml.send(data);
    });
    
    $("#name_avaliados").click((event) => {
        event.preventDefault();

        let id_avaliado = avaliacao.avaliado.id_avaliado;
        let xml = new XMLHttpRequest();
        let data = new FormData();

        data.append(id_avaliado[0], id_avaliado[1]);
        console.log(data.get(id_avaliado[0]));
        console.log(avaliacao.redirect);

        xml.open("post", avaliacao.redirect, true);
        xml.onload = () => {
            let response = xml.response;
            window.location = response;
        }
        xml.send(data);
    });
}

function setAJAXavaliacao(formNum) {
    avaliacaoElement.replaceWith(avaliacaoElement.cloneNode(true));
    avaliacaoForm = document.getElementById('avaliacaoForm');
    avaliacaoForm.addEventListener('submit', function (event) {
        console.log("avaliacaoForm submit");

        event.preventDefault();
        event.stopPropagation();

        if (avaliacaoForm.checkValidity()) {
            console.log('entrou avaliacao');
            let data = new FormData(avaliacaoForm);
            let page = "/PANDA/src/php/includes/ferramentas/ajaxPost/ajaxPostAvaliacao.php";
            ajaxPOST(data, page, (answer) => {
                // if (answer.includes('true')) {
                //     document.getElementById('avaliacaoCardContent').innerHTML = '<h3><br>adicionado<br>com<br>sucesso!</h3>';
                //     document.getElementById('nav-tabContent').style.backgroundColor = '#4dff4d';
                //     setTimeout(() => {
                //         document.getElementById('avaliacaoCardContent').innerHTML = avaliacaoHTML;
                //         document.getElementById('nav-tabContent').style.backgroundColor = 'white';
                //         setAJAXavaliacao();
                //     }, 2500);
                // } else {
                //     console.error(answer);
                // }
                console.log(answer);
            });
        } else {
            console.error("avaliacaoForm error");
            event.preventDefault();
            event.stopPropagation();
        }

        avaliacaoForm.classList.add('was-validated');
    }, false)
}
function setTurmaSobreInfo(prof, numAlunos, turma) {
    $("#name_professor").text( ()=>{
        return $("#name_professor").text() + prof.fullname;
    });
    $("#num_alunos").text(()=>{
        return $("#num_alunos").text() + numAlunos;
    });
    $("#detalhe_turma").text(turma.detalhe);

    $("#name_professor").click((event)=>{
        event.preventDefault();
        let id_professor = prof.id_user;
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
}
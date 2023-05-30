<?php
//verificacao do usuario
require_once '/xampp/htdocs/PANDA/src/php/class.php/SessionFunctions.class.php';
$cSF = new SessionFunctions();
$id = $cSF->verifyUser();
$nivel_user = $cSF->getSessionData("nivel_user");
echo "<script>console.log('Nivel: $nivel_user')</script>"
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PANDA | Ferramentas</title>

    <link rel="sortcut icon" href="/PANDA/src/imagens/logo.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/PANDA/src/css/ferramentas/ferramentas.css">
    <?php include_once "/xampp/htdocs/PANDA/src/php/includes/onlineResorces.php" ?>
</head>

<body>
    <?php require_once '/xampp/htdocs/PANDA/src/php/includes/sideNav/sideNav.php'; ?>

    <div id="main" class="container d-flex justify-content-center">
        <div id="card-ferramenta" class="card">
            <div class="container-fluid">
                <div class="row">
                    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                        <div class="sidebar-sticky py-3">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link active disabled" href="#mainContentFerramentas">
                                        Cadastros
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/PANDA/src/php/pages/ferramentas.remocao.php">
                                        Remover
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </nav>

                    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                        <div id="main-title" class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h2 class="h2">Cadastros</h2>
                        </div>

                        <div id="mainContentFerramentas" class="mainContentCurrent">
                            <div id="main-content" class="row row-cols-2"></div>
                        </div>

                        <script>
                            $(document).ready(() => {
                                $("#main-content");
                                const cadastroLinkList = {
                                    "Cadastrar Nova Turma": "cadastroTurmaAluno.php",
                                    "Cadastrar Alunos na Turma": "cadastroTurmaAluno.php#nav-2-tab",
                                    "Cadastrar Novo Recado": "cadastroRecado.php",
                                    "Enviar Recados": "cadastroRecado.php?formNum=2",
                                    "Cadastrar Nova Avaliação": "cadastroAvaliacao.php",
                                    "Associar Avaliações": "cadastroAvaliacao.php?formNum=2",
                                    "Criar nova conta": "/PANDA/src/php/pages/cadastro.php"
                                }

                                Object.keys(cadastroLinkList).forEach(key => {
                                    if (<?php echo $nivel_user?> == 1) {
                                        if (key == "Cadastrar Nova Turma" || key == "Cadastrar Alunos na Turma") {
                                            return;
                                        }
                                    }

                                    let div = $("<div></div>");
                                    div.addClass(() => {
                                        let classes = ["col", "d-flex", "align-self-center"];
                                        if (key == "Criar nova conta") {
                                            classes[$.inArray("col", classes)] = "col-12";
                                        }
                                        return classes;
                                    });

                                    let link = $("<a></a>").text(key);
                                    link.addClass(["btn", "btn-outline-secondary", "w-100"]);

                                    let linkAddress = (key != "Criar nova conta") ? "/PANDA/src/php/includes/ferramentas/" : "";
                                    linkAddress += cadastroLinkList[key];
                                    link.attr("href", linkAddress);

                                    $("#main-content").append(div.append(link));
                                });
                            });
                        </script>
                    </main>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
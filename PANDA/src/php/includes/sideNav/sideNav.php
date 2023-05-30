<?php
/*
0-Overlay
1-Push Content
2-Push Content w/ opacity
3-Full-width
4-Without Animation
*/

/* ----------Config Side Nav Content---------- */
$linkNames = ['Home', 'Contato', 'Ferramentas', 'Sair'];
$links = [
    '/PANDA/src/php/pages/painel.php',
    '/PANDA/src/php/pages/contato.php',
    '/PANDA/src/php/pages/ferramentas.cadastro.php',
    '/PANDA/src/php/includes/logout.php'
];
$_SESSION['linkNames'] =  $linkNames;
$_SESSION['links'] = $links;

// require_once '/xampp/htdocs/PANDA/src/php/class.php/SessionFunctions.class.php';
// $cSF = new SessionFunctions();
// $nivel_user = $cSF->getSessionData('nivel_user')
?>

<script>
    sideNavNum = 0;
    window.addEventListener('resize', function() {
        setSideNavNum();
    });

    function setSideNavNum() {
        if (window.innerWidth >= 768) {
            sideNavNum = 0;
        } else {
            sideNavNum = 3;
        }
    }
</script>

<!-- ----------Side Nav CSS and Script---------- -->
<link rel="stylesheet" href="/PANDA/src/php/includes/sideNav/sideNav.css">
<script src="/PANDA/src/php/includes/sideNav/sideNav.js"></script>

<!-- ----------Side Nav Template---------- -->
<div id="bg-gray" onclick="closeNav(sideNavNum)"></div>
<div id="mySidenav" class="sidenav" onload="setDefaultCheck(sideNavNum)">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav(sideNavNum)">&times;</a>
    <div class="container d-flex justify-content-center">
        <div class="m-3">
            <?php
            foreach ($_SESSION['linkNames'] as $index => $linkname) {
                $link = $_SESSION['links'][$index];
                if ($nivel_user != 2) {
                    echo "<a id='sideNavLink$index' href='$link'>$linkname</a>";
                } else {
                    if ($index != 2) {
                        echo "<a id='sideNavLink$index' href='$link'>$linkname</a>";
                    }
                }
            }
            ?>
        </div>
    </div>
</div>

<!-- ----------Nav Template---------- -->
<nav class="navbar d-flex justify-content-center">
    <div class="row align-items-center w-100">
        <div class="col-3 d-flex justify-content-start">
            <button class="navbar-toggler" type="button" onclick="openNav(sideNavNum)">
                <svg id="toggler-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke=" #ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            </button>
        </div>
        <div class="col-6 d-flex justify-content-center">
            <a href="/PANDA/src/php/pages/painel.php">
                <img id="nav-image" src="/PANDA/src/imagens/Logo_Branco.png" alt="">
            </a>
        </div>
        <div class="col-3 d-flex justify-content-end">
            <a id="self_perfil" href="/PANDA/src/php/pages/perfil.php">
                <img id="nav-icon" class="rounded-circle" src="/PANDA/src/imagens/Logo_Panda.png" alt="">
            </a>
        </div>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script>
    $(".sidebar-dropdown > a").click(function() {
        $(".sidebar-submenu").slideUp(200);
        if ($(this).parent().hasClass("active")) {
            $(".sidebar-dropdown").removeClass("active");
            $(this).parent().removeClass("active");
        } else {
            $(".sidebar-dropdown").removeClass("active");
            $(this).next(".sidebar-submenu").slideDown(200);
            $(this).parent().addClass("active");
        }
    });

    $("#close-sidebar").click(function() {
        $(".page-wrapper").removeClass("toggled");
    });
    $("#show-sidebar").click(function() {
        $(".page-wrapper").addClass("toggled");
    });

    $("#self_perfil").click((event) => {
        event.preventDefault();
        let xml = new XMLHttpRequest();
        let data = new FormData();

        data.append("id_target", <?php echo $_SESSION["idUser"]?>);
        console.log(data.get("id_target"));

        xml.open("post", "/PANDA/src/php/includes/perfil/perfil.redirect.php", true);
        xml.onload = () => {
            let response = xml.response;
            window.location = response;
        };
        xml.send(data);
    });
</script>

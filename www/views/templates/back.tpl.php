<?php
    use cms\managers\UserManager;
    use cms\core\Helpers;
    session_start();
    (!isset($_SESSION['userId'])) ? header('Location: /session-not-start') : '';
    if(isset($_SESSION['userId'])){
        $current_user = (new UserManager(User::class, 'user'))->read($_SESSION['userId']);
        if(reset($current_user)->getAllow() == 0){
            header('Location: /no-permission');
        }
        if(reset($current_user)->getStatut() == 0){
            header('Location: /no-permission');
        }
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/ico" href="../../src/images/favicon.ico"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="../dist/main.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../../css/salles.css">
    <link rel="stylesheet" href="../../css/addfilm.css">
    <link rel="stylesheet" href="../../css/show-movie.css">
    <link rel="stylesheet" href="../../css/show-cinema.css">
    <link rel="stylesheet" href="../../css/horraires.css">
    <link rel='stylesheet' href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css">
    <link rel='stylesheet' href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.min.css'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="../../js/chart.js"></script>
</head>
<body style="font-family: Montserrat">
    <div class="flex-container">
        <div class="sidebar">
            <div class="title-container">
                <div>
                    <h1>NEAR BY</h1>
                </div>
                <div id="subtitle-fixer">
                    <h3 id="text-white" style="font-size:20px;">Dashboard</h3>
                </div>
            </div>
            <a href="<?= Helpers::getUrl('User','showUser').'/'.reset($current_user)->getId() ?>" style="width: -webkit-fill-available;">
                <div class="name-container">
                    <img src="../public/images/<?= reset($current_user)->getImage_profile() ?>" id="dot"/>
                    <p><?=ucFirst(reset($current_user)->getFirstname());?></p>
                </div>
            </a>
            <div class="nav-content">
                <h2 id="text-submenu-fixer">Gestion</h2>
                <div class="dashboard-menu">
                    <div class="sidebar-sub-headers">
                        <div class="fas fa-film fa-lg"></div>
                        <div id="submenu-wrapper">
                            <a href="<?=\cms\core\Helpers::getUrl("Dashboard", "dashboard")?>" id="text-white"><span>Films</span></a>
                        </div>
                    </div>
                </div>
                <div class="dashboard-menu">
                    <div class="sidebar-sub-headers">
                        <div class="fa fa-tasks fa-lg"></div>
                        <div id="submenu-wrapper">
                            <a href="<?=\cms\core\Helpers::getUrl("Page", "showPages")?>" id="text-white"><span>Pages</span></a>
                        </div>
                    </div>
                </div>
                <div class="dashboard-menu">
                    <div class="sidebar-sub-headers">
                        <div class="fa fa-desktop fa-lg"></div>
                        <div id="submenu-wrapper">
                            <a href="<?=\cms\core\Helpers::getUrl("Page","templateCreate")?>" id="text-white"><span>Template accueil</span></a>
                        </div>
                    </div>
                </div>
                <div class="dashboard-menu">
                    <div class="sidebar-sub-headers">
                        <div class="fa fa-cube fa-lg"></div>
                        <div id="submenu-wrapper">
                            <a href="<?=\cms\core\Helpers::getUrl("Page", "showSectionsPage")?>" id="text-white"><span>Components Page</span></a>
                        </div>
                    </div>
                </div>
                <h2 id="text-submenu-fixer">Diffusion</h2>
                <div class="dashboard-menu">
                    <div class="sidebar-sub-headers">
                        <div class="fas fa-clock fa-lg"></div>
                        <div id="submenu-wrapper">
                        <a href="<?=\cms\core\Helpers::getUrl("MovieReservation", "seances")?>" id="text-white"><span>Séances</span></a>
                        </div>
                    </div>
                </div>
                <div class="dashboard-menu">
                    <div class="sidebar-sub-headers">
                        <div class="fas fa-sliders-h fa-lg"></div>
                        <div id="submenu-wrapper">
                            <a href="<?=\cms\core\Helpers::getUrl("Room", "room")?>" id="text-white"><span>Salles</span></a>
                        </div>
                    </div>
                </div>
                <div class="dashboard-menu">
                    <div class="sidebar-sub-headers">
                        <div class="fas fa-video fa-lg"></div>
                        <div id="submenu-wrapper">
                            <a href="<?=\cms\core\Helpers::getUrl("Cinema", "cinema")?>" id="text-white"><span>Cinema</span></a>
                        </div>
                    </div>
                </div>
                <h2 id="text-submenu-fixer">KPI</h2>
                <div class="dashboard-menu">
                    <div class="sidebar-sub-headers">
                        <div class="fa fa-bar-chart fa-lg"></div>
                        <div id="submenu-wrapper">
                            <a href="<?=\cms\core\Helpers::getUrl("Dashboard","stat")?>" id="text-white"><span>Stats</span></a>
                        </div>
                    </div>
                </div>
                <h2 id="text-submenu-fixer">Gestion</h2>
                <div class="dashboard-menu">
                    <div class="sidebar-sub-headers">
                        <div class="fas fa-users fa-lg"></div>
                        <div id="submenu-wrapper">
                            <a href="<?=\cms\core\Helpers::getUrl("User","users")?>" id="text-white"><span>Users</span></a>
                        </div>
                    </div>
                </div>
                <div class="dashboard-menu">
                    <div class="sidebar-sub-headers">
                        <div class="fa fa-comment-o fa-lg"></div>
                        <div id="submenu-wrapper">
                            <a href="<?=\cms\core\Helpers::getUrl("Comment","comment")?>" id="text-white"><span>Commentaires</span></a>
                        </div>
                    </div>
                </div>
                <div class="dashboard-menu">
                    <div class="sidebar-sub-headers">
                        <div class="fa fa-sliders fa-lg"></div>
                        <div id="submenu-wrapper">
                            <a href="<?=\cms\core\Helpers::getUrl("Custom","custom")?>" id="text-white"><span>Personnalisation</span></a>
                        </div>
                    </div>
                </div>
                <div class="dashboard-menu">
                    <div class="sidebar-sub-headers">
                        <div class="fas fa-user-shield fa-lg"></div>
                        <div id="submenu-wrapper">
                            <a href="<?=\cms\core\Helpers::getUrl("User","login")?>" id="text-white"><span>Déconnexion</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- INCLUDE VIEWS HERE -->
        <?php include "views/".$this->view.".php"?>
        <!-- END INCLUDE VIEWS -->
    </div>
</body>
</html>

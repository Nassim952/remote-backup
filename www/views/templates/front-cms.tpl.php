<?php 
    use cms\core\Helpers;
    use cms\managers\UserManager;
    session_start();
    (!isset($_SESSION['userId'])) ? header('Location: /session-not-start') : $current_user = (new UserManager(User::class, 'user'))->read($_SESSION['userId']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>NEAR BY CMS</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="../../dist/main.css"> -->
    <link rel="stylesheet" href="../../dist-scss/main.css">
    <link rel="stylesheet" href="../../css/home.css">
    <link rel="stylesheet" href="../../css/template-create.css">
    <link rel='stylesheet' href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css">
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.min.css'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.js"></script>
    <script src="../../js/chart.js"></script>
    <script src="../../src/js/vendor/jquery-3.4.1.min.js"></script>
    <script src="../../src/js/caroussel--billboard.js"></script>
    <script src="../../src/js/caroussel--full--arrow.js"></script>
</head>

<body>
    <nav class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
            <div class="logo-wrapper">
                <img id="logo_header" src="../../src/images/logo.png">
            </div>
            <div class="link-wrapper">
                <a href="<?= Helpers::getUrl("User", "templateCreate") ?>" class="nav-text" style="text-decoration:underline;">Accueil</a>
                <a href="<?= Helpers::getUrl("User", "showUser").'/'.reset($current_user)->getId() ?>" class="nav-text" style="text-decoration:underline;"><?= reset($current_user)->getFirstname() ?></a>
                <a href="<?= Helpers::getUrl("User", "login") ?>" class="nav-text" style="text-decoration:underline;">Deconnexion</a>
            </div>
        </div>
    </nav>
    <nav class="sub-nav-template">
        <div class="link-wrapper-template">
            <a href="#" class="nav-text" style="text-decoration:underline;">Films & Evenement</a>
            <a href="#" class="nav-text" style="text-decoration:underline;">Offres & Actus</a>
            <a href="#" class="nav-text" style="text-decoration:underline;">Cinema</a>
        </div>
        <div class="right-input-wrapper">
            <form method="POST">
                <label for="search_movie">Rechercher un film : </label> 
                <input name="search_movie" type="text" class="input-round"/>
                <button class="Button" type="submit">Valider</button>
            </form>
        </div>
    </nav>
    <!-- INCLUDE VIEW HERE -->
    <?php include "views/".$this->view.".php"?>
    <!-- END INCLUDE VIEWS -->
</body>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>NEAR BY CMS</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="../dist/main.css">
    <link rel="stylesheet" href="../../css/home.css">
    <link rel="stylesheet" href="../../css/template-create.css">
    <link rel='stylesheet' href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css">
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.min.css'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.js"></script>
    <script src="../../js/chart.js"></script>
</head>

<body>
    <nav class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
            <div class="logo-wrapper">
                <img id="logo_header" src="../../src/images/logo.png">
            </div>
            <div class="link-wrapper">
                <a href="<?= \cms\core\Helpers::getUrl("User", "template-create") ?>" class="nav-text" style="text-decoration:underline;">Accueil</a>
                <a href="#" class="nav-text" style="text-decoration:underline;">Profil</a>
                <a href="#" class="nav-text" style="text-decoration:underline;">Deconnexion</a>
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
            <input type="text" class="input-round"/>
        </div>
    </nav>
    <div class="template-main-content">
        <div class="upper-template">
            <div class="space-1"><div class="vertical-box-align">+</div></div>
            <div class="space-1"><div class="vertical-box-align">+</div></div>
        </div>
        <div class="down-template">
            <div class="space-2"><div class="vertical-box-align">+</div></div>
        </div>
    </div>
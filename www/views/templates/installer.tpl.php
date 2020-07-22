<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <script src="../../js/chart.js"></script>
</head>
<body style="font-family: Montserrat">
    <div class="flex-container">
        <!-- INCLUDE VIEWS HERE -->
        <?php include "views/".$this->view.".php"?>
        <!-- END INCLUDE VIEWS -->
    </div>
</body>
</html>

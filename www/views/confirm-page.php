<head>
    <title>Confirmation</title>
</head>

<?php 
    use cms\core\Helpers; 
?>
<div class='confirm-wrapper' style='margin-left:20px;'>
    <p>Cliquer sur 'Home' pour retourner au menu</p>
    <a class="Button" href="<?= Helpers::getUrl("Dashboard","dashboard") ?>">Home</a>
</div>
<head>
    <title>Editer un cinéma</title>
</head>

<?php
    foreach($myCinema as $cinema):
?>
<div class="site-content">
    <div id="head-title">
        <h2>Editer un cinéma</h2>
    </div>
    <div id="separation-bar"></div>
    <div class=form-add style='margin-top: 50px;'>
        <form enctype="multipart/form-data" class=add-film method="post">
            <input class="input-form cinema-title" type="text" name="name" value="<?= $cinema->getName(); ?>"></input>
            <div class="flex-form-container">
                <div class="flex-form-content-left">
                    <input class=input-form  type="text" name="city" value="<?= $cinema->getPlace(); ?>">
                    <input class=input-form type="number" name="number_rooms" value="<?= $cinema->getNumber_rooms(); ?>">
                <div class="flex-form-content-right">
                    <input class="input-form affiche" type="file" name="image_url" value="<?= $cinema->getImage_url() ?>"></input>
                </div>
            </div>
            <input type="submit" class="input-form submit-addfilm" value="Valider"></input>
        </form>
    </div>
</div>
<?php endforeach; ?>
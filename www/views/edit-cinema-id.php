<head>
    <title>Edition d'un film</title>
</head>

<div class="site-content">
    <div id="head-title">
        <h2>Editer un film</h2>
    </div>
    <div id="separation-bar"></div>
    <div class=form-add style='margin-top: 50px;'>
        <form class=add-film method="POST">
            <label>Nom du cinéma</label>
            <input class="input-form cinema-title" type="text" name="name" value="<?= $cinema[0]->getName() ?>"></input>
            <div class="flex-form-container">
                <div class="flex-form-content-left" style="flex: auto;">
                    <label>Ville</label>
                    <input class=input-form  type="text" name="city" value="<?= $cinema[0]->getPlace() ?>">
                    <label>Nombre de salles</label>
                    <input class=input-form type="number" name="number_rooms" value="<?= $cinema[0]->getNumber_rooms() ?>">
                <div class="flex-form-content-right">
                <label>Image URL</label>
                    <input class="input-form affiche" type="url" name="image_url" value="<?= $cinema[0]->getImage_url() ?>"></input>
                </div>
            </div>
            <button type="submit" class="input-form submit-addfilm">Valider</button>
        </form>
    </div>
</div>
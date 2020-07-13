<head>
    <title>Ajouter un film</title>
</head>

<div class="site-content">
    <div id="head-title">
        <h2>Ajouter un film</h2>
    </div>
    <div id="separation-bar"></div>
    <div class=form-add style='margin-top: 50px;'>
        <form action="" class=add-film method="post">
            <input class="input-form cinema-title" type="text" name="name" placeholder="Nom du cinema"></input>
            <div class="flex-form-container">
                <div class="flex-form-content-left">
                    <input class=input-form  type="text" name="city" placeholder="Ville">
                    <input class=input-form type="number" name="number_rooms" placeholder="nombre de salles">
                <div class="flex-form-content-right">
                    <input class="input-form affiche" type="url" name="image_url" placeholder="url image"></input>
                </div>
            </div>
            <input type="submit" class="input-form submit-addfilm" value="Ajouter le film"></input>
        </form>
    </div>
</div>
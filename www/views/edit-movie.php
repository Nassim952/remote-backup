<head>
    <title>Editer un film</title>
</head>

<?php foreach($movie as $myMovie): ?>
<div class="site-content">
    <div id="head-title">
        <h2>Editer un film</h2>
    </div>
    <div id="separation-bar"></div>
    <div class=form-add>
        <form enctype="multipart/form-data" class=add-film method="post">
            <input class="input-form film-title" type="text" id="title" value="<?= $myMovie->getTitle() ?>" name="title" placeholder="titre du film"></input>
            <div class="flex-form-container">
                <div class="flex-form-content-left">
                <label>Durée</label>
                    <input class=input-form type="time" name="duration" value="<?= $myMovie->getDuration() ?>" id="duration" placeholder="durée"></input>
                    <label>Genre</label>
                    <select class=input-form type="select" id="genre" name="kind" value="">
                    <option value="<?= $myMovie->getKind() ?>"><?= $myMovie->getKind() ?></option>
                        <option value="Action">Action</option>
                        <option value="Aventure">Aventure</option>
                        <option value="Horreur">Horreur</option>
                        <option value="Thriller">Thriller</option>
                        <option value="Comedie">Comedie</option>
                    </select>
                    <label>Age déconseillé</label>
                    <select class=input-form type="select" id="age" name="age" placeholder="restriction d'âge">
                        <option value="<?= $myMovie->getAge_require() ?>"><?= $myMovie->getAge_require() ?></option>
                        <option value="10">-10</option>
                        <option value="12">-12</option>
                        <option value="14">-14</option>
                        <option value="16">-16</option>
                        <option value="18">-18</option>
                    </select>
                    <label>Date de sortie</label>
                    <input class=input-form type="date" name="date" id="date" value="" placeholder="date de sortie"></input>
                    <label>Réalisateur</label>
                    <input class=input-form value="<?= $myMovie->getDirector() ?>" type="text" id="real" name="director" placeholder="réalisateur"></input>
                    <label>Acteur principal</label>
                    <input class=input-form type="text" id="actor" name="actor" value="<?= $myMovie->getMain_actor() ?>" placeholder="acteur principal"></input>
                    <label>Nationalité du film</label>
                    <select class=input-form type="select" id="nat" name="nationality" placeholder="nationalité">
                        <option value="<?= $myMovie->getNationality() ?>"><?= $myMovie->getNationality() ?></option>
                        <option value="Americain">Etats-Unis</option>
                        <option value="Francais">France</option>
                        <option value="Espagnol">Espagne</option>
                        <option value="Anglais">Angleterre</option>
                        <option value="Japonais">Japonais</option>
                    </select>
                    <label>Type de film</label>
                    <select class=input-form type="select" id="type" name="type" placeholder="type de film">
                        <option value="<?= $myMovie->getMovie_type() ?>"><?= $myMovie->getMovie_type() ?></option>
                        <option value="Long-metrage">Long métrage</option>
                        <option value="Court-metrage">Court métrage</option>
                        <option value="Animation">Animation</option>
                        <option value="Manga">Manga</option>
                    </select>
                </div>
                <div class="flex-form-content-right">
                    <input type="file" name="Movie_image" id="image" class="input-form" accept="image/png, image/jpeg" value="<?= $myMovie->getImage_poster() ?>"></input>
                </div>
            </div>
            <label>Synopsis</label>
            <textarea class="input-form" name="synopsis" id="plot" cols="30" rows="10" placeholder="synopsis"><?= $myMovie->getSynopsis() ?></textarea>
            <input type="submit" class="input-form submit-addfilm" value="Valider"></input>
        </form>
    </div>
</div>
<?php endforeach; ?>
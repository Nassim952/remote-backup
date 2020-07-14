<head>
    <title>Ajouter un film</title>
</head>

<div class="site-content">
    <div id="head-title">
        <h2>Ajouter un film</h2>
    </div>
    <div id="separation-bar"></div>
    <div class=form-add>
        <form action="" class=add-film method="post">
            <input class="input-form film-title" type="text" id="title" name="title" placeholder="titre du film"></input>
            <div class="flex-form-container">
                <div class="flex-form-content-left">
                    <input class=input-form type="time" name="duration" id="duration" placeholder="durée"></input>
                    <select class=input-form type="select" id="genre" name="kind" placeholder="genre">
                    <option value="">Genre</option>
                        <option value="Action">Action</option>
                        <option value="Aventure">Aventure</option>
                        <option value="Horreur">Horreur</option>
                        <option value="Thriller">Thriller</option>
                        <option value="Comedie">Comedie</option>
                    </select>
                    <select class=input-form type="select" id="age" name="age" placeholder="restriction d'âge">
                        <option value="">Restriction d'âge</option>
                        <option value="10">-10</option>
                        <option value="12">-12</option>
                        <option value="14">-14</option>
                        <option value="16">-16</option>
                        <option value="18">-18</option>
                    </select>
                    <input class=input-form type="date" name="date" id="date" placeholder="date de sortie"></input>
                    <input class=input-form type="text" id="real" name="director" placeholder="réalisateur"></input>
                    <input class=input-form type="text" id="actor" name="actor" placeholder="acteur principal"></input>
                    <select class=input-form type="select" id="nat" name="nationality" placeholder="nationalité">
                        <option value="">Nationalité</option>
                        <option value="Americain">Etats-Unis</option>
                        <option value="Francais">France</option>
                        <option value="Espagnol">Espagne</option>
                        <option value="Anglais">Angleterre</option>
                        <option value="Japonais">Japonais</option>
                    </select>
                    <select class=input-form type="select" id="type" name="type" placeholder="type de film">
                        <option value="">Type de film</option>
                        <option value="Long-metrage">Long métrage</option>
                        <option value="Court-metrage">Court métrage</option>
                        <option value="Animation">Animation</option>
                        <option value="Manga">Manga</option>
                    </select>
                </div>
                <div class="flex-form-content-right">
                    <input class="input-form affiche" type="url" name="image_url" id="poster" placeholder="url image"></input>
                </div>
            </div>
            <textarea class="input-form" name="synopsis" id="plot" cols="30" rows="10" placeholder="synopsis"></textarea>
            <input type="submit" class="input-form submit-addfilm" value="Ajouter le film"></input>
        </form>
    </div>
</div>
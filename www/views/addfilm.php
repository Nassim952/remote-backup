<head>
    <title>Ajouter un film</title>
</head>

<div class="site-content">
    <div id="head-title">
        <h2>Ajouter un film</h2>
    </div>
    <div id="separation-bar"></div>
    <div class=form-add>
        <form action="" class=add-film>
            <input class="input-form film-title" type="text" id="title" name="title" placeholder="titre du film"></input>
            <div class="flex-form-container">
                <div class="flex-form-content-left">
                    <input class=input-form type="time" name="durée" id="duration" placeholder="durée"></input>
                    <select class=input-form type="select" id="genre" name="genre" placeholder="genre">
                    <option value="">Genre</option>
                        <option value="action">Action</option>
                        <option value="aventure">Aventure</option>
                        <option value="horreur">Horreur</option>
                        <option value="animation">Animation</option>
                        <option value="comedie">Comedie</option>
                    </select>
                    <select class=input-form type="select" id="age" name="age" placeholder="restriction d'âge">
                        <option value="">Restriction d'âge</option>
                        <option value="-10">-10</option>
                        <option value="-12">-12</option>
                        <option value="-16">-16</option>
                        <option value="-18">-18</option>
                    </select>
                    <input class=input-form type="date" name="date" id="date" placeholder="date de sortie"></input>
                    <input class=input-form type="text" id="real" name="réalisateur" placeholder="réalisateur"></input>
                    <input class=input-form type="text" id="actor" name="acteur" placeholder="acteur principal"></input>
                    <select class=input-form type="select" id="nat" name="nationalité" placeholder="nationalité">
                        <option value="">Nationalité</option>
                        <option value="usa">Etats-Unis</option>
                        <option value="fr">France</option>
                        <option value="es">Espagne</option>
                        <option value="en">Angleterre</option>
                    </select>
                    <select class=input-form type="select" id="type" name="type" placeholder="type de film">
                        <option value="">Type de film</option>
                        <option value="lm">Long métrage</option>
                        <option value="cm">Court métrage</option>
                        <option value="es">Espagne</option>
                        <option value="en">Angleterre</option>
                    </select>
                </div>
                <div class="flex-form-content-right">
                    <input class="input-form affiche" type="url" name="affiche" id="poster" placeholder="affiche"></input>
                </div>
            </div>
            <textarea class="input-form" name="synopsis" id="plot" cols="30" rows="10" placeholder="synopsis"></textarea>
            <input class="input-form submit-addfilm" type="submit" value="Ajouter le film">
        </form>
    </div>
</div>
<head>
    <title>Show Movie</title>
</head>

<div class="site-content">
    <div id="head-title">
        <h2 style="font-size:32px;">Movie</h2>
    </div>
    <div id="separation-bar"></div>

    <div class="show-movie-container">
        <div class="show-title-movie">
            <?php

use cms\core\Helpers;

foreach($myMovie as $movie): ?>
            <span class="show-title-style"><?= $movie->getTitle() ?></span>
        </div>
        <div class="show-right-desc">
            <div class="show-sub-wrapper">
                <ul style="margin: auto;">
                    <li class="show-li-wrapper">
                        <span id="show-label-bold">Film :</span> <?= $movie->getTitle() ?>
                    </li>
                    <li class="show-li-wrapper">
                        <span id="show-label-bold">Genre :</span> <?= $movie->getKind() ?>
                    </li>
                    <li class="show-li-wrapper">
                        <span id="show-label-bold">Interdit au moins de :</span> <?= $movie->getAge_require() ?>
                    </li>
                    <li class="show-li-wrapper">
                        <span id="show-label-bold">Acteur principal :</span> <?= $movie->getMain_actor() ?>
                    </li>
                    <li class="show-li-wrapper">
                        <span id="show-label-bold">Type de film :</span> <?= $movie->getMovie_type() ?>
                    </li>
                    <li class="show-li-wrapper">
                        <span id="show-label-bold">Date de sortie :</span> <?= $movie->getRelease_date() ?>
                    </li>
                    <li class="show-li-wrapper">
                        <span id="show-label-bold">Durée :</span> <?= $movie->getDuration() ?>
                    </li>
                    <li class="show-li-wrapper">
                        <span id="show-label-bold">Synopsis :</span> <?= $movie->getSynopsis() ?>
                    </li>
                </ul>
                <div class='show-button-wrapper'>
                    <a class="Button"
                        href="<?= Helpers::getUrl("Movie", "editMovie").'/'.$movie->getId() ?>">Modifier</button>
                        <a class="Button"
                            href="<?= Helpers::getUrl("Movie", "deleteMovie").'/'.$movie->getId() ?>">Supprimer</a>
                        <a class="Button" href="<?= Helpers::getUrl("Dashboard","dashboard") ?>">Retour</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <div class="container">

        <?php 
        if (empty($hisComment)) {
            echo ' <div class="">Aucun commentaire pour ce film</div>';
        }else
        echo '<div class="show-movie-comment-container"><h2>Espace commentaire :</h2>';
        
        foreach($hisComment as $comment): ?>
        <td class="list-film">


            <div class="card">
                <?php 
                    $commentReduced = $comment->getComment();
                    //Limits string lengt
                    $commentReduced= substr($commentReduced, 0,200);
                    ?>
                <!-- Display the comment -->
                <p id=""><?= $comment->getComment() ?></p>
                <!-- display the author name -->
                <p class="right" id="">Posté le : <?= $comment->getPost_date() ?> Par
                    <?= reset($userComment)->getLastName().'  '.  reset($userComment)->getFirstName() ?>
                </p>
                <div id="separation-bar"></div>
        </td>
        <?php endforeach; ?>


        <!-- action save comment -->
        <form action="" method="POST" class="">
            <div class="form-group">

                <label class="labelComment" for="content"> Ajouter un commentaire :</label>
                <!-- get the id film & id userby hidden ipunt -->
                <input type="hidden" name="id_commentaire" value="<?= $id ?> " />
                <input type="hidden" name="id_user" value="<?= $_SESSION['user']->getId() ?>" />
                <textarea style="float:center" name="content" id="content" rows="8" cols="135"></textarea>
            </div>

            <div class='show-button-wrapper'>
                <button style="" type="submit" class="Button row submit "> Soumettre mon commentaire </button>
            </div>
        </form>
    </div>
</div>
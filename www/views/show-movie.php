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
        <div class="show-desc-container">
            <div class='show-left-img'>
                <img class="show-fit-pic" src="../public/images/<?= $movie->getImage_poster() ?>"></img>
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
                            <span id="show-label-bold">Date de sortie :</span> <?= $movie->getRelease() ?>
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
        </div>
        <?php endforeach; ?>
    </div>
    <div class="container">
        <?php 
        if (empty($hisComment)) {
            echo ' <div class="">Aucun commentaire pour ce film</div>';
        }else
        foreach($hisComment as $comment): ?>
        <td class="td-dashboard-wrapper">
            <div class="">
                <div class="">
                    <div class="">
                        <?php 
                    $commentReduced = $comment->getComment();
                    //Limits string length to 70
                    $commentReduced= substr($commentReduced, 0,200);
                    ?>
                        <p id="text-wrappe"><?= $comment->getComment() ?></p>
                        <p id="hour-wrappe"><?= $comment->getPost_date() ?></p>
        </td>
        <?php endforeach; ?>
    </div>
<div class="show-movie container">
    <!-- action save comment -->
    <form action="" method="POST" class="">
        <div class="form-group">
            <label for="content"> Ajouter un commentaire  :</label>
            <!-- recuperer l'id du film avec un input hidden -->
            <input type="hidden" name="id_commentaire" value="$id" />
            <textarea class="" name="content" id="content" rows="5"></textarea>
    </form>
</div>
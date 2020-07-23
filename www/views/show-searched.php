<head>
    <title>NEAR BY CMS - Film recherché</title>
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
</head>

<?php use cms\core\Helpers; ?>
<body 
style=" 
background-image: url('../images/dream.gif');
background-position: right 140px;
background-repeat: no-repeat;
background-size: cover;">
    <div class="site-content" style="margin: 0 auto;">
        <?php foreach($myMovie as $movie): ?>
            <div class="show-movie-container" style="background-color: rgb(black);">

                <div class="show-title-movie">
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
                                    <span id="show-label-bold">Interdit au moins de :</span> <?= $movie->getAge_require() ?> ans
                                </li>

                                <li class="show-li-wrapper">
                                    <span id="show-label-bold">Réalisateur :</span> <?= $movie->getDirector() ?>
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
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        <div class="container">
            <?php if (empty($commentsOfMovie)): ?>
                <div class="">Aucun commentaire pour ce film</div>

                <!-- action save comment -->
                <form method="POST" class="">
                    <div class="form-group">
                        <label class="labelComment" for="content"> Ajouter un commentaire :</label>
                        <!-- get the id film & id userby hidden ipunt -->
                        <input type="hidden" name="id_user" value="<?= reset($current_user)->getId() ?>" />
                        <textarea style="float:center" name="content" id="content" rows="8" cols="135"></textarea>
                    </div>

                    <div class='show-button-wrapper'>
                        <button type="submit" class="Button row submit "> Soumettre mon commentaire </button>
                    </div>
                </form>
            <?php endif;?>

            <?php if(!empty($commentsOfMovie)): ?>
                <div class="show-movie-comment-container" style="overflow: auto;"><h2>Espace commentaire :</h2>
                    <?php foreach($commentsOfMovie as $comment): ?>
                        <?php $userComment = array_shift($usersComment) ?>
                        <td class="list-film">
                            <div style="width: -webkit-fill-available;" class="card">
                                <?php 
                                    $commentReduced = $comment->getComment();
                                    //Limits string lengt
                                    $commentReduced= substr($commentReduced, 0,200);
                                    ?>
                                <!-- Display the comment -->
                                <p id=""><?= $comment->getComment() ?></p>
                                <!-- display the author name -->
                                <p class="right" id="">Posté le : <?= $comment->getPost_date() ?> Par
                                    <?= $userComment->getLastname().'  '.  $userComment->getFirstname() ?>
                                </p>
                                <a class="Button" href="<?= Helpers::getUrl("User", "reportComment").'/'.$userComment->getId() ?>">Signaler</a>
                                <div id="separation-bar"></div>
                            </div>
                        </td>
                    <?php endforeach; ?>
                    <!-- action save comment -->
                    <form method="POST" class="">
                        <div class="form-group">
                            <label class="labelComment" for="content"> Ajouter un commentaire :</label>
                            <!-- get the id film & id userby hidden ipunt -->
                            <input type="hidden" name="id_commentaire" value="<?= $comment->getId() ?> " />
                            <input type="hidden" name="id_user" value="<?= reset($current_user)->getId() ?>" />
                            <textarea style="float:center" name="content" id="content" rows="8" cols="135"></textarea>
                        </div>

                        <div class='show-button-wrapper'>
                            <button type="submit" class="Button row submit "> Soumettre mon commentaire </button>
                        </div>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
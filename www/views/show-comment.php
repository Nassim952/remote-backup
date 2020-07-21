<head>
    <title>Show Comment</title>
</head>

<div class="site-content">
<div id="head-title">
    <h2 style="font-size:32px;">Comment</h2>
</div>
<div id="separation-bar"></div>

<div class="show-cinema-full-container">
    <div class="show-cinema-container">
        <?php
            use cms\core\Helpers;
            foreach($myComment as $comment): 
        ?>
        <div class="show-cinema-down">
            <ul>
                <li class="show-li-wrapper">
                    <span id="show-label-bold">Comment :</span> <?= $comment->getComment() ?>
                </li>
                <li class="show-li-wrapper">
                    <span id="show-label-bold">Date :</span> <?= $comment->getPost_date() ?>
                </li>
                <li class="show-li-wrapper"> 
                    <span id="show-label-bold">Auteur :</span>  <?=  var_dump($myAuthor);  ?> 
                </li>

                
            </ul>
            <div class='show-button-wrapper'>
            <a class="Button" href="<?= Helpers::getUrl("Comment", "editComment").'/'.$comment->getId() ?>">Modifier</button>
                <a class="Button" href="<?= Helpers::getUrl("Comment", "deleteComment").'/'.$comment->getId() ?>">Supprimer</a>
                <a class="Button" href="<?= Helpers::getUrl("Comment","comment") ?>">Retour</a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
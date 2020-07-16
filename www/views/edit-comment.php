<head>
    <title>Editer un cinéma</title>
</head>

<?php
    foreach($myComment as $comment):
?>
<div class="site-content">
    <div id="head-title">
        <h2>Editer un commentaire</h2>
    </div>
    <div id="separation-bar"></div>
    <div class=form-add style='margin-top: 50px;'>
        <form class=add-film method="post">
            <input class="input-form comment-title" type="text" name="name" value="<?= $comment->getComment(); ?>"></input>
            <div class="flex-form-container">
                <div class="flex-form-content-left">
                    <input class=input-form  type="date" name="city" value="<?= $comment->getPost_date(); ?>">
                    <input class=input-form type="number" name="number_rooms" value="<?= $comment->getUser_id(); ?>">
            </div>
            <input type="submit" class="input-form submit-addfilm" value="Valider"></input>
        </form>
    </div>
</div>
<?php endforeach; ?>
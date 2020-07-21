<head>
    <title>Editer un utilisateur</title>
</head>

<?php
    use cms\core\Helpers;
    foreach($myUser as $user):
?>
<div class="site-content">
    <div id="head-title">
        <h2>Editer un utilisateur</h2>
    </div>
    <div id="separation-bar"></div>
    <div class=form-add style='margin-top: 50px;'>
        <form enctype="multipart/form-data" class=add-film method="post">
            <label>Nom :</label>
            <input class="input-form cinema-title" type="text" name="lastname" value="<?= $user->getLastname(); ?>"></input>
            <div class="flex-form-container">
                <div class="flex-form-content-left">
                    <label>Prénom :</label>
                    <input class=input-form  type="text" name="firstname" value="<?= $user->getFirstname(); ?>">
                    <?php if(reset($current_user)->getAllow() >= 2): ?>
                        <?php if(reset($current_user)->getAllow() == 3): ?>
                            <label>Statut :</label>
                            <select class=input-form type="select" name="statut" value="<?= $user->getStatut(); ?>">
                                <option value="<?= $user->getStatut() ?>"><?= $user->getStatut() ?></option>
                                <option value="0">0</option>
                                <option value="1">1</option>
                            </select>
                        <?php endif; ?>
                    <div class="flex-form-content-right">
                    <select class=input-form type="select" name="allow" placeholder="permission">
                            <option value="<?= $user->getAllow() ?>"><?= Helpers::getPermission($user->getAllow()) ?></option>
                            <?php if(reset($current_user)->getAllow() == 3): ?>
                                <option value="2">SuperAdmin</option>
                            <?php endif; ?>
                            <option value="1">Admin</option>
                            <option value="0">Customer</option>
                        </select>
                    </div>
                <?php endif;?>
                <?php if(reset($current_user)->getId() == $user->getId()): ?>
                <label>Photo de profil :</label>
                    <input class="input-form affiche" type="file" name="image_profile" value="<?= $user->getImage_profile() ?>"></input>
                <?php endif; ?>
            </div>
            <input type="submit" class="input-form submit-addfilm" value="Valider"></input>
        </form>
    </div>
</div>
<?php endforeach; ?>
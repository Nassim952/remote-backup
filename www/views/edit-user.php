<head>
    <title>Editer un utilisateur</title>
</head>

<?php
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
                    <label>Statut :</label>
                    <select class=input-form type="select" name="statut" value="<?= $user->getStatut(); ?>">
                        <option value="<?= $user->getStatut() ?>"><?= $user->getStatut() ?></option>
                        <option value="0">0</option>
                        <option value="1">1</option>
                    </select>
                <div class="flex-form-content-right">
                <select class=input-form type="select" name="allow" placeholder="permission">
                        <option value="<?= $user->getAllow() ?>"><?= $user->getAllow() ?></option>
                        <option value="SuperAdmin">SuperAdmin</option>
                        <option value="Admin">Admin</option>
                        <option value="Customer">Customer</option>
                    </select>
                </div>
                <label>Photo de profil :</label>
                <input class="input-form affiche" type="file" name="image_profile" value="<?= $user->getImage_profile() ?>"></input>
            </div>
            <input type="submit" class="input-form submit-addfilm" value="Valider"></input>
        </form>
    </div>
</div>
<?php endforeach; ?>
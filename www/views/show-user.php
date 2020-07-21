<head>
    <title>Show User</title>
</head>

<div class="site-content">
<div id="head-title">
    <h2 style="font-size:32px;">User</h2>
</div>
<div id="separation-bar"></div>

<div class="show-cinema-full-container">
    <div class="show-cinema-container">
        <?php
            use cms\core\Helpers;
            foreach($myUser as $user): 
        ?>
        <div class="show-cinema-upper-img">
            <img class="show-cinema-fit-img" src="../public/images/<?= $user->getImage_profile() ?>">
        </div>
        <div class="show-cinema-down">
            <ul>
                <li class="show-li-wrapper">
                    <span id="show-label-bold">Nom :</span> <?= $user->getLastname() ?>
                </li>
                <li class="show-li-wrapper">
                    <span id="show-label-bold">Prenom :</span> <?= $user->getFirstname() ?>
                </li>
                <li class="show-li-wrapper">
                    <span id="show-label-bold">Email :</span> <?= $user->getEmail() ?>
                </li>
                <li class="show-li-wrapper">
                    <span id="show-label-bold">Permission :</span> <?= ucfirst(Helpers::getPermission($user->getAllow())) ?>
                </li>
            </ul>
            <div class='show-button-wrapper'>
                <a class="Button" href="<?= Helpers::getUrl("User", "editUser").'/'.$user->getId() ?>">Modifier</button>
                <a class="Button" href="<?= Helpers::getUrl("User","users") ?>">Retour</a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
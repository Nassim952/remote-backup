<head>
    <title>Show Cinema</title>
</head>

<div class="site-content">
<div id="head-title">
    <h2 style="font-size:32px;">Cinema</h2>
</div>
<div id="separation-bar"></div>

<div class="show-cinema-full-container">
    <div class="show-cinema-container">
        <?php
            use cms\core\Helpers;
            foreach($myCinema as $cinema): 
        ?>
        <div class="show-cinema-upper-img">
            <img class="show-cinema-fit-img" src="../public/images/<?= $cinema->getImage_url() ?>">
        </div>
        <div class="show-cinema-down">
            <ul>
                <li class="show-li-wrapper">
                    <span id="show-label-bold">Cinema :</span> <?= $cinema->getName() ?>
                </li>
                <li class="show-li-wrapper">
                    <span id="show-label-bold">Ville :</span> <?= $cinema->getPlace() ?>
                </li>
                <li class="show-li-wrapper">
                    <span id="show-label-bold">Nombre de salles :</span> <?= $cinema->getNumber_rooms() ?>
                </li>
            </ul>
            <div class='show-button-wrapper'>
                <?php if(reset($current_user)->getAllow() >= 2): ?>
                    <a class="Button" href="<?= Helpers::getUrl("Cinema", "editCinema").'/'.$cinema->getId() ?>">Modifier</button>
                    <a class="Button" href="<?= Helpers::getUrl("Cinema", "deleteCinema").'/'.$cinema->getId() ?>">Supprimer</a>
                <?php endif; ?>
                <a class="Button" href="<?= Helpers::getUrl("Cinema","cinema") ?>">Retour</a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
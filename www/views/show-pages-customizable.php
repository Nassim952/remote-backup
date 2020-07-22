<div class="front-custom-page-full-wrapper">
    <div style="margin-left: 20px;"><h2>Choisissez la page à customiser :</h2></div>
    <div class="front-custom-main-content">
        <div class="front-box-custom-pages">
            <?php

use cms\core\Helpers;

foreach($pages as $page): ?>
            <div class="front-custom-description-page"> 
            <div class="front-custom-title-page">
                <span><?= $page->getTitle() ?></span>
            </div>
                <div class="front-custom-li-wrapper">
                    <ul style="padding-inline-start: initial;">
                        <li class="li-style-none">
                            <span>Nombre rows : <?= $page->getGabarit() ?></span>
                        </li>
                        <li class="li-style-none">
                            <span>Date création : <?= $page->getCreation_date() ?></span>
                        </li>
                    </ul>
                    <a href="<?= Helpers::getUrl('Page','editPage').'/'.$page->getId() ?>" class="Button">Modifier</a>
                </div>
            </div>
            <?php endforeach;?>
        </div>
    </div>
</div>
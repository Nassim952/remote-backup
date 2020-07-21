<head>
    <title>Pages</title>
</head>


<div class="site-content">
    <div id="head-title">
        <h2 style="font-size:32px;">Pages</h2>
    </div>
    <div id="separation-bar"></div>
    <div class="quick-tools">
        <div id="space-icons">
            <a href="<?= \cms\core\Helpers::getUrl("Page","addPage") ?>" class="fas fa-plus fa-lg"></a>
        </div>
    </div>
    <div class="page_wrapper_flex">
        <?php
            foreach($pages as $page):
        ?> 
            <div class="front-page-box">
                <div class="head-wrapper">
                    <span class="head-title-salle"><?= $page->getTitle() ?></span>
                </div>
                <div class="front-page-bottom-wrapper">
                    <span class="front-show-libelle">Nombre de lignes : <?= $page->getGabarit() ?></span>
                    <span class="front-show-libelle">Theme couleur : <?= $page->getTheme() ?></span>
                    <span class="front-show-libelle">Police : <?= $page->getFont() ?></span>
                    <span class="front-show-libelle">Couleur police : <?= $page->getFont_color() ?></span>
                </div>
                <?php if(reset($current_user)->getAllow() >= 2): ?>
                    <a href="<?= cms\core\Helpers::getUrl("Pages","editPage").'/'.$page->getId() ?>" class="Button">Editer</a>
                <?php endif;?>
            </div>
        <?php endforeach; ?>
    </div>
</div>
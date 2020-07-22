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
                    <ul style="padding-inline-start: inherit;
                        display: flex;
                        flex-wrap: wrap;
                        justify-content: center;
                        align-items: center;">
                        <li><span class="front-show-libelle">Nombre de lignes : <?= $page->getGabarit() ?></span></li>
                    </ul>
                </div>
                <?php if(reset($current_user)->getAllow() >= 2): ?>
                    <div style="display: flex;
                            width: 250px;
                            justify-content: space-around;
                            align-items: center;
                            margin-top: 15px;">    
                        <a href="<?= cms\core\Helpers::getUrl("Page","editPage").'/'.$page->getId() ?>" class="Button">Editer</a>
                        <a href="<?= cms\core\Helpers::getUrl("Page","deletePage").'/'.$page->getId() ?>" class="Button">Supprimer</a>
                    </div>
                <?php endif;?>
            </div>
        <?php endforeach; ?>
    </div>
</div>
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
            <a href="<?= cms\core\Helpers::getUrl('Page','addPage') ?>" class="fas fa-plus fa-lg"></a>
            <a href="<?= \cms\core\Helpers::getUrl("Page","editPage") ?>" class="fas fa-edit fa-lg"></a>
            <a href="<?= \cms\core\Helpers::getUrl("Page","deletePage") ?>" class="fas fa-trash-alt fa-lg"></a>
        </div>
    </div>
    <div class="lists-film">
        <table class="table-wrapper">
            <tr class="tr-container"><?php

    foreach($pages as $page):
        // var_dump($page);
        
       
?>
<td class="td-dashboard-wrapper">
    <div class="pretty p-default p-curve p-bigger cb-fixer">
        <input type="checkbox">
        <div class="state p-danger">
            <label></label>
        </div>
    </div>
    <p id="text-wrappe"><?= $page->getId(); ?></p>
    <p id="text-wrappe"><?= $page->getTitle(); ?></p>
    <!-- why date null ?  -->
    <p id="hour-wrappe"><?= $page->getDate(); ?></p> 
    <p id="hour-wrappe"><?= $page->getGabarit(); ?></p>
    <p id="hour-wrappe"><?= $page->getDate(); ?></p>
    <p id="hour-wrappe"><?= $page->getTheme(); ?></p>
    <p id="hour-wrappe"><?= $page->getBackground(); ?></p>
   
</td>
 <?php endforeach; 
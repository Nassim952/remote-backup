<?php

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
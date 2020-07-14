<?php

    foreach($components as $component):
        //  var_dump($component);
        
       
?>
<td class="td-dashboard-wrapper">
    <div class="pretty p-default p-curve p-bigger cb-fixer">
        <input type="checkbox">
        <div class="state p-danger">
            <label></label>
        </div>
    </div>
    <p id="text-wrappe"><?= $component->getId(); ?></p>
    <p id="text-wrappe"><?= $component->getTitle(); ?></p>
    <p id="hour-wrappe"><?= $component->getClass(); ?></p>  
    <p id="hour-wrappe"><?= $component->getPosition(); ?></p>s
   
</td>
 <?php endforeach; 
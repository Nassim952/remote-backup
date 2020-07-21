<head>
    <title>Components</title>
</head>


<div class="site-content">
    <div id="head-title">
        <h2 style="font-size:32px;">Components</h2>
    </div>
    <div id="separation-bar"></div>
    <div class="quick-tools">
        <div id="space-icons">
            <a href="<?= cms\core\Helpers::getUrl('Component', 'addComponent') ?>" class="fas fa-plus fa-lg"></a>
            <a href="<?= \cms\core\Helpers::getUrl("Component","editComponent") ?>" class="fas fa-edit fa-lg"></a>
            <a href="<?= \cms\core\Helpers::getUrl("Component","deleteComponent") ?>" class="fas fa-trash-alt fa-lg"></a>
        </div>
    </div>
    <div class="lists-film">
        <table class="table-wrapper">
            <tr class="tr-container">
                <?php
        foreach($components as $component):
            //  var_dump($component);?>
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
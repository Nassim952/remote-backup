<head>
    <title>Show components</title>
</head>

<div class="site-content">
    <div id="head-title">
        <h2 style="font-size:32px;">Show components</h2>
    </div>
    <div id="separation-bar"></div>
    <div class="lists-film">
        <table class="table-wrapper">
            <tr style="height: 120px;" class="tr-container">
                <?php
                    use cms\managers\ComponentManager;
                    use cms\core\Helpers;
                    use cms\models\Component;
                    $componentsId = (new ComponentManager(Component::class, 'component'))->read();
                    foreach($components as $component):
                    ?>
                    <td class="td-dashboard-wrapper">
                        <div class="pretty p-default p-curve p-bigger cb-fixer">
                            <input type="checkbox">
                            <div class="state p-danger">
                                <label></label>
                            </div>
                        </div>
                        <p id="text-wrappe"><?= $component->getCategorie() ?></p>
                        |
                        <a class="fas fa-trash fa-lg" href="<?= Helpers::getUrl("Page", "deleteComponentPage").'/'.array_shift($componentsId)->getId() ?>"></a>
                    </td>
                <?php endforeach; ?>
            </tr>
        </table>
</div>


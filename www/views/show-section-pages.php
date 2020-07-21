<head>
    <title>Sections des pages</title>
</head>

<div class="site-content">
    <div id="head-title">
        <h2 style="font-size:32px;">Sections des pages</h2>
    </div>
    <div id="separation-bar"></div>
    <div class="lists-film">
        <table class="table-wrapper">
            <tr class="tr-container">
                <?php
                    use cms\core\Helpers;
                    foreach($sections as $section):
                ?>
                    <td class="td-dashboard-wrapper">
                        <div class="pretty p-default p-curve p-bigger cb-fixer">
                            <input type="checkbox">
                            <div class="state p-danger">
                                <label></label>
                            </div>
                        </div>
                        <a id="text-wrappe" href="<?=Helpers::getUrl('Page','showComponentsPage').'/'.$section->getId() ?>"> section numéro : <?= $section->getId() ?></a>
                        |
                        <?php foreach($pages as $page):?>
                            <?php if($page->getId() == $section->getPage_Id()): ?>
                                <p id="hour-wrappe"><?= $page->getTitle() ?></p>
                            <?php endif; ?>
                        <?php endforeach;?>
                    </td>
                <?php endforeach; ?>
            </tr>
        </table>
    </div>
    </body>
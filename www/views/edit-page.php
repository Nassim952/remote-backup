<head>
    <title>Suprressiod'un film</title>
</head>

<div class="site-content">
    <div id="head-title">
        <h2 style="font-size:32px;">Edition d'un film</h2>
    </div>
    <div id="separation-bar"></div>
    <div class="lists-film">
        <table class="table-wrapper">
            <tr class="tr-container">
                <?php
                    foreach($pages as $page):
                ?>
                    <td class="td-dashboard-wrapper">
                        <div class="pretty p-default p-curve p-bigger cb-fixer">
                            <input type="checkbox">
                            <div class="state p-danger">
                                <label></label>
                            </div>
                        </div>
                        <p id="text-wrappe"><?= $page->getTitle() ?></p>
                    
                        <p id="hour-wrappe"><?= $page->getTheme() ?></p>
                        <form name='form-delete-page' method="POST">
                            <input type="hidden" name="id" value="<?=$page->getId() ?>">
                            <div class="icons-wrapper">
                                <button type="submit" class="fas fa-edit fa-lg"></a>
                            </div>
                        </form>
                    </td>
                    <?php endforeach; ?>
            </tr>
        </table>
</div>


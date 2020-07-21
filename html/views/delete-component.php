<head>
    <title>Suprression d'un component</title>
</head>

<div class="site-content">
    <div id="head-title">
        <h2 style="font-size:32px;">Suppression d'un component</h2>
    </div>
    <div id="separation-bar"></div>
    <div class="lists-film">
        <table class="table-wrapper">
            <tr class="tr-container">
                <?php
                    foreach($components as $component):
                ?>
                    <td class="td-dashboard-wrapper">
                        <div class="pretty p-default p-curve p-bigger cb-fixer">
                            <input type="checkbox">
                            <div class="state p-danger">
                                <label></label>
                            </div>
                        </div>
                        <p id="text-wrappe"><?= $component->getTitle() ?></p> | <p id="hour-wrappe"><?= $component->getClass() ?></p>
                        <form name='form-delete-movie' method="POST">
                            <input type="hidden" name="id" value="<?= $component->getId() ?>">
                            <div class="icons-wrapper">
                                <button type="submit" class="fas fa-trash-alt fa-lg"></a>
                            </div>
                        </form>
                    </td>
                <?php endforeach; ?>
            </tr>
        </table>
</div>


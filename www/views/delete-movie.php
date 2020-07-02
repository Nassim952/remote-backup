<head>
    <title>Suprressiod'un film</title>
</head>

<div class="site-content">
    <div id="head-title">
        <h2 style="font-size:32px;">Suppression d'un film</h2>
    </div>
    <div id="separation-bar"></div>
    <div class="lists-film">
        <table class="table-wrapper">
            <tr class="tr-container">
                <?php
                    foreach($movies as $movie):
                ?>
                    <td class="td-dashboard-wrapper">
                        <div class="pretty p-default p-curve p-bigger cb-fixer">
                            <input type="checkbox">
                            <div class="state p-danger">
                                <label></label>
                            </div>
                        </div>
                        <p id="text-wrappe"><?= $movie->getTitle() ?></p> | <p id="hour-wrappe"><?= $movie->getDuration() ?></p>
                        <form name='form-delete-movie' method="POST">
                            <input type="hidden" name="id" value="<?= $movie->getId() ?>">
                            <div class="icons-wrapper">
                                <button type="submit" class="fas fa-trash-alt fa-lg"></a>
                            </div>
                        </form>
                    </td>
                <?php endforeach; ?>
            </tr>
        </table>
</div>


<head>
    <title>Edition d'un cinema</title>
</head>


<div class="site-content">
    <div id="head-title">
        <h2 style="font-size:32px;">Edition d'un cinema</h2>
    </div>
    <div id="separation-bar"></div>
    <div class="lists-film">
        <table class="table-wrapper">
            <tr class="tr-container">
                <?php
                    foreach($cinemas as $cinema):
                    ?>
                <td class="td-dashboard-wrapper">
                    <div class="pretty p-default p-curve p-bigger cb-fixer">
                        <input type="checkbox">
                        <div class="state p-danger">
                            <label></label>
                        </div>
                    </div>
                    <p id="text-wrappe"><?= $cinema->getName(); ?></p>
                    |
                    <p id="hour-wrappe"><?= $cinema->getPlace(); ?></p>
                    <form name='delete-cinema' method="POST">
                        <input	type="hidden" name="id" value="<?= $cinema->getId() ?>">
                        <div class="icons-wrapper">
                            <button type="submit" class="fas fa-edit fa-lg"></button>
                        </div>
                    </form>
                </td>
                <?php endforeach; ?>
            </tr>
        </table>
    </div>
    </body>
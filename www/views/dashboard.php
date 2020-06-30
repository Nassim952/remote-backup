<head>
    <title>Dashboard</title>
</head>


<div class="site-content">
    <div id="head-title">
        <h2 style="font-size:32px;">Films</h2>
    </div>
    <div id="separation-bar"></div>
    <div class="quick-tools">
        <div id="space-icons">
            <a href="<?= \cms\core\Helpers::getUrl("Dashboard","addfilm") ?>" class="fas fa-plus fa-lg"></a>
            <a href="#" class="fas fa-trash-alt fa-lg"></a>
        </div>
    </div>
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
                    <p id="text-wrappe"><?= $movie->getTitle(); ?></p>
                    |
                    <p id="hour-wrappe"><?= $movie->getDuration(); ?></p>
                    <div class="icons-wrapper">
                        <a href="#" class="fas fa-edit fa-lg"></a>
                        <a href="#" class="fas fa-trash-alt fa-lg"></a>
                    </div>
                </td>
                    <?php endforeach; ?>
            </tr>
        </table>
    </div>
    </body>
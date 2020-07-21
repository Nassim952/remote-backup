<head>
    <title>Cinema</title>
</head>


<div class="site-content">
    <div id="head-title">
        <h2 style="font-size:32px;">Cinema</h2>
    </div>
    <div id="separation-bar"></div>
    <div class="quick-tools">
        <div id="space-icons">
            <?php if(reset($current_user)->getAllow() >= 2): ?>
                <a href="<?= cms\core\Helpers::getUrl('Cinema','addCinema') ?>" class="fas fa-plus fa-lg"></a>
            <?php endif;?>
        </div>
    </div>
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
                    <a href="show-cinema/<?= $cinema->getId() ?>" id="text-wrappe"><?= $cinema->getName(); ?></a>
                    |
                    <p id="hour-wrappe"><?= $cinema->getPlace(); ?></p>
                </td>
                <?php endforeach; ?>
            </tr>
        </table>
    </div>
    </body>
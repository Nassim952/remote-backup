<head>
    <title>Dashboard</title>
</head>


<div class="site-content">
    <div id="head-title">
        <h2 style="font-size:32px;">Cinema</h2>
    </div>
    <div id="separation-bar"></div>
    <div class="quick-tools">
        <div id="space-icons">
            <a href="#" class="fas fa-plus fa-lg"></a>
            <a href="#" class="fas fa-trash-alt fa-lg"></a>
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
                    <p id="text-wrappe"><?= $cinema->getName(); ?></p>
                    |
                    <p id="hour-wrappe"><?= $cinema->getPlace(); ?></p>
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
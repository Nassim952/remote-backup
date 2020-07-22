<head>
    <title>Dashboard</title>
</head>


<div class="site-content">
<?php 
if(isset($_GET['message']) && !empty($_GET['message'])) {
    echo '<p style="width: 100%; background-color: #5aab5a40; color: #07750a; padding: 10px; margin: auto; text-align:center">' . urldecode($_GET['message']) . '</p>';
} 
?>
    <div id="head-title">
        <h2 style="font-size:32px;">Films</h2>
    </div>
    <div id="separation-bar"></div>
    <div class="quick-tools">
        <div id="space-icons">
            <a href="<?= \cms\core\Helpers::getUrl("Movie","addFilm") ?>" class="fas fa-plus fa-lg"></a>
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
                        <a id="text-wrappe" href="show-movie/<?= $movie->getId() ?>"><?= $movie->getTitle() ?></a>
                        |
                        <p id="hour-wrappe"><?= $movie->getDuration() ?></p>
                    </td>
                <?php endforeach; ?>
            </tr>
        </table>
    </div>
    </body>
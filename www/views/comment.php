<head>
    <title>Cinema</title>
</head>


<div class="site-content">
    <div id="head-title">
        <h2 style="font-size:32px;">Commentaires</h2>
    </div>
    <div id="separation-bar"></div>
    <div class="quick-tools">
        <div id="space-icons">
            <a href="<?= cms\core\Helpers::getUrl('Comment','addComment') ?>" class="fas fa-plus fa-lg"></a>
        </div>
    </div>
    <div class="lists-film">
        <table class="table-wrapper">
            <tr class="tr-container">
                <?php
                    foreach($comments as $comment):
                    ?>
                <td class="td-dashboard-wrapper">
                    <div class="pretty p-default p-curve p-bigger cb-fixer">
                        <input type="checkbox">
                        <div class="state p-danger">
                            <label></label>
                        </div>
                    </div>
                    <a href="show-comment/<?= $comment->getId() ?>" id="text-wrappe"><?= $comment->getComment(); ?></a>
                    <p id="hour-wrappe"><?= $comment->getPost_date() ?></p>
                </td>
                <?php endforeach; ?>
            </tr>
        </table>
    </div>
    </body>
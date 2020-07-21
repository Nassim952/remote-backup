<head>
    <title>Edition d'un commentaire</title>
</head>

<div class="site-content">
    <div id="head-title">
        <h2 style="font-size:32px;">Edition d'un commentaire</h2>
    </div>
    <div id="separation-bar"></div>
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
                        <p id="text-wrappe"><?= $comment->getComment() ?></p>
                        |
                        <p id="hour-wrappe"><?= $comment->getPostDate() ?></p>
                        <form name='form-delete-movie' method="POST">
                            <input type="hidden" name="id" value="<?=$comment->getId() ?>">
                            <div class="icons-wrapper">
                                <button type="submit" class="fas fa-edit fa-lg"></a>
                            </div>
                        </form>
                    </td>
                    <?php endforeach; ?>
            </tr>
        </table>
</div>


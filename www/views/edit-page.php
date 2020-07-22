<head>
    <title>Edition d'une page</title>
</head>

<div class="site-content">
    <div id="head-title">
        <h2 style="font-size:32px;">Edition d'une page</h2>
    </div>
    <div id="separation-bar"></div>
    <div class="lists-film">
        <table class="table-wrapper">
            <tr class="tr-container">
                <?php
                    foreach($page as $myPage):
                ?>
                    <form enctype="multipart/form-data" class=add-film method="post">
                        <div class="flex-form-container">
                            <div class="flex-form-content-left">
                            <h2>Page template :</h2>
                            <input class="input-form cinema-title" type="text" name="title" value="<?= $myPage->getTitle(); ?>"></input>
                                <select type="select" class=input-form  type="int" name="gabarit">
                                    <option value="<?= $myPage->getGabarit(); ?>"> <?= $myPage->getGabarit(); ?> row</option>
                                    <option value="1"> 1 row</option>
                                    <option value="2"> 2 row</option>
                                    <option value="3"> 3 row</option>
                                </select>
                                <select type="select" class=input-form  type="int" name="theme">
                                    <option value="<?= $myPage->getTheme(); ?>"> <?= $myPage->getTheme(); ?></option>
                                    <option value="Bleu">Blue</option>
                                    <option value="Rouge">Black</option>
                                    <option value="Gris">Grey</option>
                                </select>
                                <select type="select" class=input-form  type="int" name="font">
                                    <option value="<?= $myPage->getFont(); ?>"> <?= $myPage->getFont(); ?></option>
                                    <option value="Roboto">Roboto</option>
                                    <option value="Arial">Arial</option>
                                    <option value="Serial">Serial</option>
                                </select>
                                <select type="select" class=input-form  type="int" name="font_color">
                                    <option value="<?= $myPage->getFont_color(); ?>"> <?= $myPage->getFont_color(); ?></option>
                                    <option value="Roboto">Blue</option>
                                    <option value="Arial">Lightgrey</option>
                                    <option value="Serial">Black</option>
                                </select>
                                <select type="select" class=input-form  type="int" name="font_color">
                                    <option value="<?= $myPage->getFont_color(); ?>"> <?= $myPage->getFont_color(); ?></option>
                                    <option value="Roboto">Blue</option>
                                    <option value="Arial">Lightgrey</option>
                                    <option value="Serial">Black</option>
                                </select>
                                <button class="Button" type="submit">Valider</button>
                            </div>
                        </div>
                        
                    </form>
                <?php endforeach; ?>
            </tr>
        </table>
</div>


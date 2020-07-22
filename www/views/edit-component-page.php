<head>
    <title>Edition d'un component</title>
</head>

<div class="site-content">
    <div id="head-title">
        <h2 style="font-size:32px;">Edition d'un component</h2>
    </div>
    <div id="separation-bar"></div>
    <div class="lists-film">
        <table class="table-wrapper">
            <tr class="tr-container">
                    <div class="flex-form-container">
                        <div class="flex-form-content-left">
                            <form method="POST">
                                <select type="select" class=input-form  type="int" name="categorie">
                                    <?php foreach($component as $myComponent): ?>
                                        <option value="<?= $myComponent->getCategorie(); ?>"> <?= $myComponent->getCategorie(); ?></option>
                                    <?php endforeach;?>
                                </select>
                                <button class="Button" type="submit">Valider</button>
                            </form>
                        </div>
                    </div>
            </tr>
        </table>
</div>


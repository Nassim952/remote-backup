<head>
    <title>NEAR BY - Vérifier votre Email !</title>
</head>

<main class="container">
    <section class="section1">
        <!-- IMAGE RED.PNG -->
    </section>

    <section class="section2">
        <header class="headerSection2">
            <div class="containerImg">
                <img src="../../src/images/logo.png">
            </div>
        </header>

        <section class="sectionSignup">
            <h1> Votre compte n'est pas encore vérifié ! </h1>
            <h1 style="margin-top:50px;"> Vérifier votre compte en cliquant sur le lien envoyé dans votre boîte mail</h1>
            <div style="display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 130px;">
                <a class="Button" href="<?= cms\core\Helpers::getUrl('User', 'signin') ?>">Retour</a>
            </div>
        </section>
    </section>
</main>
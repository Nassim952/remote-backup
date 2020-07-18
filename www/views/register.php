<?php 
    session_start();
    session_destroy();
?>

<head>
	<title>NEAR BY - Inscription</title>
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
            <h1> Inscrivez-vous ! </h1>
            <br>
            <br>
            <div class="divInput">
                <?php $this->formView('configFormUser')?>
            </div>
            <div class="button_wrapper">
                <a href="<?= \cms\core\Helpers::getUrl("User", "login") ?>" class="button" style="margin-top: 20px;">Déjà un compte ?</a>
            </div>
        </section>
    </section>
</main>
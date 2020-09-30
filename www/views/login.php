<head>
	<title>NEAR BY - Connexion</title>
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
			<h1> Connectez-vous ! </h1>
			<br>
			<br>
			<div class="divInput">
				<?php $this->formView('configFormUser')?>
			</div>
			<div class="button_wrapper">
				<a href="<?= \cms\core\Helpers::getUrl("User", "register") ?>" id="no-decoration" class="button" style="margin-top: 20px; width:auto;">Pas de compte ?</a>
				<a href="<?= \cms\core\Helpers::getUrl("User", "forgetPassword") ?>" class="button" id="no-decoration" style="margin-top: 20px; width:auto;">mot de passe oublié ?</a>
			</div>
		</section>
	</section>
</main>
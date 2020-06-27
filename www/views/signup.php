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
			<h1>Créez votre compte !</h1>
			<br>
			<div class="divInput">
			
			<?php $this->addModal("form", $configFormUser->getForm() );?>

				<div class="divCheckbox">
					<input type="checkbox">
					<label>J'accepte les conditions générales</label>
					<br>
					<input type="checkbox">
					<label>J'accepte de recevoir des offres spéciales par mail</label>
				</div>
				<br>
				<div class="button_wrapper">
					<a href="#" class="button">S'inscrire</a>
					<a href="<?= \cms\core\Helpers::getUrl("User", "signin") ?>" class="button" style="margin-top: 20px;">Déjà un compte ?</a>
				</div>
			</div>
		</section>
	</section>
</main>
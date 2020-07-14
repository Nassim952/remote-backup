<?php 
	session_start();
	isset($_SESSION['user']) ? session_destroy() : '' ;
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
			<h1>Créez votre compte !</h1>
			<br>
			<div class="divInput">
			<form name="form_inscription" action="" method="post">
					<input type="text" name="firstname" id="firstname" placeholder="Prenom">
					<input type="text" name="lastname" id="lastname" placeholder="Nom">
					<br>
					<input type="email" name="email" id="email" placeholder="Email">
					<br>
					<input type="password" name="password" id="" placeholder="Mot de passe">
					<br>
					<input type="password" name="confirmpwd" id="" placeholder="Confirmer mot de passe">
					<br>
					<div class="divCheckbox">
						<input type="checkbox">
						<label>J'accepte les conditions générales</label>
						<br>
						<input type="checkbox">
						<label>J'accepte de recevoir des offres spéciales par mail</label>
					</div>
					<br>
					<div class="button_wrapper">
						<button type="submit" class="button">S'inscrire</button>
						<a href="<?= \cms\core\Helpers::getUrl("User", "signin") ?>" class="button" style="margin-top: 20px;">Déjà un compte ?</a>
					</div>
				</form>
			</div>
		</section>
	</section>
</main>
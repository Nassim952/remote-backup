<?php 
	session_start();
	isset($_SESSION['user']) ? session_destroy() : '' ;
?>
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
				<form name="form_connexion" action="" method="post">
					<input type="email" name="email" id="email" placeholder="Email">
					<br>
					<input type="password" name="password" id="" placeholder="Mot de passe">
					<br>
					<div class="label-password">
						<input type="checkbox"/>
						<span style="margin-right: 30%; padding: 9px;">Se souvenir de moi</span>
						<span>Mot de passe oublié ?</span>
					</div>
					<div class="divCheckbox">
						<img src="images/image-2.png" style="    width: 60%;
						margin-top: 15px;
						margin-left: 20%;"/>
					</div>
					<br>
					<br>
					<div class="button_wrapper">
						<button type="submit" class="button">Se connecter</button>
						<a href="<?= \cms\core\Helpers::getUrl("User", "signup") ?>" class="button" style="margin-top: 20px;">Pas de compte ?</a>
					</div>
				</form>
			</div>
		</section>
	</section>
</main>
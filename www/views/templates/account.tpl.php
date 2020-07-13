<!DOCTYPE html>
<html lang="fr">

<?php 
	session_start();
	isset($_SESSION['user']) ? session_destroy() : '' ;
?>

<head>
	<title>NEAR BY - Inscription</title>
</head>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
		<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.min.css'>
		<link rel="stylesheet" href="../../css/signup-signin.css"/>
		<link rel="stylesheet" href="../../css/mediaqueries.css"/>
		<script src="https://cdn.ckeditor.com/ckeditor5/20.0.0/classic/ckeditor.js"></script>
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
				<h1>Créez votre compte ! </h1>
				<br>
				<div class="divInput">
					<?php $this->formView('configFormUser')?>
				</div>
			</section>
		</section>
	</main>

</html>

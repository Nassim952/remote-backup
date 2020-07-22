<?php 
	$url = $_SERVER["REQUEST_URI"];
	$uri = parse_url($url, PHP_URL_PATH);
	if($uri != '/register'){
		session_start();
	}
	isset($_SESSION['userId']) ? session_destroy() : '' ;
?>
<head>
	<title>NEAR BY - Account</title>
</head>

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

	<!-- INCLUDE VIEWS HERE -->
	<?php include "views/".$this->view.".php"?>
	<!-- END INCLUDE VIEWS -->

</html>

<?php
	session_start();
	if (!isset($_SESSION['filename'])) header("Location: ./index.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Успешно!</title>
	<script src="js/font-loader.js"></script>
</head>
<body>
<style>
	* {
		margin: 0;
		padding: 0;
	}
	html {
		height: 100%;
		width: 100%;
	}
	body {
		position: relative;
		text-align: center;
		background-color: #5eba6e;
		color: #fff;
		font-family: 'Raleway-SemiBold';
		font-size: 15px;
		position: absolute;
		left: 0;
		top: 0;
		width: 100%;
		height: 100%;
	}
	.guitar {
		width: 256px;
		height: 256px;
		background: url(img/guitar.png);
		position: absolute;
		left: 0;
		bottom: 0;
	}
	.title {
		font-size: 25px;
		margin-bottom: 45px;
		text-shadow: 0 3px 5px rgba(0,0,0,.2);
		position: relative;
		margin-top: 200px;
	}
	.title::before {
		content: "";
		display: block;
		width: 64px;
		height: 64px;
		background: url(img/smile.png) no-repeat;
		position: absolute;
		top: -100px;
		left: 50%;
		margin-left: -32px;
	}
	.back {
		color: #000;
		background: #fff;
		text-decoration: none;
		padding: 7px 0;
		border-radius: 4px;
		margin-top: 100px;
		display: block;
		width: 130px;
		margin: 45px auto;
	}

	@media (max-width: 767.98px) {
		.guitar {
			display: none;
		}
	}
</style>
	<h1 class='title'>Ваша заявка успешно отправлена!</h1>
<a href="./" class="back">На главную</a>
<div class="guitar"></div>
</body>
</html>
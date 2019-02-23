<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Заявка Вертикаль <?php echo date('Y'); ?></title>
		<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
		<script src="js/font-loader.js"></script>
		<link rel="stylesheet" href="css/libs.min.css">
		<link rel="stylesheet" href="css/main.min.css">
		<script src="js/libs.min.js"></script>
		<style>
			.header {
				height: 100%;
			}
			.header::before {
				display: none;
			}
			.main_title {
				margin-top: 150px;
			}
		</style>
	</head>
	<body>
		<div class="info-block">
			<a href="http://вертикаль-личность.рф/data/documents/Finansovye-usloviya-konkursa-Vertikal-Lichnost.doc" download><div class="info-msg">Финансовые условия (очно)</div></a>
			<a href="docs/Polozhenie_konkursa.doc" download><div class="info-msg info-rules">Положение</div></a>
			<a href="docs/Press-reliz.doc" download><div class="info-msg info-press">Пресс-релиз</div></a>
			<a><div class="info-msg info-email">konkursvertikal@mail.ru</div></a>
		</div>

		<section class="header section section_green">
			<h1 class="section__title main_title">Выберите форму участия</h1>
			<div class="join_form">
				<a href="join.php" class="join_btn join_o">Очная форма</a>
				<a href="join.php?ex=1" class="join_btn join_z">Заочная форма</a>
			</div>
		</section>
	</body>
</html>
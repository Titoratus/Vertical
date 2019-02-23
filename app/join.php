<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Заявка Вертикаль</title>
		<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
		<script src="js/font-loader.js"></script>
		<link rel="stylesheet" href="css/libs.min.css">
		<link rel="stylesheet" href="css/main.min.css">
		<script src="js/libs.min.js"></script>
	</head>
	<body>
		<div class="info-block">
			<a href="<?= isset($_GET["ex"]) ? 'http://вертикаль-личность.рф/data/documents/Finansovye-usloviya-konkursa-ZAochno.doc' : 'http://вертикаль-личность.рф/data/documents/Finansovye-usloviya-konkursa-Vertikal-Lichnost.doc'; ?>" download><div class="info-msg">Финансовые условия <?= isset($_GET["ex"]) ? "(заочно)" : "(очно)"; ?></div></a>
			<a href="docs/Polozhenie_konkursa.doc" download><div class="info-msg info-rules">Положение</div></a>
			<a href="docs/Press-reliz.doc" download><div class="info-msg info-press">Пресс-релиз</div></a>
			<a><div class="info-msg info-email">konkursvertikal@mail.ru</div></a>
		</div>

		<form id="vertikal" method="POST" enctype="multipart/form-data" action="getData.php">
			<section class="header section section_green">
				<h1 class="section__title main_title">Заявка на <?= isset($_GET["ex"]) ? "заочное" : "очное"; ?> участие в конкурсе «Вертикаль – Личность»</h1>
				<div class="formWrap">
						<ul class="radioWrap">
							<li class="radio radioGroup radio_active">Коллектив</li>
							<li class="radio radioMember">Участник</li>
						</ul>					
					<div class="tabs">
						<div class="tabs__wrap">
							<div class="tabs__tab activeTab">
								<div class="groupForm">

									<div class="wrapper">
										<label class="label" for="groupName">Название коллектива</label>
										<input class="input" id="groupName" type="text" name="groupName" pattern="^[a-zA-Z0-9_А-Яа-яЁё\s]{2,}$" title="Только буквы или цифры!" required>
									</div>

									<div class="wrapper">
										<label class="label" for="groupAmount">Количество человек</label>
										<input class="input" id="groupAmount" type="text" name="groupAmount" maxlength="2" pattern="^[ 0-9]+$" title="Только цифры!" required>
									</div>									

									<div class="wrapper">
										<label class="label">Возрастная категория</label>
										<select class="input" name="ageCategory" required>
											<option value="3-6 лет" selected>3-6 лет</option>
											<option value="7-9 лет">7-9 лет</option>
											<option value="10-12 лет">10-12 лет</option>
											<option value="13-15 лет">13-15 лет</option>
											<option value="16-19 лет">16-19 лет</option>
											<option value="20-25 лет">20-25 лет</option>
											<option value="25 лет и старше">25 лет и старше</option>
											<option value="Смешанная">Смешанная</option>
											<option value="Профессионал">Профессионал</option>
											<option value="Мастер и ученик">Мастер и ученик</option>
										</select>										
									</div>	

									<div class="wrapper">
										<label class="label label_inline">Место жительства</label>
										<select class="input input_select memberPlace" name="memberPlace" required>
											<option value="mem_opt1">Красноярск</option>
											<option value="mem_opt2">Иногородние</option>
										</select>									
									</div>									

									<div class="wrapper">
										<label class="label">Категория образования</label>
										<select class="input input_select cathegory" name="cathegory" required>
											<option value="cath_opt1">Профессиональное</option>
											<option value="cath_opt2">Самостоятельное</option>
											<option value="cath_opt3">Профессионалы</option>
											<option value="cath_opt4">Любительская студия</option>
										</select>									
									</div>

									<div class="wrapper">
										<label class="label">Номинация</label>
										<select class="input input_select" name="nomination" required onchange="checkChoice(this);">
											<option selected disabled value="">Выберите номинацию</option>
											<option value="Вокальное исполнительство">Вокальное исполнительство</option>
											<option value="Инструментальное исполнительство">Инструментальное исполнительство</option>
											<option value="Изобразительное искусство">Изобразительное искусство</option>
											<option value="Художественное слово">Художественное слово</option>
											<option value="Театр">Театр</option>
											<option value="Цирковое искусство">Цирковое искусство</option>
											<option value="Хореография">Хореография</option>
										</select>										
									</div>

									<div class="wrapper">
										<label class="label">Жанровое направление</label>
										<select class="input input_select" name="genre" required>
											<option value="Академический">Академическое</option>
											<option value="Народный">Народное</option>
											<option value="Эстрадный">Эстрадное</option>
										</select>
									</div>

									<div class="wrapper">
										<label class="label">Вид</label>
										<select class="input input_select" name="kind" required onchange="kindChoice(this);">
											<option value="Ансамблевое">Ансамблевое</option>
											<option value="Хоровое">Хоровое</option>
											<option value="Оркестр">Оркестр</option>
											<option value="ВИА">ВИА (инструментальный ансамбль)</option>
											<option value="Шоу">Шоу</option>
											<option value="Коллективное творчество">Коллективное творчество (в ИЗО)</option>
										</select>
									</div>																	

								</div>		
							</div>

							<div class="tabs__tab">
								<div class="groupForm">
									
									<div class="wrapper">
										<label class="label" for="memberName">Полное Имя</label>
										<input class="input" id="memberName" type="text" name="memberName" required>
									</div>

									<div class="wrapper">
										<label class="label" for="memberSurname">Фамилия</label>
										<input class="input" id="memberSurname" type="text" name="memberSurname" required>
									</div>								

									<div class="wrapper">
										<label class="label">Возрастная категория</label>
										<select name="ageCategory" class="input input_select" required>
											<option value="3-6 лет">3-6 лет</option>
											<option value="7-9 лет">7-9 лет</option>
											<option value="10-12 лет">10-12 лет</option>
											<option value="13-15 лет">13-15 лет</option>
											<option value="16-19 лет">16-19 лет</option>
											<option value="20-25 лет">20-25 лет</option>
											<option value="25 лет и старше">25 лет и старше</option>
											<option value="Смешанная">Смешанная</option>
											<option value="Профессионал">Профессионал</option>
											<option value="Мастер и ученик">Мастер и ученик</option>
										</select>
									</div>

									<div class="wrapper">
										<label class="label">Место жительства</label>
										<select class="input input_select  memberPlace" name="memberPlace" required>
											<option value="mem_opt1">Красноярск</option>
											<option value="mem_opt2">Иногородний</option>
										</select>
									</div>									

									<div class="wrapper">
										<label class="label">Категория образования</label>
										<select class="input input_select  cathegory" name="cathegory" required>
											<option value="cath_opt1">Профессиональное</option>
											<option value="cath_opt2">Самостоятельное</option>
											<option value="cath_opt3">Профессионал</option>
											<option value="cath_opt4">Любительская студия</option>
										</select>			
									</div>

									<div class="wrapper">
										<label class="label">Номинация</label>
										<select class="input input_select" name="nomination" required onchange="checkChoice(this);">
											<option selected disabled value="">Выберите номинацию</option>										
											<option value="Вокальное исполнительство">Вокальное исполнительство</option>
											<option value="Инструментальное исполнительство">Инструментальное исполнительство</option>
											<option value="Изобразительное искусство">Изобразительное искусство</option>
											<option value="Художественное слово">Художественное слово</option>
											<option value="Театр">Театр</option>
											<option value="Цирковое искусство">Цирковое искусство</option>
											<option value="Хореография">Хореография</option>
										</select>
									</div>

									<div class="wrapper">
										<label class="label">Жанровое направление</label>
										<select class="input input_select" name="genre" required>
											<option value="Академический">Академическое</option>
											<option value="Народный">Народное</option>
											<option value="Эстрадный">Эстрадное</option>
										</select>
									</div>
								</div>
							</div>
						</div>		
					</div>
				</div>			
			</section>
			<section class="section contest">
				<h2 class="section__title section__title_black section__title_nomargin">Конкурсная программа</h2>

				<div class="formWrap">
					<div class="contestForm">
						<div class="wrapper wrapper_block">
							<label for="compos_name1" class="label label_black">Название произведения</label>
							<span class="alert">Писать в верной последовательности, грамматически точно! Например, Ария Канио из оперы Руджеро Леонковалло "Паяцы"</span>
							<input type="text" class="input input_black" id="compos_name1" name="compos_name1" required>
						</div>
						<div class="wrapper wrapper_block">
							<label for="compos_author1" class="label label_black">Авторы: музыки, слов, аранжировки, инструментовки, сценария...</label>
							<label for="compos_author1" class="label label_black">Полное Имя и Фамилия</label>
							<input type="text" class="input input_black" id="compos_author1" name="compos_author1" required>
						</div>
						<div class="wrapper wrapper_small">
							<label for="compos_time1" class="label label_black">Хронометраж</label>
							<input type="text" class="input input_black" id="compos_time1" name="compos_time1" placeholder="2:49" required>
						</div>
						<div class="wrapper wrapper_small">
							<label for="micros1" class="label label_black">Микрофонов</label>
							<input type="text" class="input input_black" id="micros1" maxlength="2" name="micros1" placeholder="3" required>
						</div>					
						<div class="wrapper wrapper_small wrapper_nomargin">
							<label for="stands1" class="label label_black">Стоек</label>
							<input type="text" class="input input_black" id="stands1" name="stands1" maxlength="2" placeholder="1" required>
						</div>

						<div class="wrapper wrapper_block">
							<label for="feature" class="label label_black">Для публикации статьи о коллективе на информационном сайте организаторов фестиваля
	необходима краткая характеристика коллектива (звание, самый последний завоёванный  титул)</label>
							<input type="text" class="input input_black" id="feature" name="feature" required>
						</div>
					</div>
				</div>
			</section>

			<section class="teacher section section_orange">
				<h2 class="section__title title_teacher">Информация о руководителе</h2>
				<div class="formWrap">
					<div class="teacherForm">
						<div class="teacher_wrap">
							<div class="wrapper wrapper_block">
								<label for="teacher_who" class="label">Руководитель</label>
								<span class="input_tip">Например, преподаватель, мама, папа...</span>
								<input type="text" class="input" id="teacher_who" name="teacher_who" required>
							</div>					
							<div class="wrapper">
								<label for="teacher_name" class="label">Полное Имя</label>
								<input type="text" class="input" id="teacher_name" name="teacher_name" required>
							</div>
							<div class="wrapper">
								<label for="teacher_father" class="label">Отчество</label>
								<input type="text" class="input" id="teacher_father" name="teacher_father" required>
							</div>
							<div class="wrapper">
								<label for="teacher_surname" class="label">Фамилия</label>
								<input type="text" class="input" id="teacher_surname" name="teacher_surname" required>
							</div>	
							<div class="wrapper">
								<label for="teacher_phone" class="label">Телефон руководителя</label>
								<input type="text" class="input" id="teacher_phone" name="teacher_phone" required>
							</div>
						</div>		
						<div class="wrapper">
							<label for="member_phone" class="label">Телефон участника</label>
							<input type="text" class="input" id="member_phone" name="member_phone" required>
						</div>	
						<div class="wrapper">
							<label for="member_email" class="label">Email участника</label>
							<input type="text" class="input" id="member_email" name="member_email" placeholder="example@mail.ru" required>
						</div>			
						<div class="wrapper wrapper_block">
							<div class="workplace" style="display: none;">
								<label class="label">Место работы</label>
								<input type="text" class="input" name="member_workplace" required disabled>								
							</div>
							<div class="school">
								<label for="member_agency" class="label">Учреждение, представляющее участника</label>
								<input type="text" class="input" id="member_agency" name="member_agency" required>								
							</div>
						</div>												
					</div>

					<div class="directorWrap">
						<h3 class="section__title section__title_small">Директор учреждения</h3>
						<div class="directorForm">
							<div class="wrapper">
								<label for="dir_name" class="label">Полное Имя</label>
								<input type="text" class="input" id="dir_name" name="dir_name" required>
							</div>
							<div class="wrapper">
								<label for="dir_father" class="label">Отчество</label>
								<input type="text" class="input" id="dir_father" name="dir_father" required>
							</div>		
							<div class="wrapper">
								<label for="dir_surname" class="label">Фамилия</label>
								<input type="text" class="input" id="dir_surname" name="dir_surname" required>
							</div>	
							<div class="wrapper">
								<label for="dir_email" class="label">Email учреждения</label>
								<input type="text" class="input" id="dir_email" name="dir_email" placeholder="example@mail.ru" required>
							</div>																
						</div>
					</div>

				</div>				
			</section>

			<section class="teacher section section_orange">
				<h2 class="section__title">Информация о постановочной группе
				<p class="section__tip">При отсутствии концертмейстера, режиссёра или хореографа-постановщика, <b>оставьте поля пустыми</b>.</p>
				</h2>

				<div class="formWrap">
					<h3 class="section__title section__title_little">Концертмейстер</h3>
					<div class="wrapper wrapper_block">
						<label class="label">Полное Имя</label>
						<input type="text" name="author_1_name" class="input">						
					</div>
					<div class="wrapper">
						<label class="label">Фамилия</label>
						<input type="text" name="author_1_surname" class="input">		
					</div>					
					<div class="wrapper wrapper_nomargin">
						<label class="label">Отчество</label>
						<input type="text" name="author_1_father" class="input">		
					</div>

					<h3 class="section__title section__title_little">Режиссёр</h3>
					<div class="wrapper wrapper_block">
						<label class="label">Полное Имя</label>
						<input type="text" name="author_2_name" class="input">						
					</div>
					<div class="wrapper">
						<label class="label">Фамилия</label>
						<input type="text" name="author_2_surname" class="input">		
					</div>					
					<div class="wrapper wrapper_nomargin">
						<label class="label">Отчество</label>
						<input type="text" name="author_2_father" class="input">		
					</div>


					<h3 class="section__title section__title_little">Хореограф-постановщик</h3>
					<div class="wrapper wrapper_block">
						<label class="label">Полное Имя</label>
						<input type="text" name="author_3_name" class="input">						
					</div>
					<div class="wrapper">
						<label class="label">Фамилия</label>
						<input type="text" name="author_3_surname" class="input">		
					</div>					
					<div class="wrapper wrapper_nomargin">
						<label class="label">Отчество</label>
						<input type="text" name="author_3_father" class="input">		
					</div>

					<h3 class="section__title section__title_little">Репетитор</h3>
					<div class="wrapper wrapper_block">
						<label class="label">Полное Имя</label>
						<input type="text" name="author_4_name" class="input">						
					</div>
					<div class="wrapper">
						<label class="label">Фамилия</label>
						<input type="text" name="author_4_surname" class="input">		
					</div>					
					<div class="wrapper wrapper_nomargin">
						<label class="label">Отчество</label>
						<input type="text" name="author_4_father" class="input">		
					</div>					

					<div class="wrapper wrapper_nomargin">
						<label class="label">Участие в доп. номинации</label>
						<select name="extra_nomin" class="input input_select">
							<option value="Нет">Нет</option>
							<option value="Да">Да</option>
						</select>
					</div>
				</div>

				<?php if (isset($_GET["ex"])): ?><input type="hidden" name="ex" value="1"><?php endif; ?>

				<input type="submit" class="sendAll" value="ОТПРАВИТЬ ЗАЯВКУ" onsubmit="JavaScript:this.subbut.disabled=true">
				<label class="agreement">Отправляя форму, вы даёте согласие на обработку своих персональных данных.</label>
			</section>
		</form>

		<script src="js/script.js"></script>	
	</body>
</html>
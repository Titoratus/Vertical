<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	header('Content-Type: text/html; charset=utf-8');
	session_start();

	//Подключение Яндекс.Диска
	require_once 'phar://yandex-php-library_master.phar/vendor/autoload.php';

	use Yandex\Disk\DiskClient;

	//Устанавливаем полученный токен
	$disk = new DiskClient('');
	$disk->setServiceScheme(DiskClient::HTTPS_SCHEME);	

	$folder = "Заявки Вертикаль/2019/";
	if (isset($_POST["ex"]))
		$folder .= "Заочно";
	else
		$folder .= "Очно";

	//Создание основной папки для хранения заявок
	if (!file_exists($folder)) {
		mkdir($folder, 0777, true);

		//Если нет такой папки, создаём на ЯД
		try {
			$disk->createDirectory($folder);
		}
		//Если есть, то продолжаем
		catch (Exception $e) {
		}
	}

	//От мультисабмита через адресную строку
	if (empty($_POST['compos_name1'])) header("Location: download.php");
	
	//Коллектив ИЛИ участник
	if (isset($_POST['groupName'])) {
		$groupName = $_POST['groupName'];
		$groupAmount = $_POST['groupAmount'];
	}
	else {
		$memberName = $_POST['memberName'];
		$memberSurname = $_POST['memberSurname'];
	}

	$ageCategory = $_POST["ageCategory"];

	//Красноярск ИЛИ иногородние
	$memberPlace = $_POST['memberPlace'];
	if ($memberPlace == 'mem_opt1') $memberPlace = 'Красноярск';
	//Если коллектив, то окончание ИЕ
	else if (isset($_POST['groupName'])) $memberPlace = "Иногородние";
	else $memberPlace = "Иногородний";

	//Категория
	$cathegory = $_POST['cathegory'];
	switch($cathegory) {
		case 'cath_opt1':
			$cathegory = 'Профессиональное обучение';
			break;
		case 'cath_opt2':
			$cathegory = 'Самостоятельное обучение';
			break;			
		case 'cath_opt3':
			$cathegory = 'Профессионал';
			break;				
		case 'cath_opt4':
			$cathegory = 'Любительская студия';
			break;						
	}

	//--------ЗАПИСЬ В WORD--------
	require_once 'vendor/autoload.php';
	$phpWord = new \PhpOffice\PhpWord\PhpWord();

	$phpWord->setDefaultFontName("Times New Roman");
	$phpWord->setDefaultFontSize(14);

	$sectionStyle = array();
	$section = $phpWord->addSection($sectionStyle);

	//Номинация
	$nomination = $_POST['nomination'];

	//Жанр
	$genre = $_POST["genre"];

	//Для дальнейшего сохранения в папку с номинацией nomForFile
	$nomForFile = $nomination;

	//Создание папки номинации
	if (!file_exists("$folder/".$nomination)) {
		mkdir("$folder/".$nomination, 0777, true);

		try {
			$disk->createDirectory("$folder/".$nomination);
		}
		catch (Exception $e) {
		}
	}

	//--------КОНКУРСНАЯ ПРОГРАММА--------

	//Первое произведение
	$compos_name1 = $_POST['compos_name1'];
	$compos_author1 = $_POST['compos_author1'];
	$compos_time1 = $_POST['compos_time1'];
	$micros1 = $_POST['micros1'];	
	$stands1 = $_POST['stands1'];

	//Доп. информация об участнике
	$feature = $_POST['feature'];		

	$member_phone = $_POST['member_phone'];
	$member_email = $_POST['member_email'];	

	//Директор учреждения
	if ($cathegory != "Профессионал") {
		$dir_name = $_POST['dir_name'];	
		$dir_father = $_POST['dir_father'];	
		$dir_surname = $_POST['dir_surname'];	
		$dir_email = $_POST['dir_email'];

		//Информация о педагоге
		$teacher_name = $_POST['teacher_name'];	
		$teacher_father = $_POST['teacher_father'];	
		$teacher_surname = $_POST['teacher_surname'];	
		$teacher_phone = $_POST['teacher_phone'];
	}

	//Заголовок
	$phpWord->addParagraphStyle('pStyle', array('align'=>'center', 'spaceAfter'=>200));
	$section->addText(
  'Заявка на участие в конкурсе "Вертикаль — Личность"',
  array('bold' => true, 'size' => 16),
  'pStyle'
	);

	if (isset($groupName)) {
		$textrun = $section->createTextRun('TextRun');
		$textrun->addText('Название коллектива: ', array('bold' => true));		
		$parttaker = $groupName;
		$textrun->addText(htmlspecialchars($parttaker), array(), array());

		$textrun = $section->createTextRun('TextRun');
		$textrun->addText('Количество: ', array('bold' => true));		
		$groupAmount = $groupAmount;
		$textrun->addText(htmlspecialchars($groupAmount), array(), array());		 		
	}
	else {
		$textrun = $section->createTextRun('TextRun');
		$textrun->addText('ФИ участника: ', array('bold' => true));			
		$parttaker = $memberSurname.' '.$memberName;
		$textrun->addText(htmlspecialchars($parttaker), array(), array());
	}


	$fileName = $parttaker." ".$ageCategory;

	//Основная информация
	$textrun = $section->createTextRun('TextRun');
	$textrun->addText('Возраст: ', array('bold' => true));
	$textrun->addText(htmlspecialchars($ageCategory), array(), array());

	$textrun = $section->createTextRun('TextRun');
	$textrun->addText('Место жительства: ', array('bold' => true));
	$memberPlace = $memberPlace;
	$textrun->addText(htmlspecialchars($memberPlace), array(), array());

	if (isset($_POST["memberRouteTime"])) {
		$textrun = $section->createTextRun('TextRun');
		$textrun->addText('Время в пути: ', array('bold' => true));
		$textrun->addText(htmlspecialchars($_POST["memberRouteTime"]), array(), array());		
	}

	$textrun = $section->createTextRun('TextRun');
	$textrun->addText('Категория: ', array('bold' => true));
	$textrun->addText(htmlspecialchars($cathegory), array(), array());	

	$textrun = $section->createTextRun('TextRun');
	$textrun->addText('Номинация: ', array('bold' => true));
	$textrun->addText(htmlspecialchars($nomination), array(), array());		

	$textrun = $section->createTextRun('TextRun');

	if ($nomination == "Инструментальное исполнительство") {
		$textrun->addText('Вид инструментов: ', array('bold' => true));
		$textrun->addText(htmlspecialchars($_POST["instr_type"]), array(), array());
		$textrun = $section->createTextRun('TextRun');		
		$textrun->addText('Название нструмента: ', array('bold' => true));
		$textrun->addText(htmlspecialchars($_POST["instr_name"]), array(), array());
		$textrun = $section->createTextRun('TextRun');	
	}

	//Подноминация
	if (isset($_POST["subnomination"])) {
		$textrun->addText('Подноминация: ', array('bold' => true));
		$textrun->addText(htmlspecialchars($_POST["subnomination"]), array(), array());
		$textrun = $section->createTextRun('TextRun');
	}

	//Жанр
	$textrun->addText('Жанр: ', array('bold' => true));
	$textrun->addText(htmlspecialchars($genre), array(), array());		

	$textrun = $section->createTextRun('TextRun');

	//Вид
	if (isset($_POST["kind"])) {
		$textrun->addText('Вид: ', array('bold' => true));
		$textrun->addText(htmlspecialchars($_POST["kind"]), array(), array());
		$textrun = $section->createTextRun('TextRun');

		if ($_POST["kind"] == "Хоровое") {
			$textrun->addText('Подвид: ', array('bold' => true));
			$textrun->addText(htmlspecialchars($_POST["choir_type"]), array(), array());		
			$textrun = $section->createTextRun('TextRun');
		}
		else if ($_POST["kind"] == "ВИА") {
			$textrun->addText('Подвид: ', array('bold' => true));
			$textrun->addText(htmlspecialchars($_POST["via_type"]), array(), array());	
			$textrun = $section->createTextRun('TextRun');			
		}		
	}

	//Произведения
	$compos_name1 = $_POST['compos_name1'];
	$compos_author1 = $_POST['compos_author1'];
	$compos_time1 = $_POST['compos_time1'];
	$micros = 'Микрофонов: '.$_POST['micros1'].' Стоек: '.$_POST['stands1'];
	
	$tableStyle = array(
	    'borderColor' => '000000',
	    'borderSize'  => 6,
	    'cellMargin'  => 50
	);
	$phpWord->addTableStyle('Composition', $tableStyle);
	$table = $section->addTable('Composition');

	$table->addRow();
	$table->addCell(2700)->addText($compos_name1);
	$table->addCell(2700)->addText($compos_author1);	
	$table->addCell(2700)->addText($compos_time1);
	$table->addCell(2700)->addText($micros);		

	//Доп. информация
	$section->addText(htmlspecialchars($feature), array(), array());
	$section->addTextBreak();

	//Информация о руководителе
	if ($cathegory != "Профессионал") {
		$textrun = $section->createTextRun('TextRun');
		$textrun->addText('Руководитель: ', array('bold' => true));
		$teacher_who = $_POST['teacher_who'];
		$textrun->addText(htmlspecialchars($teacher_who), array(), array());

		$textrun = $section->createTextRun('TextRun');
		$textrun->addText('ФИО руководителя: ', array('bold' => true));			
		$teacher = $teacher_surname.' '.$teacher_name.' '.$teacher_father;
		$textrun->addText(htmlspecialchars($teacher), array(), array());

		$textrun = $section->createTextRun('TextRun');
		$textrun->addText('Телефон руководителя: ', array('bold' => true));	
		$teacher_phone = $teacher_phone;
		$textrun->addText(htmlspecialchars($teacher_phone), array(), array());
	}

	$textrun = $section->createTextRun('TextRun');
	$textrun->addText('Телефон участника: ', array('bold' => true));
	$member_phone = $member_phone;
	$textrun->addText(htmlspecialchars($member_phone), array(), array());

	$textrun = $section->createTextRun('TextRun');
	$textrun->addText('Email: ', array('bold' => true));
	$textrun->addText(htmlspecialchars($member_email), array(), array());

	if (isset($_POST["member_workplace"])) {
		$textrun = $section->createTextRun('TextRun');
		$textrun->addText('Место работы: ', array('bold' => true));
		$textrun->addText(htmlspecialchars($_POST["member_workplace"]), array(), array());		
	}

	$section->addTextBreak();

	if (isset($_POST['member_agency'])) {
		$textrun = $section->createTextRun('TextRun');
		$textrun->addText('Учреждение: ', array('bold' => true));
		$textrun->addText(htmlspecialchars($_POST['member_agency']), array(), array());	
	}

	if ($cathegory != "Профессионал") {
		$textrun = $section->createTextRun('TextRun');
		$textrun->addText('ФИО директора: ', array('bold' => true));
		$dir_name = $dir_surname.' '.$dir_name.' '.$dir_father;
		$textrun->addText(htmlspecialchars($dir_name), array(), array());	

		$textrun = $section->createTextRun('TextRun');
		$textrun->addText('Email: ', array('bold' => true));
		$dir_email = $dir_email;
		$textrun->addText(htmlspecialchars($dir_email), array(), array());
	}

	if (!empty($_POST["author_1_name"])) {
		$textrun = $section->createTextRun('TextRun');
		$textrun->addText('Концертмейстер: ', array('bold' => true));
		$textrun->addText(htmlspecialchars($_POST["author_1_name"]." ".$_POST["author_1_father"]." ".$_POST["author_1_surname"]), array(), array());
	}	

	if (!empty($_POST["author_2_name"])) {
		$textrun = $section->createTextRun('TextRun');
		$textrun->addText('Режиссёр: ', array('bold' => true));
		$textrun->addText(htmlspecialchars($_POST["author_2_name"]." ".$_POST["author_2_father"]." ".$_POST["author_2_surname"]), array(), array());
	}

	if (!empty($_POST["author_3_name"])) {
		$textrun = $section->createTextRun('TextRun');
		$textrun->addText('Хореограф-постановщик: ', array('bold' => true));
		$textrun->addText(htmlspecialchars($_POST["author_3_name"]." ".$_POST["author_3_father"]." ".$_POST["author_3_surname"]), array(), array());
	}

	if (!empty($_POST["author_4_name"])) {
		$textrun = $section->createTextRun('TextRun');
		$textrun->addText('Репетитор: ', array('bold' => true));
		$textrun->addText(htmlspecialchars($_POST["author_4_name"]." ".$_POST["author_4_father"]." ".$_POST["author_4_surname"]), array(), array());
	}	

	$textrun = $section->createTextRun('TextRun');
	$textrun->addText('Участие в доп. номинации: ', array('bold' => true));
	$textrun->addText(htmlspecialchars($_POST["extra_nomin"]), array(), array());	

	//Загрузка фото (если есть)
	if ($nomination == "Изобразительное искусство") {
		$tmp_dir = rand(1000, 9999);
		mkdir("img/tmp/".$tmp_dir, 0777, true);
		foreach($_FILES["nomin-file"]["name"] as $i => $value) {
			move_uploaded_file($_FILES["nomin-file"]["tmp_name"][$i],  "img/tmp/".$tmp_dir."/".$_FILES["nomin-file"]["name"][$i]);
			$section->addImage("img/tmp/".$tmp_dir."/".$_FILES["nomin-file"]["name"][$i], array(
	        'width'         => 500,
	        'wrappingStyle' => 'behind'
	    ));
		}
	}

	$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, "Word2007");

	$fileNameFirst = $fileName.".docx";
	//Чекаем, есть ли файл с таким же названием
	$k = 0;
	while (file_exists("$folder/".$nomForFile."/".$fileName.".docx") == true) {
		$m = " [".$k."]";
		$fileName = trim($fileName, $m);
		$k = $k + 1;
		$fileName = $fileName." [".$k."]";
		$fileNameFirst = $fileName.".docx";
	}
	$fileName = "$folder/".$nomForFile."/".$fileName.".docx";
	//Сохранение
	$objWriter->save($fileName);

	$disk->uploadFile(
		"/$folder/".$nomForFile."/",
		array(
			"path" => $fileName,
			"size" => filesize($fileName),
			"name" => $fileNameFirst
		)
	);

	//Удаление прикреплённых фото
	if ($nomination == "Изобразительное искусство") {
		function rmdir_recursive($dir) {
	    foreach(scandir($dir) as $file) {
        if ('.' === $file || '..' === $file) continue;
        if (is_dir("$dir/$file")) rmdir_recursive("$dir/$file");
        else unlink("$dir/$file");
	    }
	    rmdir($dir);
		}
		rmdir_recursive("img/tmp/".$tmp_dir);
	}	

	$_SESSION['filename'] = $fileName;
	header('Location: success.php');
?>
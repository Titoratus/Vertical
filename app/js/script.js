//Поддержка JQuery
window.onload = function() {
    if (!(window.jQuery))
    	document.body.innerHTML = "<h1 style='font-size: 24px; color: #000; text-align: center; line-height: 1.75; margin-top: 100px;'>Ваш браузер устарел.<p style='font-size: 14px; color: #848484;'>Пожалуйста, загрузите любой современный браузер.</p></h1>";
};

//Не запоминать значения полей input
$(document).on("focus", "input", function(){
	$(this).attr("autocomplete", "off");
});

//Все номинации и подноминации
var nominations = {
	"Вокальное исполнительство": { subnomins: ["Песня", "Романс", "Ария", "Народная лирическая", "Народная игровая", "Фольклор", "Этно", "Авторская песня", "Патриотическая песня", "Песни родного Красноярья", "Советское ретро", "Христианское песнопение", "Детская песня", "Поп-Рок", "Зарубежная эстрада", "Джаз", "Песня народов мира", "Одна для всех", "Шоу"] },
	"Хоровое пение": { subnomins: ["Младший хор", "Старший хор", "Средний хор"] },
	"Хореография": { subnomins: ["Детский, сюжетный танец", "Спортивно-современный танец", "Современный танец", "Стилизованный танец", "Театр танца", "Эстрадный танец", "Бальный танец", "Сценический  народный танец", "Фольклор; Этнотанец", "Танец народов мира", "Танцевальное шоу"] },
	"Цирковое искусство": { subnomins: ["Пластический этюд", "Жонгляж", "Каучук", "Клоунада", "Дрессура", "Акробатика", "Эквилибр", "Антипод"] },
	"Театр": { subnomins: ["Академический, драматический театр", "Водевиль", "Театр - МИМ", "Мюзикл", "Мистерия", "Сказка", "Театр современной пьесы", ["Театр кукол", "Театр кукол (без использования штакетного оборудования)"], ["Этнотеатр и фольклор", "Этнотеатр и фольклор (театрализованные действа и обряды)"], ["Оригинальный жанр", "Оригинальный жанр (юмористические сценки, оригинальные шутки, смешные истории)"], "Театр пародии", "Театр Моды"] },
	"Художественное слово": { subnomins: ["Проза", "Поэзия", "Сказ", "Литературно-музыкальная композиция", "\"Слово родного Красноярья\""] }
};

//Номинация в шапке
function checkChoice(val){

	$(".activeTab .chooseKind").empty();

	var activeOption = val.value || $(val).val();

	switch (activeOption) {	

		case "Инструментальное исполнительство":
			//$(".chooseNomin").html("<label class='label'>Инструментальное исполнительство</label><select class='input input_select' name='subnomination'></select>");
			$(".activeTab .chooseNomin").html("<div class='wrapper'><label class='label'>Вид инструментов</label><select class='input input_select' name='instr_type' required><option value='Ударные'>Ударные</option><option value='Духовые'>Духовые</option><option value='Струнные'>Струнные</option>"+
				"<option value='Народные'>Народные</option><option value='Фортепиано'>Фортепиано</option><option value='Электронные инструменты'>Электронные инструменты</option></select></div>");
			$(".activeTab .chooseNomin").append("<div class='wrapper'><label class='label'>Название инструмента</label><input class='input' name='instr_name' type='text'></div>");
			$(".chooseNomin").css("margin-left", "0");
			break;

		case "Изобразительное искусство":	
			$(".activeTab .chooseNomin").html("<div class='wrapper wrapper_100'><label class='attach_btn'>Прикрепить фото <input type='file' name='nomin-file[]' id='nomin-file' accept='image/*' required multiple></label><div class='attach_info'>Можно выбрать несколько фото</div><div class='filename'></div></div>" +
				"<div class='msg_warn'>На экспертную комиссию принимаются  работы любых техник исполнения от участников конкурса с ограниченными возможностями, номинации «Особые люди». Необходимо вместе с заявкой отправить фото своих работ. В конкурсный день работы привозятся  и размещаются в специально отведённом месте, для удобства работы экспертов.</div>");
			$(".chooseNomin").css("margin-left", "0");
			break;

		default:
			var allOptions = nominations[activeOption].subnomins;

			//Дефолтная структура подноминации
			if (nominations[activeOption].hasOwnProperty("subnomins")) {

				$(".activeTab .chooseNomin").html("<div class='wrapper wrapper_nomargin'><label class='label' for='subnomination'>Подноминация</label><select id='subnomination' name='subnomination' class='input cs-select cs-skin-overlay' required><optgroup label='Выберите подноминацию'></optgroup></select></div>");
				allOptions.forEach(function(item, i, allOptions) {
					//Если item - массив, значит value и option отличаются
					$(".activeTab select[name='subnomination'] optgroup").append("<option value='" + (Array.isArray(item) ? item[0] : item) + "'>" + (Array.isArray(item) ? item[1] : item) + "</option>");
				});

			}
			//Обычное текстовое поле
			else $(".activeTab .chooseNomin").html("<div class='wrapper'><label class='label' for='subnomination'>Подноминация</label><input type='text' placeholder='" + nominations[activeOption].placeholder + "' id='subnomination' name='subnomination' class='input' required></div>");				

		/*default:
			$(".activeTab .chooseNomin").empty();
			$("select[name='subnomination']").parent().show();*/
	}	
	var el = $('.activeTab .chooseNomin'),
	  curHeight = el.height(),
	  autoHeight = el.css('height', 'auto').height();
	el.height(curHeight).animate({height: autoHeight}, 500);			

	kindChoice($(".activeTab select[name='kind'] option:selected"));	

	(function() {
		[].slice.call( document.querySelectorAll( '#subnomination' ) ).forEach( function(el) {	
			new SelectFx(el, {
				stickyPlaceholder: false
			});
		} );
	})();	

}

function kindChoice(val){

	var activeOption = val.value || val.val();

	switch (activeOption) {

		case "Хоровое":
			$(".activeTab .chooseKind").html("<div class='wrapper wrapper_nomargin'><label class='label'>Подвид</label><select class='input input_select' name='choir_type' required><option value='Младший хор'>Младший хор</option><option value='Средний хор'>Средний хор</option><option value='Старший хор'>Старший хор</option></select></div>");
			break;

		case "ВИА":	
			$(".activeTab .chooseKind").html("<div class='wrapper wrapper_nomargin'><label class='label'>Подвид</label><select class='input input_select' name='via_type' required><option value='Эстрада'>Эстрада</option><option value='Джаз'>Джаз</option><option value='Этно'>Этно</option></select></div>");
			break;

		default:
			$(".activeTab .chooseKind").empty();
	}	

			if (($("select[name='nomination']").val() != "Инструментальное исполнительство" && $("select[name='nomination']").val() != "Изобразительное искусство") && ($("select[name='kind']").val() == "Хоровое" || $("select[name='kind']").val() == "ВИА")) $(".chooseNomin").css("margin-left", "35px");
			else $(".chooseNomin").css("margin-left", "0");
}

(function($){				
	jQuery.fn.lightTabs = function(options){

		var createTabs = function(){
			tabs = this;
			i = 0;
			
			showPage = function(i){
				$(tabs).children("div").children("div").find(".chooseNomin").remove();
				$(tabs).children("div").children("div").find(".chooseKind").remove();
				$(tabs).children("div").children("div").eq(i).children(".groupForm").append("<div class='chooseKind'></div>");
				$(tabs).children("div").children("div").eq(i).children(".groupForm").append("<div class='chooseNomin'></div>");
				$(tabs).children("div").children("div").find("input,button,textarea,select").attr("disabled", "disabled");
				$(".contestForm_hidden").find("input,button,textarea,select").attr("disabled", "disabled");
				//$(tabs).children("div").children("div").hide();							
				//$(tabs).children("div").children("div").eq(i).show();
				if ($(window).width() > 768 && i == 1) $(".tabs__wrap").css({"right":"104%"});
				else $(".tabs__wrap").css({"right":"0"});
				$(".radioWrap").children("li").removeClass("radio_active");
				$(".radioWrap").children("li").eq(i).addClass("radio_active");				
				$(tabs).children("div").children("div").eq(i).find("input,button,textarea,select").removeAttr("disabled");				
				$(tabs).children("div").children("div").eq(i).children(".groupForm").find("select[name='nomination']").addClass("activeSelect");
			}
								
			showPage(0);

			//var activeOpt = $("select[name='nomination']");
			//checkChoice(activeOpt);			

			$(".radioWrap").children("li").each(function(index, element){
				$(element).attr("data-page", i);
				i++;				                    
			});
			
			$(document).on("click", ".radioWrap li", function(){
				if ($(this).hasClass("radio_active")) return false;

			$(".school").show();
			$(".school").find("input").removeAttr("disabled");
			$(".workplace").hide();
			$(".workplace").find("input").attr('disabled','disabled');

				$(".teacher_wrap, .directorWrap").show();
				$(".teacher_wrap, .directorWrap").find("input, select").removeAttr('disabled');
				$(".title_teacher").html("Информация о руководителе");		
				$(".cathegory").val($(".cathegory option:first-of-type").val());		

				$(".activeTab select[name='kind']").val($(".activeTab select[name='kind'] option:first-of-type").val());

				showPage(parseInt($(this).attr("data-page")));
				$(".activeTab").removeClass("activeTab");
				$(".tabs__tab").eq(parseInt($(this).attr("data-page"))).addClass("activeTab");
				$(".activeTab select[name='nomination']").val($(".activeTab select[name='nomination'] option:first-of-type").val());				
				var activeOpt = $(".activeTab select[name='nomination'] option:first-of-type");
				checkChoice(activeOpt);
			});				
		};		
		return this.each(createTabs);
	};	
})(jQuery);

//Прикрепить файл
$(document).on("change", "#nomin-file", function(){
	$(".filename").empty();
	var files = document.getElementById("nomin-file").files;
	if (files.length > 4) {
		alert("Можно прикреплять не более 4 фото!");
		return false;
	}

	var size;
	for(var i = 0; i < files.length; i++) {
		size += files.item(i).size;
    $(".filename").append("<p>" + (i+1) + ". " + files.item(i).name + "</p>");
	}

	//Если больше 5 Мб
	if (size > 5242880) {
		alert("Общий размер прикреплённых фото не должен превышать 5 Мб!");
	}
});

//Основной код
$(document).ready(function(){
	$(".tabs").lightTabs();

	$(document).on("change", ".memberPlace", function(){
		if (this.value == "mem_opt2")
			$(this).parent().after("<div class='wrapper'><label class='label label_inline'>Время в пути \"в часах\"</label><input class='input' name='memberRouteTime' required></div>");
		else
			$(this).parent().next().remove();			
	});

	(function() {
		[].slice.call( document.querySelectorAll( 'select.cs-select' ) ).forEach( function(el) {	
			new SelectFx(el, {
				stickyPlaceholder: false
			});
		} );
	})();	

	$(document).on("change", ".cathegory", function(){
		if (this.value == "cath_opt3") {
			$(".teacher_wrap, .directorWrap").hide();
			$(".teacher_wrap, .directorWrap").find("input, select").attr('disabled','disabled');
			$(".title_teacher").html("Информация об участнике");

			if ($(".radio_active").text() == "Участник"){
				$(".workplace").show();
				$(".workplace").find("input").removeAttr("disabled");
				$(".school").hide();
				$(".school").find("input").attr('disabled','disabled');
			}
		}
		else {
			$(".teacher_wrap, .directorWrap").show();
			$(".teacher_wrap, .directorWrap").find("input, select").removeAttr('disabled');
			$(".title_teacher").html("Информация о руководителе");

			$(".school").show();
			$(".school").find("input").removeAttr("disabled");
			$(".workplace").hide();
			$(".workplace").find("input").attr('disabled','disabled');			
		}
	});

	$(document).on("submit", "#vertikal", function(){
		$(this).find('input[type=submit]').prop('disabled', true);
		$(this).find('input[type=submit]').css('cursor', 'wait');
	});
});

(function($){
	$.fn.styleddropdown = function(){
		return this.each(function(){
			var obj = $(this)
			obj.find('.field').click(function() { //onclick event, 'list' fadein
			obj.find('.list').fadeIn(400);
			
			$(document).keyup(function(event) { //keypress event, fadeout on 'escape'
				if(event.keyCode == 27) {
				obj.find('.list').fadeOut(400);
				}
			});
			
			obj.find('.list').hover(function(){ },
				function(){
					$(this).fadeOut(400);
				});
			});
			
			obj.find('.list li').click(function() { //onclick event, change field value with selected 'list' item and fadeout 'list'
			obj.find('.field')
				.val($(this).html())
				.css({
					'background':'#fff',
					'color':'#333'
				});
			obj.find('.list').fadeOut(400);
			});
		});
	};
})(jQuery);
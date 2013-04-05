$(document).ready(function() {

	$('.selected').click(function() {
		return false;
	});
	$('.disabled').click(function() {
		return false;
	});

	$('._view_video').click(function() {
		if ($(this).hasClass('selected')) {
			return false;
		}
		$.get(this.href, function(data) {
			$('#section').html(data);
			//load_popup();
		});
		$('#view_video').addClass('selected');
		$('#view_trailer').removeClass('selected');
		$('#view_photos').removeClass('selected');
		return false;
	});

	$('._view_trailer').click(function() {
		if ($(this).hasClass('selected')) {
			return false;
		}
		$.get(this.href, function(data) {
			$('#section').html(data);
		});
		$('#view_trailer').addClass('selected');
		$('#view_photos').removeClass('selected');
		$('#view_video').removeClass('selected');

		return false;
	});

	$('._view_photos').click(function() {
		if ($(this).hasClass('selected')) {
			return false;
		}
		$.get(this.href, function(data) {
			$('#section').html(data);
		});
		$('#view_photos').addClass('selected');
		$('#view_trailer').removeClass('selected');
		$('#view_video').removeClass('selected');
		return false;
	});

	var interval = null;

	$('._rotate_photos2').hover(function() {

		var current_image = $(this);

		if (interval) {

			clearInterval(interval);
			interval = null;

		} else {

			var images = eval($(this).attr('var'));
			var i = 0;

			interval = setInterval(function() {

				$(current_image).attr('src', images[i]);
				i ++;
				if (i >= images.length) {
					i = 0;
				}

			}, 800);
		}

	});

	var i = 0;

	$('._rotate_photos').hover(function() {

		var current_image = $(this);
	
		var images = eval($(this).attr('var'));

		i ++;
		if (i >= images.length) {
			i = 0;
		}
		$(current_image).attr('src', images[i]);

		interval = setInterval(function() {

			i ++;
			if (i >= images.length) {
				i = 0;
			}
			$(current_image).attr('src', images[i]);

		}, 800);

	}, function() {

		clearInterval(interval);

	});

	if ($('.remaining').html()) {
		//load_popup();
	}


	stop_refreshing = false;

	
	$('._dialog').click(function() {

		$.get(this.href, function(data) {
			$('#dialog-message').html(data);
			$('#dialog-message').dialog({
				width: 500,
				modal: true,
			});
		});

		return false;

	});

	$('._download_video, ._share').click(function() {

		$.get(this.href, function(data) {
			$('#dialog').html(data);
			$('#dialog').dialog({
				width: 530,
				height: 390,
				modal: true,
				buttons: {
					Ok: function() {
						$(this).dialog('close');
					}
				},
			});
		});

		return false;

	});

	$('._popup').live('click', function() {

		window.open(this.href, 'share', 'width=650,height=350');
		return false;

	});

	$('._select_size').live('click', function() {

		$('._select_size').removeClass('selected');

		$(this).addClass('selected');

		$.get(this.href, function(data) {

			$('._download_text').html(data);

		});

		return false;

	});

	$('.feedback').click(function() {
		$.get(this.href, function(data) {
			$('#dialog').html(data);
			$('#dialog').dialog({
				width: 630,
				height: 380,
				modal: true,
				buttons: {
					Cancelar: function() { // TODO idioma de "Cancelar"
						$(this).dialog('close');
					}
				},
			});
		});
		return false;
	});

	$('.dialog_form').live('submit', function() {

		var url = $(this).attr('action');
		var params = { 'data[Contact][comment]': $(this).find('textarea').val() };
		
		$.post(url, params);

		$('#dialog').dialog('close');

		return false;
	});

	if ($('#datepicker').val()) {
		$('#datepicker').datetimepicker({
			'timeFormat':'HH:mm:ss',
			'dateFormat':'yy-mm-dd',
			'firstDay':1
		});
		$.datepicker.regional['es'] = {
			closeText: 'Cerrar',
			prevText: '<Anterior',
			nextText: 'Siguiente>',
			currentText: 'Сегодня',
			monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
			monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
			dayNames: ['lunes','martes','miércoles','jueves','viernes','sábado','domingo'],
			dayNamesShort: ['lun','mar','mié','jue','vie','sáb','dom'],
			//dayNamesMin: ['Lu','Ma','Mi','Ju','Vi','Sá','Do'],
			dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
			firstDay: 1,
			showMonthAfterYear: false,
			yearSuffix: ''
		}
		//$.timepicker.setDefaults($.timepicker.regional['es']);
		$.datepicker.setDefaults($.datepicker.regional['es']);
	}

	$('.go_my_profile').click(function() {
		if ($('#register_dialog').html()) {
			$(this).removeClass('selected');
			stop_refreshing = true;
			$('#register_dialog').html('');
		} else {
			$(this).addClass('selected');
			load_popup();
		}
		return false;
	});

	$('form.register').live('submit', function() {
		$('#submit_register').hide();
		$('img.preload').show();
		$.ajax({
		  type: 'POST',
		  url: $(this).attr('action'),
		  success: function(data) {	
			$('#register_dialog').html(data);
			//return false;
		  },
		  data: $(this).serialize(),
		  dataType: 'html'
		});
		return false;
	});

});

function load_popup() {
	$('.remaining').html('90');
	$.scrollTo('#buttons', 200, {offset:{top:-100}});
	stop_refreshing = false;
	setTimeout(function() {

		if ($('#_view_video').attr('var')) {
			var path = $('#_view_video').attr('var');
		} else {
			var path = '/users/register_popup';
		}

		$.get(path, function(data) {
			$('#register_dialog').html(data);

			setTimeout(function() {
				if ($('.remaining').html()) {
					refresh($('.remaining').html());
					isCalling();
				}
			}, 1000);
		});

	}, 500);
}


function refresh(timeleft) {

	if (stop_refreshing) {
		return;
	}

	//if (parseInt($('#phone').html())) {

		$('.remaining').html(timeleft);

		if (timeleft >= 0) {

			timeleft --;

			setTimeout(function(){
				refresh(timeleft);
			}, 1000);

		} else {

			//$('.pay').html('Se acabó el tiempo');
			$('.sms').html('Se acabó el tiempo');

			setTimeout(function() {
				$('#dialog').dialog('close');
			}, 2000);

		}

	//} else {

		//$('.pay').html('Ha ocurrido un error: "' + $('#phone').html() + '"');
		//$('.sms').html('Ha ocurrido un error: "' + $('#phone').html() + '"');

	//}

}

function isCalling() {

	if (stop_refreshing) {
		return;
	}

	//if (parseInt($('#phone').html())) {

		$.ajaxSetup({
			cache: false
		});

		/*$.get(temp_path + '/videos/check_phone', function(data) {

			if (data) {
				if (data.substring(0, 1) == '/') {
					$(location).attr('href', data);
				}
			}

		});*/

		$.get('/videos/check_sms', function(data) {

			if (data) {
				if (data.substring(0, 1) == '/') {
					stop_refreshing = true;
					$(location).attr('href', data);
				}
			}

		});

		setTimeout(function(){
			isCalling();
		}, 2000);


	//}

}


$(document).ready(function() {

	$('.selected').click(function() {
		return false;
	});

	$('._view_video').click(function() {
		if ($(this).hasClass('selected')) {
			return false;
		}
		$.get(this.href, function(data) {
			$('#section').html(data);
			load_popup();
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

	$('._rotate_photos').hover(function() {

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

	if ($('.remaining').html()) {
		load_popup();
	}

	function load_popup() {
		$('.remaining').html('90');
		$.scrollTo('#buttons', 200, {offset:{top:-100}});
		stop_refreshing = false;
		setTimeout(function() {
			$('#dialog-message').dialog({
				width: 630,
				//height: 200,
				modal: true,
				buttons: {
					Ok: function() {
						$(this).dialog('close');
					}
				},
				close: function() {
					stop_refreshing = true;
				}
			});
			setTimeout(function() {
				refresh($('.remaining').html());
				isCalling();
			}, 1000);
		}, 500);
	}

	stop_refreshing = false;

	function refresh(timeleft) {

		if (stop_refreshing) {
			return;
		}

		if (parseInt($('#phone').html())) {

			$('.remaining').html(timeleft);

			if (timeleft >= 0) {

				timeleft --;

				setTimeout(function(){
					refresh(timeleft);
				}, 1000);

			} else {

				$('.pay').html('Se acabó el tiempo');
				$('.sms').html('Se acabó el tiempo');

				setTimeout(function() {
					$('#dialog-message').dialog('close');
				}, 2000);

			}

		} else {

			$('.pay').html('Ha ocurrido un error: "' + $('#phone').html() + '"');
			$('.sms').html('Ha ocurrido un error: "' + $('#phone').html() + '"');

		}

	}

	function isCalling() {

		if (stop_refreshing) {
			return;
		}

		var temp_path = '/webs/reddevil';
		//var temp_path = '';

		if (parseInt($('#phone').html())) {

			$.get(temp_path + '/videos/check_phone', function(data) {

				if (data) {
					//$(location).attr('href', data);
					alert(data);
				}

			});

			$.get(temp_path + '/videos/check_sms', function(data) {

				if (data) {
					//$(location).attr('href', data);
					alert(data);
				}

			});

			setTimeout(function(){
				isCalling();
			}, 500);


		}

	}

	
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

});

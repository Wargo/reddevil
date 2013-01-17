$(document).ready(function() {

	$('.selected').click(function() {
		return false;
	});

	$('._view_video').click(function() {
		$.get(this.href, function(data) {
			$('#section').html(data);
			refresh($('#remaining').html());
			isCalling();
		});
		$('#view_video').addClass('selected');
		$('#view_trailer').removeClass('selected');
		$('#view_photos').removeClass('selected');
		return false;
	});

	$('._view_trailer').click(function() {
		$.get(this.href, function(data) {
			$('#section').html(data);
		});
		$('#view_trailer').addClass('selected');
		$('#view_photos').removeClass('selected');
		$('#view_video').removeClass('selected');
		return false;
	});

	$('._view_photos').click(function() {
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

			}, 500);
		}

	});

	if ($('#remaining').html()) {
		refresh($('#remaining').html());
		isCalling();
	}

	function refresh(timeleft) {

		$('#remaining').html(timeleft);

		if (timeleft >= 0) {

			timeleft --;

			setTimeout(function(){
				refresh(timeleft);
			}, 1000);

		} else {

			$('.pay').html('Se acabó el tiempo');

		}

	}

	function isCalling() {

		$.get('/videos/check', function(data) {

			setTimeout(function(){
				isCalling();
			}, 1000);

		});

	}

});

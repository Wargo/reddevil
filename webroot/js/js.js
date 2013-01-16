$(document).ready(function() {

	$('.selected').click(function() {
		return false;
	});

	$('._view_trailer').click(function() {
		$.get(this.href, function(data) {
			$('#section').html(data);
		});
		$('#view_trailer').addClass('selected');
		$('#view_photos').removeClass('selected');
		return false;
	});

	$('._view_photos').click(function() {
		$.get(this.href, function(data) {
			$('#section').html(data);
		});
		$('#view_photos').addClass('selected');
		$('#view_trailer').removeClass('selected');
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

				console.log('change image to ' + images[i]);

				$(current_image).attr('src', images[i]);
				i ++;
				if (i >= images.length) {
					i = 0;
				}

			}, 200);
		}

	});

});

<?php
echo '<div class="next_video">';

	$next_video_id = '51430a39-9fe0-4eab-8473-63acbca5e1a6';

	$published = ClassRegistry::init('Video')->findById($next_video_id);
	$day = substr($published['Video']['published'], 8, 2);
	//$month = substr($published['Video']['published'], 5, 2);
	$month = date('F', strtotime($published['Video']['published']));

	echo '<div class="badge">';
		echo __('Nueva escena %s %s', '<span class="day">' . $day . '</span><br />', $month); 
	echo '</div>';

	$images = ClassRegistry::init('Photo')->find('all', array(
		'conditions' => array(
			'video_id' => $next_video_id,
			'main' => 0,
			'featured' => 1,
		),
		'limit' => 3,
		'order' => array('rand()')
	));
	echo '<div class="promo_images">';
	$i = 0;
	foreach ($images as $image) {
		$i ++;
		extract($image);
		$alt = ClassRegistry::init('Photo')->getTitle($Photo);
		echo $this->Html->image('Photo' . DS . $Photo['id'] . ',fitCrop,326,243.jpg', array('class' => $i == 3 ? 'last' : '', 'alt' => $alt, 'title' => $alt));
	}
	echo '</div>';
	
	echo '<div class="promo_text clearfix">';
		echo '<div class="bg_red">';
			echo __('Vive la experiencia RedDevilX');
		echo '</div>';
		echo '<div class="bg_white">';
			echo '<div class="bg_black">';
				echo __('Disfruta nuestros contenidos por menos de 1 € al día');
			echo '</div>';
			echo '<div class="text_big">';
				echo __('Hazte socio y accede al contenido exclusivo de los rodajes');
			echo '</div>';
			echo '<div class="text_small">';
				echo __('Tomas falsas');
				echo '<br />';
				echo __('Cámaras espía');
				echo '<br />';
				echo __('Sesiones de fotos');
			echo '</div>';
		echo '</div>';

		if ($this->Session->read('Auth.User.id')) {
			echo $this->Html->link(__('Ver mi cuenta'), array('controller' => 'users', 'action' => 'profile'), array('class' => 'go_my_profile floating_button'));
		} else {
			echo $this->Html->link(__('Hacerme socio'), array('controller' => 'users', 'action' => 'profile'), array('class' => 'go_my_profile floating_button'));
		}

	echo '</div>';

	echo '<div class="promo_footer">';
		echo __('Bienvenido al porno 3.0');
	echo '</div>';

echo '</div>';

<?php
echo '<div class="next_video">';

	$next_video_id = '51430a39-9fe0-4eab-8473-63acbca5e1a6';
	$composition = 'escena_porno_fallas.jpg';

	$published = ClassRegistry::init('Video')->findById($next_video_id);
	$day = substr($published['Video']['published'], 8, 2);
	//$month = date('F', strtotime($published['Video']['published']));

	$month = substr($published['Video']['published'], 5, 2);
	switch ($month) {
		case '01': $m = __('Enero'); break;
		case '02': $m = __('Febrero'); break;
		case '03': $m = __('Marzo'); break;
		case '04': $m = __('Abril'); break;
		case '05': $m = __('Mayo'); break;
		case '06': $m = __('Junio'); break;
		case '07': $m = __('Julio'); break;
		case '08': $m = __('Agosto'); break;
		case '09': $m = __('Septiembre'); break;
		case '10': $m = __('Octubre'); break;
		case '11': $m = __('Noviembre'); break;
		case '12': $m = __('Diciembre'); break;
	}

	echo '<div class="badge">';
		echo __('Nueva escena %s %s', '<span class="day">' . $day . '</span><br />', $m); 
	echo '</div>';

	echo '<div class="promo_images">';
		if (!$composition) {

			$images = ClassRegistry::init('Photo')->find('all', array(
				'conditions' => array(
					'video_id' => $next_video_id,
					'main' => 0,
					'featured' => 1,
				),
				'limit' => 3,
				'order' => array('rand()')
			));
			$i = 0;
			foreach ($images as $image) {
				$i ++;
				extract($image);
				$alt = ClassRegistry::init('Photo')->getTitle($Photo);
				echo $this->Html->image('Photo' . DS . $Photo['id'] . ',fitCrop,326,243.jpg', array('class' => $i == 3 ? 'last' : '', 'alt' => $alt, 'title' => $alt));
			}

		} else {
			echo $this->Html->image($composition, array('width' => 980));
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
			echo '<div class="left">';
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

	echo '</div>';

	echo '<div class="promo_footer">';
		echo __('Bienvenido al porno 3.0');
	echo '</div>';

echo '</div>';
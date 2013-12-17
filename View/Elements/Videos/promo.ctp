<?php

switch ($_SERVER['HTTP_HOST']) {
	case 'www.pornstarschool.reddevilx.com':
		echo '<div class="link_promo">';
			echo $this->Html->image('sites/pornstar.jpg', array());
			echo $this->Html->link($this->Html->image('promo.png', array()), array('controller' => 'users', 'action' => 'profile'), array('escape' => false, 'class' => 'go_my_profile'));
		echo '</div>';
		break;
	case 'www.glassman.reddevilx.com':
		echo '<div class="link_promo">';
			echo $this->Html->image('sites/glassman.jpg', array());
			echo $this->Html->link($this->Html->image('promo.png', array()), array('controller' => 'users', 'action' => 'profile'), array('escape' => false, 'class' => 'go_my_profile'));
		echo '</div>';
		break;
	case 'www.loschicosdelcable.reddevilx.com':
		echo '<div class="link_promo">';
			echo $this->Html->image('sites/chicos-del-cable.jpg', array());
			echo $this->Html->link($this->Html->image('promo.png', array()), array('controller' => 'users', 'action' => 'profile'), array('escape' => false, 'class' => 'go_my_profile'));
		echo '</div>';
		break;
	case 'www.unpaisparafollarselo.reddevilx.com':
		echo '<div class="link_promo">';
			echo $this->Html->image('sites/pais.jpg', array());
			echo $this->Html->link($this->Html->image('promo.png', array()), array('controller' => 'users', 'action' => 'profile'), array('escape' => false, 'class' => 'go_my_profile'));
		echo '</div>';
		break;
	default:
		$conditions = array('active' => 1);
		$order = array('created' => 'desc');
		extract(ClassRegistry::init('Wallpaper')->find('first', compact('order', 'conditions')));

		$avatar = $Wallpaper['avatar'];

		$aux = '';
		if ($avatar != 'placeholder') {
			$aux = explode('-', $avatar);
			$aux = substr($aux[1], 0, 3);
		}
		$Video = ClassRegistry::init('Video');
		$url = $Video->field('slug', array('id' => $Wallpaper['video_id']));

		echo '<div class="link_promo">';
			echo $this->Html->link($this->Html->image('bg/' . $aux . '/' . $avatar . '.jpg'),
				array('controller' => 'videos', 'action' => 'view', $url),
				array('escape' => false));
			echo $this->Html->link($this->Html->image('promo.png', array()), array('controller' => 'users', 'action' => 'profile'), array('escape' => false, 'class' => 'go_my_profile'));
		echo '</div>';
		break;
}

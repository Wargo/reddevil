<meta name="title" content="<?php echo $title_for_layout; ?>" />
<meta name="description" content="<?php echo !empty($description_for_layout) ? $description_for_layout : ''; ?>" />
<meta name="keywords" content="<?php echo !empty($keywords_for_layout) ? $keywords_for_layout : 'red porno, porno español, videos x, reddevilx, reddevil, chicas, desnudos, teta, culo, mamada'; ?>" />

<meta name="google-site-verification" content="67mjGpxk9OhIr6Mrez0OQpFOVAUM9oOW7wI_WSY_AVg" />

<?php
if ($this->params['controller'] == 'videos' && $this->params['action'] == 'view' && !empty($main)) {
	$folder = explode('-', $main['Photo']['id']);
	$folder = substr($folder[1], 0, 3);
	echo '<meta property="og:image" content="' . $this->Html->url(array('full_base' => true, 'controller' => 'videos', 'action' => 'home')) . 'img/Photo/' . $folder . '/' .  $main['Photo']['id'] . ',fitCrop,239,150.jpg" />';
}

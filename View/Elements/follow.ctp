<?php

$pages = array(
	'facebook' => 'https://www.facebook.com/pages/RED-Devilx/322022304525632',
	'twitter' => 'https://twitter.com/REDDEVILX1',
	'google+' => 'https://plus.google.com/u/0/b/116571438468252720094/116571438468252720094/posts',
	'linkedin' => 'http://www.linkedin.com/company/2862182?trk=tyah',
	'tuenti' => 'http://www.tuenti.com/#m=Page&func=index&page_key=1_2932_78195140',
);

echo '<ul class="follow">';
	foreach ($pages as $key => $value) {

		echo '<li>' . $this->Html->link($this->Html->image($key . '.png', array('width' => 20)), $value, array('alt' => sprintf(__('Síguenos en %s'), ucfirst($key)), 'title' => sprintf(__('Síguenos en %s'), ucfirst($key)), 'escape' => false, 'target' => '_blank')) . '</li>';

	}
echo '</ul>';

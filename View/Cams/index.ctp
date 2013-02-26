<?php

foreach ($cams as $cam) {
	?>
	<div class="room_element">
		<div class="element_image">
			<?php echo $this->Html->link($this->Html->image('http://foto.paraisowebcam.com/c6781/160@120_1.jpg', array('width' => 160)), 'http://www.modelocam.com/spa/rooms/display/Anais', array('escape' => false)); ?>
		</div>
		<div class="online_badge">
			<img width="74" height="85" alt="Online" src="/img/modelocam/online_badge.png">
		</div>
		<div class="element_title">
			<div class="title_name">
				Anais
			</div>
			<div class="title_age">
				28 años
			</div>
		</div>
		<div class="element_link">
			<a title="Entra a la webcam de Anais" href="/spa/rooms/display/Anais">Webcam de Anais</a>
		</div>
	</div>
	<?php
}

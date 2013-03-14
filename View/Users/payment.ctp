<p><?php echo __('El pago ha sido realizado') ?></p>
<?php
	echo $this->Html->link(__('Volver al video'), array('controller' => 'videos', 'action' => 'view_video', $video_id));

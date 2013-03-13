<div class="clearfix">
<?php
foreach ($cams as $cam) {
	$url = array('controller' => 'cams', 'action' => 'view', $cam->Room->nick);
	?>
	<div class="room_element">
		<div class="element_image">
			<?php echo $this->Html->link($this->Html->image($cam->RoomSmallPhoto[0]->uri, array('width' => 160)), $url, array('escape' => false)); ?>
		</div>
		<?php if ($cam->Room->status == 1) { ?>
			<div class="online_badge">
				<?php echo $this->Html->image('online_badge.png'); ?>
			</div>
		<?php } ?>
		<div class="rating">
			<?php
			for ($i = 1; $i <= $cam->Room->popularity; $i ++) {
				echo '<div class="mini_heart mini_heart_on"></div>';
			}
			for ($j = $i; $j <= 5; $j ++) {
				echo '<div class="mini_heart mini_heart_off"></div>';
			}
			?>
		</div>
		<div class="element_title">
			<div class="title_name">
				<?php echo $cam->Room->name; ?>
			</div>
			<div class="title_age">
				<?php echo $cam->Room->age . ' ' . __('años'); ?>
			</div>
		</div>
		<div class="element_link">
			<?php echo $this->Html->link(__('Webcam de') . ' ' . $cam->Room->name, $url, array()); ?>
		</div>
	</div>
	<?php
}
?>
</div>

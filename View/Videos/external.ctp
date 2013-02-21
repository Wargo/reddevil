<?php echo $this->element('Videos/player', compact('Video')); ?>
<script>
	$(".flowplayer").bind("finish", function (e, api) {
		$(".flowplayer").html('<a href="<?php echo $this->Html->url(array('controller' => 'videos', 'action' => 'view_video', $Video['slug']), true); ?>" class="external_link"><?php echo __('Ver video completo'); ?></a>');
		var style = $(".flowplayer").attr('style');
		$(".flowplayer").attr('style', 'text-align:center; padding-top:120px;' + style);
	});
</script>

<style>
.external_link {
	color:#222;
	font-size:36px;
}
</style>

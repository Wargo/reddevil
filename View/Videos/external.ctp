<?php echo $this->element('Videos/player', compact('Video')); ?>
<script>
	$(".flowplayer").bind("finish", function (e, api) {
		$(".player_video").html('<a href="<?php echo $this->Html->url(array('controller' => 'videos', 'action' => 'view_video', $Video['slug']), true); ?>" class="external_link"><?php echo __('Ver video completo'); ?></a>');
		$(".player_video").attr('style', 'text-align:center; padding-top:120px');
	});
</script>

<style>

.player_video {

}

.external_link {
	color:#222;
	font-size:36px;


}
</style>

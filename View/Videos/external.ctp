<?php echo $this->element('Videos/player', compact('Video')); ?>
<script>
	$(".flowplayer").bind("finish", function (e, api) {
		var height = $(".flowplayer").height();
		$(".flowplayer").html('<a href="<?php echo $this->Html->url(array('controller' => 'videos', 'action' => 'view_video', $Video['slug']), true); ?>" class="external_link"></a>');
		var style = $(".flowplayer").attr('style');
		$(".flowplayer").attr('style', 'text-align:center; height:'  +height + 'px; ' + style);
	});
</script>

<style>
.external_link {
	width: 100%;
	height: 100%;
	display:block;
	background-image: url('http://www.reddevilx.com/css/flowplayer/img/play_white.png');
	background-repeat: no-repeat;
	background-position: center;
}
</style>

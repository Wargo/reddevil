<div class="room_profile">
	<div class="profile_header">
		<div class="arrow_box">
			Entrar a la cámara decoration
		</div>
		<?php echo $room->Room->name; ?>
	</div>
	<div class="online_badge">
		<?php echo $this->Html->image('online_badge.png'); ?>
	</div>

	<div class="profile_media">
	<?php
	$nice_nick = $room->Room->name;
	if (!empty($room->RoomBigVideo[0])) {
		$video_url = $room->RoomBigVideo[0]->uri;
		?>
		<a href="<?php echo $this->Html->url(array('controller' => 'cams', 'action' => 'go', $room->Room->code)); ?>" id="videoplayer" class="videoplayer no-time no-volume" data-swf="<?php echo $this->Html->url('/html5/flowplayer/flowplayer.swf'); ?>">
			<video autoplay loop>
				<source type="video/flash" src="<?php echo $video_url; ?>" />
			</video>
		</a>
		<script>
		$(document).ready(function() {
			$(".videoplayer").flowplayer({
				tooltip: false,
				key: '$397432013148639',
				logo: '<?php echo $this->Html->url('/img/logo.png', true); ?>'
			});
		});
		</script>
		<?php
	} else {
		?>
		<?php
		if(!empty($room->RoomBigPhoto[0])){
			$photo_uri=$room->RoomBigPhoto[0]->uri;
		}
		elseif(!empty($room->RoomMediumPhoto[0])){
			$photo_uri=$room->RoomMediumPhoto[0]->uri;
		}
		elseif(!empty($room->RoomSmallPhoto[0])){
			$photo_uri=$room->RoomSmallPhoto[0]->uri;
		}
		if(!empty($photo_uri)) {
			$photo_text=__('Foto %s de %s',1,$nice_nick);
			$photo_tip=__('Ampliar foto %s de %s',1,$nice_nick);
			echo $this->Html->link($this->Html->image($photo_uri,array('width'=>494,'height'=>369,'class'=>'profile_photo profile_photos','alt'=>$photo_text)),$photo_uri,array('escape'=>false,'title'=>$photo_tip,'rel'=>'lightbox','class'=>'profile_photos'));

			if(!empty($room->RoomSmallPhoto[0])){
				unset($room->RoomSmallPhoto[0]);
			}

		}

	}


	if(!empty($room->RoomSmallPhoto)) {
		foreach($room->RoomSmallPhoto as $photo_index=>$small_photo){
			$photo_text=__('Foto %s de %s',$photo_index+1,$nice_nick);
			$photo_tip=__('Ampliar foto %s de %s',$photo_index+1,$nice_nick);
			echo $this->Html->link($this->Html->image($small_photo->uri,array('width'=>160,'height'=>120,'alt'=>$photo_text,'class'=>'profile_photos profile_small_photo')),$room->RoomBigPhoto[$photo_index]->uri,array('rel'=>'lightbox','escape'=>false,'title'=>$photo_tip,'class'=>'profile_photos profile_small_photo'));
		}
	}
	?>

		<script type="text/javascript">
		//&lt;![CDATA[
		$(document).ready(function() {
			$('a.profile_photos').colorbox();
		});
		//]]&gt;
		</script>
	</div>
	<div class="profile_data">

		<?php echo $this->element('Cams/description', compact('nice_nick')); ?>

		<div class="boton_verde">
			<?php echo $this->Html->link(__('Chatea con') . ' ' . $room->Room->name, array('controller' => 'cams', 'action' => 'go', $room->Room->code), array('id' => 'connect_boton_verde', 'class' => 'boton_verde cboxElement')); ?>
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="profile_connect">
		<div class="connect_container">
			<div class="connect_description">
				Cámara de <?php echo $room->Room->name; ?>
			</div>
			<div class="connect_link">
				<?php echo $this->Html->link(__('Conectar'), array('controller' => 'cams', 'action' => 'go', $room->Room->code), array('id' => 'connect_manager_link')); ?>
				<script type="text/javascript">
				//<![CDATA[
				$(document).ready(function() {
					$('a#connect_manager_link').colorbox();
					$('a#connect_boton_verde').colorbox();
					$('a#videoplayer').colorbox();
				});
				//]]>
				</script>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
</div>

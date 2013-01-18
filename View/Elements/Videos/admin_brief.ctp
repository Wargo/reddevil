<?php
$title = ($mode=='trailer')?__('Trailer'):__('Video');
$duration = ($mode=='trailer')?$data['Video']['trailer_duration']:$data['Video']['duration'];
$_duration = (floor($duration/60)) . ':' . ($duration%60);
?>
<div class="input">
<label><?php echo $title ?></label>
<label><?php echo __('Duración: %s', $_duration); ?></label>
</div>

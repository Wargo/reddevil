<?php
foreach ($videos as $video) {
	
	extract($video);

	echo $this->element('Videos/block', compact('Video'));

}

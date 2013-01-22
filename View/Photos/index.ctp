<?php

foreach ($videos as $video) {
	
	extract($video);

	echo $this->element('Photos/block', compact('Video'));

}

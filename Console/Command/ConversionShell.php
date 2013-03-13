<?php
class ConversionShell extends AppShell {

	public $formats = array(
		'mp4' => array('folder' => 'mp4', 'sizes' => array('m', 's')),
		'flv' => array('folder' => 'flv', 'sizes' => array('l', 'm', 's')), 
		'wmv' => array('folder' => 'wmv', 'sizes' => array('l', 'm', 's')),
		'v3gp' => array('folder' => '3gp', 'sizes' => array('s')),
		'ogg' => array('folder' => 'ogg', 'sizes' => array('l', 'm', 's'))
	);
	
	public function convert_all() {
		$Conversion = ClassRegistry::init('Conversion');
		$this->Video = ClassRegistry::init('Video');
		$limit = 1;
		$conditions = array('state' => 0);
		while ($conversion = $Conversion->find('first', compact('conditions'))) {
			$Conversion->id = $conversion['Conversion']['id'];
			$Conversion->save(array('state' => 1));
			foreach ($this->formats as $format => $config) {
				$this->{$format}($conversion['Conversion']['foreign_id'], $conversion['Conversion']['model']);
			}
			$Conversion->id = $conversion['Conversion']['id'];
			$Conversion->save(array('state' => 2));
		}
	}

	public function reconvert($id = false, $model = false) {
		if (!empty($this->args[0])) {
			$id = $this->args[0];	
		}
		if (!empty($this->args[1])) {
			$model = $this->args[1];
		}
		if (!$id || !$model) {
			return false;
		}
		foreach ($this->formats as $format => $config) {
			$this->{$format}($id, $model);
		}   
	} 

	public function mp4($id, $model, $reconvert = false) {
		$path = Configure::read($model . 'UploadFolder');
		$input = $id . '.mp4';
		$movie = new ffmpeg_movie($path.$input, false);	
		$duration = round($movie->getDuration());
		$sizes = $this->formats['mp4']['sizes'];
		foreach ($sizes as $size) {	
			$output = Configure::read($model . 'RootFolder') . 'mp4' . DS . $size . DS . $id . '.mp4';
			if (file_exists($output)) {
				continue;
			}
			if ($size == 'm') {
				$res = '1280x720';
				$bitrate = '2500k';
			} elseif ($size = 's') {
				$res = '480x270';
				$bitrate = '700k';
			}
			
			if ($reconvert && file_exists($output)) {
				unlink($output);
			}
			if (!$reconvert && !$this->_checkVideo($id, $model, 'mp4', $size, $duration) && file_exists($output)) {
				unlink($output);
			}
			
			if (!file_exists($output)) {
				$priority = '';
				if (Configure::read('VideoProcessPriority')) {
					$priority = 'nice -n ' . Configure::read('VideoProcessPriority') . ' ';
				}
				$ffmpegPath = Configure::read('FfmpegPath');
				$cmd = $priority . " " . $ffmpegPath . "ffmpeg -i ".$path.$input." -vcodec libx264 -f mp4 -preset slow -level 30 -s ".$res." -b:v ".$bitrate." -strict -2 ".$output;
				shell_exec($cmd);
				if ($this->_checkVideo($id, $model, 'mp4', $size, $duration)) {
					$this->_saveFormat($id, $model, 'mp4', $size);
				}
			}
		}
		
	}

	public function flv($id, $model, $reconvert = false) {
		$path = Configure::read($model. 'UploadFolder');
		$input = $id. '.mp4';


		$movie = new ffmpeg_movie($path.$input, false);	
		$duration = round($movie->getDuration());
		/*
		$w = $movie->getFrameWidth();
		$h = $movie->getFrameHeight();
		$_w = 1600;
		$_h = round(($_w * $h) / $w);
		*/

		$sizes = $this->formats['flv']['sizes'];
		foreach ($sizes as $size) {
			$output = Configure::read($model . 'RootFolder') . 'flv' . DS . $size . DS . $id . '.flv';
			if ($size == 'l') {
				$res = '1920x1080';
				$bitrate = '4000k';
			} else if ($size == 'm') {
				$res = '1280x720';
				$bitrate = '2500k';
			} else if ($size == 's') {
				$res = '480x270';
				$bitrate = '700k';
			}

			if ($reconvert && file_exists($output)) {
				unlink($output);
			}
			if (!$reconvert && !$this->_checkVideo($id, $model, 'flv', $size, $duration) && file_exists($output)) {
				unlink($output);
			}

			if (!file_exists($output)) {
				$priority = '';
				if (Configure::read('VideoProcessPriority')) {
					$priority = 'nice -n ' . Configure::read('VideoProcessPriority') . ' ';
				}
				$ffmpegPath = Configure::read('FfmpegPath');
				$cmd = $priority . " " . $ffmpegPath . "ffmpeg -i ".$path.$input." -vcodec libx264 -preset medium -f flv -acodec copy -b:v ".$bitrate." -f flv -s ".$res." ".$output;
				shell_exec($cmd);
			
				if ($this->_checkVideo($id, $model, 'flv', $size, $duration)) {
					$this->_saveFormat($id, $model, 'flv', $size);
				}
			}
		}

	}

	public function wmv($id, $model, $reconvert = false) {	
		$path = Configure::read($model. 'UploadFolder');
		$input = $id . '.mp4';

		$movie = new ffmpeg_movie($path.$input, false);	
		$duration = round($movie->getDuration());	

		$sizes = $this->formats['wmv']['sizes'];

		foreach ($sizes as $size) {
			$output = Configure::read($model . 'RootFolder') . 'wmv' . DS . $size . DS . $id . '.wmv';	

			if ($size == 'l') {
				$res = '1920x1080';
				$bitrate = '4000k';
			} else if ($size == 'm') {
				$res = '1280x720';
				$bitrate = '2500k';
			} else if ($size == 's') {
				$res = '480x270';
				$bitrate = '700k';
			}

			if ($reconvert && file_exists($output)) {
				unlink($output);
			}
			if (!$reconvert && !$this->_checkVideo($id, $model, 'flv', $size, $duration) && file_exists($output)) {
				unlink($output);
			}

			if (!file_exists($output)) {
				$priority = '';
				if (Configure::read('VideoProcessPriority')) {
					$priority = 'nice -n ' . Configure::read('VideoProcessPriority') . ' ';
				}
				$ffmpegPath = Configure::read('FfmpegPath');
				$cmd = $priority . " " . $ffmpegPath . "ffmpeg -i ".$path.$input." -b:v ".$bitrate." -s ".$res." ".$output;
				shell_exec($cmd);
		
				if ($this->_checkVideo($id, $model, 'wmv', $size, $duration)) {
					$this->_saveFormat($id, $model, 'wmv', $size);
				}
			}
		}
	}

	public function v3gp($id, $model, $reconvert = false) {
		$path = Configure::read($model. 'UploadFolder');
		$input = $id . '.mp4';
		$movie = new ffmpeg_movie($path.$input, false);	
		$duration = round($movie->getDuration());
		$sizes = $this->formats['v3gp']['sizes'];

		foreach ($sizes as $size) {
			$output = Configure::read($model . 'RootFolder') . '3gp' . DS . $size . DS . $id . '.3gp';

			if ($reconvert && file_exists($output)) {
				unlink($output);
			}
			if (!$reconvert && !$this->_checkVideo($id, $model, 'flv', $size, $duration) && file_exists($output)) {
				unlink($output);
			}
			if (!file_exists($output)) {
				$priority = '';
				if (Configure::read('VideoProcessPriority')) {
					$priority = 'nice -n ' . Configure::read('VideoProcessPriority') . ' ';
				}
				$ffmpegPath = Configure::read('FfmpegPath');
				$cmd = $priority . " " . $ffmpegPath . "ffmpeg -i ".$path.$input." -s 352x288 -q:v 0 -vcodec h263 -acodec aac -ac 1 -ar 8000 -r 25 -ab 16k -strict -2 -y ".$output;
				shell_exec($cmd);
				
				if ($this->_checkVideo($id, $model, 'v3gp', $size, $duration)) {
					$this->_saveFormat($id, $model, '3gp', $size);
				}
			}
		}
	}

	public function ogg ($id, $model, $reconvert = false) {
		$path = Configure::read($model. 'UploadFolder');
		$input = $id . '.mp4';
		$movie = new ffmpeg_movie($path.$input, false);	
		$duration = round($movie->getDuration());
		$sizes = $this->formats['ogg']['sizes'];

		foreach ($sizes as $size) {
			$output = Configure::read($model . 'RootFolder') . 'ogg' . DS . $size . DS . $id . '.ogg';	

			if ($size == 'l') {
				$res = '1920x1080';
				$bitrate = '4000k';
			} else if ($size == 'm') {
				$res = '1280x720';
				$bitrate = '2500k';
			} else if ($size == 's') {
				$res = '480x270';
				$bitrate = '700k';
			}

			if ($reconvert && file_exists($output)) {
				unlink($output);
			}
			if (!$reconvert && !$this->_checkVideo($id, $model, 'ogg', $size, $duration) && file_exists($output)) {
				unlink($output);
			}
			if (!file_exists($output)) {

				$priority = '';
				if (Configure::read('VideoProcessPriority')) {
					$priority = 'nice -n ' . Configure::read('VideoProcessPriority') . ' ';
				}
				$ffmpegPath = Configure::read('FfmpegPath');
				$cmd = $priority . " " . $ffmpegPath . "ffmpeg -i ".$path.$input." -vcodec libtheora -b:v ".$bitrate." -s ".$res." -acodec libvorbis -aq 60 ".$output;
				shell_exec($cmd);	
				if ($this->_checkVideo($id, $model, 'ogg', $size, $duration)) {
					$this->_saveFormat($id, $model, 'ogg', $size);
				}
			}
		}

	
	}

	protected function _saveFormat($id, $model, $format, $size) {
		$formats = unserialize($this->Video->field('formats', array('id' => $id)));
		if (empty($formats[$model])) {
			$formats[$model] = array();
		}
		if (empty($formats[$model][$format])) {
			$formats[$model][$format] = array();
		}
		if (empty($formats[$model][$format][$size])) {
			$formats[$model][$format][$size] = 1;
		}
		$formats = serialize($formats);
		$this->Video->id = $id;
		$this->Video->save(compact('formats'));
	}

	protected function _checkVideo($id, $model, $format, $size, $duration) {
		$video = Configure::read($model. 'RootFolder') . $this->formats[$format]['folder'] . DS . $size . DS . $id . '.' . $format;
		if (!file_exists($video)) {
			return false;
		}
		$movie = new ffmpeg_movie($video, false);
		if (round($movie->getDuration()) != $duration) {
			return false;
		}
		return true;
	}
}

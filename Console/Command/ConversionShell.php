<?php
class ConversionShell extends AppShell {


	public $formats = array(
		//'flv' => array('folder' => 'flv'), 
		'wmv' => array('folder' => 'wmv'), 
		'v3gp' => array('folder' => '3gp')
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

	public function flv($id, $model) {
		$path = Configure::read($model. 'UploadFolder');
		$input = $id;
		$output = 'flv' . DS . $id;

		$movie = new ffmpeg_movie($path.$input, false);	
		$duration = $movie->getDuration();
		$w = $movie->getFrameWidth();
		$h = $movie->getFrameHeight();
		$_w = 1600;
		$_h = round(($_w * $h) / $w);

		$cmd = "ffmpeg -i ".$path.$input." -vcodec libx264 -vpre medium -f flv -acodec copy -b 1000k -f flv -s ".$_w."x".$_h." ".$path.$output;
		shell_exec($cmd);
		
		if ($this->_checkVideo($id, $model, 'flv', $duration)) {
			$this->_saveFormat($id, $model, 'flv');
		}

	}

	public function wmv($id, $model) {	
		$path = Configure::read($model. 'UploadFolder');
		$input = $id;
		$output = 'wmv' . DS . $id;

		$movie = new ffmpeg_movie($path.$input, false);	
		$duration = $movie->getDuration();

		$cmd = "ffmpeg -sameq -i ".$path.$input." ".$path.$output . ".wmv";
		shell_exec($cmd);
		shell_exec('mv ' . $path.$output.'.wmv '.$path.$output);
		
		if ($this->_checkVideo($id, $model, 'wmv', $duration)) {
			$this->_saveFormat($id, $model, 'wmv');
		}
	}

	public function v3gp($id, $model) {

		$path = Configure::read($model. 'UploadFolder');
		$input = $id;
		$output = '3gp' . DS . $id;

		$movie = new ffmpeg_movie($path.$input, false);	
		$duration = $movie->getDuration();

		$cmd = "ffmpeg -i ".$path.$input." -s 352x288 -sameq -vcodec h263 -acodec libfaac -ac 1 -ar 8000 -r 25 -ab 16k -y ".$path.$output.".3gp";
		shell_exec($cmd);
		shell_exec('mv ' . $path.$output.'.3gp '.$path.$output);
		
		if ($this->_checkVideo($id, $model, 'v3gp', $duration)) {
			$this->_saveFormat($id, $model, '3gp');
		}
	}

	protected function _saveFormat($id, $model, $format) {
		$formats = unserialize($this->Video->field('formats', array('id' => $id)));
		if (empty($formats[$model])) {
			$formats[$model] = array();
		}
		if (empty($formats[$model][$format])) {
			$formats[$model][$format] = 1;
		}
		$formats = serialize($formats);
		$this->Video->id = $id;
		$this->Video->save(compact('formats'));
	}

	protected function _checkVideo($id, $model, $format, $duration) {
		$video = Configure::read($model. 'UploadFolder') . $this->formats[$format]['folder'] . DS . $id;
debug($video); 
debug(file_exists($video)); die;
		if (!file_exists($video)) {
			return false;
		}
		$movie = new ffmpeg_movie($video, false);
		debug($movie->getDuration());
		if ($movie->getDuration() != $duration) {
			return false;
		}
		return true;
	}
}

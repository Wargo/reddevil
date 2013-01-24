<?php
class ConversionShell extends AppShell {

	public $formats = array('flv', 'wmv');
	
	public function convert_all() {
		$Conversion = ClassRegistry::init('Conversion');
		$this->Video = ClassRegistry::init('Video');
		$limit = 1;
		$conditions = array('state' => 0);
		while ($conversion = $Conversion->find('first', compact('conditions'))) {
			$Conversion->id = $conversion['Conversion']['id'];
			$Conversion->save(array('state' => 1));
			foreach ($this->formats as $format) {
				$this->{$format}($conversion['Conversion']['foreign_id'], $conversion['Conversion']['model']);
			}
			$Conversion->id = $conversion['Conversion']['id'];
			$Conversion->save(array('state' => 2));
		}
	}

	public function flv($id, $model) {
		$path = Configure::read($model. 'UploadFolder');
		$input = $id;
		$output = 'flv' . DS . $id;

		$movie = new ffmpeg_movie($path.$input, false);	
		$w = $movie->getFrameWidth();
		$h = $movie->getFrameHeight();
		$_w = 1600;
		$_h = round(($_w * $h) / $w);

		$cmd = "ffmpeg -i ".$path.$input." -vcodec libx264 -vpre medium -f flv -acodec copy -b 1000k -f flv -s ".$_w."x".$_h." ".$path.$output;
		shell_exec($cmd);
		
		$this->_saveFormat($id, $model, 'flv');

	}

	public function wmv($id, $model) {	
		$path = Configure::read($model. 'UploadFolder');
		$input = $id;
		$output = 'wmv' . DS . $id;

		$cmd = "ffmpeg -sameq -i ".$path.$input." ".$path.$output . ".wmv";
		shell_exec($cmd);
		shell_exec('mv ' . $path.$output.'.wmv '.$path.$output);
		
		$this->_saveFormat($id, $model, 'wmv');
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
}

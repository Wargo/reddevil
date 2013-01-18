<?php 
class FuncionesHelper extends AppHelper {

	public function showFilesize($bytes) {
		if ($bytes < 1024) {
			return "$bytes b";
		} elseif ($bytes < (1024*1024)) {
			$bytes = round ($bytes/1024);
			return "$bytes Kb";	
		} elseif ($bytes < (1024*1024*1024)) {
			$bytes = round ($bytes/(1024*1024), 1);
			return "$bytes Mb";
		} else {
			$bytes = round ($bytes/(1024*1024*1024), 2);
			return "$bytes Gb";
		}
	}
}

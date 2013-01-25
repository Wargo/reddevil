<?php
/**
 * Application level View Helper
 *
 * This file is application-wide helper file. You can put all
 * application-wide helper-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Helper
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Helper', 'View');

/**
 * Application helper
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       app.View.Helper
 */
class AppHelper extends Helper {

	var $models = array('Photo', 'Actor');

	function assetUrl($path, $options = array()) {

		if (!empty($options['fullBase'])) {
			foreach ($this->models as $model) {
				if (strpos($path, 'img' . DS . $model) !== false) {
					// TODO Convertir
				}
			}
		} else {
			foreach ($this->models as $model) {
				if (strpos($path, $model) === 0) { // TODO || strpos($path, DS . 'img' . DS . $model) === 0) {
					$aux = explode('-', $path);
					if (!empty($aux[1])) {
						$aux = substr($aux[1], 0, 3);
						$path = str_replace(DS, DS . $aux . DS , $path);
					}
				}
			}
		}

		return parent::assetUrl($path, $options);
	}

}

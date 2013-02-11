<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
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
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {

	function transferTo($temporary = null, $source = null) {

		if(!$this->Behaviors->attached('Transfer')) {
			return false;
		}
		
		if ($this->id) {

			$aux = explode('-', $this->id);
			$aux = substr($aux[1], 0, 3);
			
			// Remove original image before update it
			$path = 'img' . DS . $this->alias . DS . $aux . DS . $this->id . '.jpg';
			@unlink(APP . 'uploads' . DS . $path);

			// All generated images
			$delete = 'img' . DS . $this->alias . DS . $aux . DS . $this->id . '*';
			exec('rm -f ' . WWW_ROOT . $delete);

			return $path;

		} else {
			// TODO
		}

		return false;

	}
}

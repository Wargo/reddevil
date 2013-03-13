<?php
class CamsController extends AppController {

	var $paginate;

	function index() {

		//$url = 'http://modelocam.com/spa/rooms/get_list/20/filter:altas.json';
		$url_filters = 'http://modelocam.com/spa/filters/get_list.json';

		$url = 'http://modelocam.com/spa/rooms/get_list/80.json';

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$cams = json_decode(curl_exec($ch));

		$cams = $cams->data;

		$this->set(compact('cams'));

	}

	function view($slug) {

		$url = 'http://modelocam.com/spa/rooms/get/' . $slug . '.json';

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$room = json_decode(curl_exec($ch));

		$room = $room->data;

		$this->set(compact('room'));

	}

	function go($code) {

		$this->set(compact('code'));

	}

}

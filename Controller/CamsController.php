<?php
class CamsController extends AppController {

	var $paginate;

	function index() {

		$title_for_layout = __('Webcams');

		$description_for_layout = __('Webcams porno, chicas on-line');

		//$url = 'http://modelocam.com/spa/rooms/get_list/20/filter:altas.json';
		$url_filters = 'http://modelocam.com/spa/filters/get_list.json';

		$url = 'http://modelocam.com/spa/rooms/get_list/80.json';

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$cams = json_decode(curl_exec($ch));

		$cams = $cams->data;

		$this->set(compact('cams', 'title_for_layout'));

	}

	function view($slug) {

		$url = 'http://modelocam.com/spa/rooms/get/' . $slug . '.json';

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$room = json_decode(curl_exec($ch));

		$room = $room->data;

		$title_for_layout = __('Webcam de') . ' ' . $room->Room->name;

		$this->set(compact('room', 'title_for_layout'));

	}

	function go($code) {

		$this->set(compact('code'));

	}

}

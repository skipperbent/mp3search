<?php
namespace mp3vibez\Controller;

use mp3vibez\Helper;
use mp3vibez\Widget\WidgetHome;
use Pecee\Cookie;

class ControllerDefault extends \Pecee\Controller\Controller {

	public function index() {
		echo new WidgetHome();
	}

	public function language($locale=null) {
		if(in_array(strtolower($locale), Helper::$Locales)) {
			Cookie::create('Locale', strtolower($locale));
		}
		$path = $this->input('path', '');
		redirect('/#' . $path);
	}
}
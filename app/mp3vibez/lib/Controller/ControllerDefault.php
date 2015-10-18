<?php
namespace mp3vibez\Controller;

use mp3vibez\Helper;
use mp3vibez\Widget\WidgetHome;
use Pecee\Cookie;

class ControllerDefault extends \Pecee\Controller\Controller {

	public function getIndex() {
		echo new WidgetHome();
	}

	public function getLanguage($locale=null) {
		if(in_array(strtolower($locale), Helper::$Locales)) {
			Cookie::create('Locale', strtolower($locale));
		}
		$path = $this->getParam('path', '');
		redirect('/#' . $path);
	}
}
<?php
namespace mp3vibez\Controller;

use mp3vibez\Widget\WidgetHome;

class ControllerDefault extends \Pecee\Controller\Controller {

	public function getIndex() {
		echo new WidgetHome();
	}

	public function getLanguage($locale=null) {
		if(in_array(strtolower($locale), Helper::$Locales)) {
			\Pecee\Cookie::Create('Locale', strtolower($locale));
		}
		$path = $this->getParam('path', '');
		\Pecee\Router::Redirect('/#' . $path);
	}
}
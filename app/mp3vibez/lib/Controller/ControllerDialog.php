<?php
namespace mp3vibez\Controller;

class ControllerDialog extends \Pecee\Controller\Controller {

	public function process($request) {

		$class = '\\mp3vibez\\Widget\\Dialog';
		$tmp = explode('/', $request);

		foreach($tmp as $r) {
			$class .= '\\' . ucfirst($r);
		}

		if(class_exists($class)) {
			$class = new $class();
			echo $class;
		}
	}

}
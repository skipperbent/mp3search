<?php
namespace mp3vibez\Controller;

class ControllerAjax extends \Pecee\Controller\Controller {

	public function getProcess($request) {

		$class = '\\mp3vibez\\Widget\\Ajax';
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
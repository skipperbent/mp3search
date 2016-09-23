<?php
namespace mp3vibez\Controller;

class DialogController extends \Pecee\Controller\Controller {

	public function process($request) {

        $class = '\\mp3vibez\\Widget';
        $tmp = explode('/', rtrim($request, '/'));

        foreach($tmp as $r) {
            $class .= '\\' . ucfirst($r);
        }

        if(class_exists($class)) {
            $class = new $class();
            echo $class;
        }

	}

}
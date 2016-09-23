<?php
namespace mp3vibez\Handler;

use Pecee\Http\Request;
use Pecee\SimpleRouter\RouterEntry;

class ExceptionHandler extends \Pecee\Handler\ExceptionHandler  {

    public function handleError( Request $request, RouterEntry $router = null, \Exception $error) {
        if($error->getCode() == 404) {
            throw new \ErrorException('404: Page not found!');
        }
    }

}
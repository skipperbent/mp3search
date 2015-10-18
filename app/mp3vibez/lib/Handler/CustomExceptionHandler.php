<?php
namespace mp3vibez\Handler;

use Demo\Widget\Page\PageNotFound;
use Pecee\Handler\ExceptionHandler;
use Pecee\Http\Request;
use Pecee\SimpleRouter\RouterEntry;

class CustomExceptionHandler extends ExceptionHandler {

    public function handleError( Request $request, RouterEntry $router = null, \Exception $error) {
        if($error->getCode() == 404) {
            die('404: Page not found!');
        }
    }

}
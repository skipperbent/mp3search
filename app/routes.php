<?php
/**
 * This file contains all the routes for the project
 */

use Pecee\Router;

Router::get('/', 'DefaultController@index');
Router::get('/about', 'DefaultController@about');
Router::get('/contact', 'DefaultController@contact');
Router::get('/music/download', 'MusicController@download');

Router::get('/json/search', 'JsonController@search');
Router::get('/language/{lang}', 'DefaultController@language')->where(['lang' => '[a-zA-Z\-]+']);

Router::all('/ajax', 'AjaxController@process')->match('ajax\\/([A-Za-z0-9\\/]+)');
Router::all('/dialog', 'DialogController@process')->match('dialog\\/([A-Za-z0-9\\/]+)');

Router::defaultExceptionHandler('\mp3vibez\Handler\ExceptionHandler');
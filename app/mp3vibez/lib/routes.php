<?php
/**
 * This file contains all the routes for the project
 */

use Pecee\Router;

Router::get('/', 'ControllerDefault@index');
Router::get('/about', 'ControllerDefault@about');
Router::get('/contact', 'ControllerDefault@contact');
Router::get('/music/download', 'ControllerMusic@download');

Router::get('/json/search', 'ControllerJson@search');
Router::get('/language/{lang}', 'ControllerDefault@language');

Router::all('/ajax', 'ControllerAjax@process')->match('ajax\\/([A-Za-z0-9\\/]+)');
Router::all('/dialog', 'ControllerDialog@process')->match('dialog\\/([A-Za-z0-9\\/]+)');

Router::addExceptionHandler('\mp3vibez\Handler\CustomExceptionHandler');
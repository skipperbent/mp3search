<?php
namespace mp3vibez\Controller;

class MusicController extends \Pecee\Controller\Controller {

	public function download() {
	    redirect(input()->get('song'));
	}

}
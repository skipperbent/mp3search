<?php
namespace mp3vibez\Controller;

class ControllerMusic extends \Pecee\Controller\Controller {

	public function download() {
		$song = $this->input('song');
		echo file_get_contents($song);
	}

}
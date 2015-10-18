<?php
namespace mp3vibez\Controller;

class ControllerMusic extends \Pecee\Controller\Controller {

	public function getDownload() {
		$song = $this->getParam('song');
		echo file_get_contents($song);
	}

}
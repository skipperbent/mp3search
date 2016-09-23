<?php
namespace mp3vibez\Dataset;

use Pecee\Dataset\Dataset;

class Languages extends Dataset {
	public function __construct() {
		$this->add('en-gb', 'English');
		$this->add('da-dk', 'Dansk');
	}
}
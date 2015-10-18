<?php
namespace mp3vibez\Dataset;

use Pecee\Dataset\Dataset;

class DatasetLanguages extends Dataset {
	public function __construct() {
		$this->add('en-uk', 'English');
		$this->add('da-dk', 'Dansk');
	}
}
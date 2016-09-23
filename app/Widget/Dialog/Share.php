<?php
namespace mp3vibez\Widget\Dialog;

use mp3vibez\Widget\WidgetAjax;

class Share extends WidgetAjax {
	protected $song;
	public function __construct() {
		parent::__construct();
		$this->song = input()->get('song', '');
	}
}
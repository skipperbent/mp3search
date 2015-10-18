<?php
namespace mp3vibez\Widget;

class WidgetHome extends WidgetSite {

	public function __construct() {
		$this->globalMenuActiveItem=0;

		parent::__construct();

		$this->getSite()->addWrappedJs('jquery.ba-hashchange.min.js');
		$this->getSite()->addWrappedJs('jquery.jplayer.min.js');
		$this->getSite()->addWrappedJs('player.js');
		$this->getSite()->addWrappedJs('dialog.js');
		$this->getSite()->addWrappedJs('functions.js');
	}

}
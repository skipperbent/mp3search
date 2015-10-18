<?php
namespace mp3vibez\Widget\Ajax;

use mp3vibez\Widget\WidgetAjax;

class Home extends WidgetAjax {

	const MAX_SONGS_CACHE_KEY = 'MAX_SONGS';
	const MAX_ARTISTS_CACHE_KEY = 'MAX_ARTISTS';
	protected $songsCount = 0;
	protected $artistsCount = 0;

	public function __construct() {
		parent::__construct();
	}
}
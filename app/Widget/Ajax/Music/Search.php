<?php
namespace mp3vibez\Widget\Ajax\Music;

use mp3vibez\Service\beemp3\beemp3;

use mp3vibez\Widget\WidgetAjax;

class Search extends WidgetAjax {
	protected $results;
	protected $artists;
	protected $artist;
	protected $query;
	protected $pageIndex=0;

	public function __construct($query = null) {
		parent::__construct();
		$this->query = (!is_null($query)) ? $query : input()->get('query', '');
		$this->artist = input()->get('artist', null);
		$this->pageIndex = input()->get('page', 0);

		$service = new beemp3();
        $service->search($this->query);
		$this->results = $service->getResults();
	}
}
<?php
namespace mp3vibez\Widget\Ajax\Music;

use mp3vibez\Service\mp3skull\mp3skull;

use mp3vibez\Widget\WidgetAjax;

class Search extends WidgetAjax {
	protected $results;
	protected $artists;
	protected $artist;
	protected $query;
	protected $pageIndex=0;

	public function __construct($query = null) {
		parent::__construct();
		$this->query = (!is_null($query)) ? $query : $this->input('search_query', '');
		$this->artist = $this->input('artist', null);
		$this->pageIndex = $this->input('page', 0);

		$service = new mp3skull();
		$this->results = $service->search($this->query);
	}
}
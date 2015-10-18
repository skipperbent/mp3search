<?php
namespace mp3vibez\Controller;

use mp3vibez\Service\mp3skull\mp3skull;
use mp3vibez\Service\mp3with\mp3with;
use Pecee\Str;

class ControllerJson extends \Pecee\Controller\Controller {

	public function getSearch() {
		$query = $this->getParam('query');
		if(!empty($query)) {
			$results = new mp3skull();
			$results = $results->search($query);
			if($results) {
				$titles=array('query' => $query);
				$i = 0;
				foreach($results as $result) {

					$titles['OriginalTitles'][] = $result->title;
					$titles['Titles'][]=Str::substr($result->title, 55);
					if($i > 10) {
						break;
					}
					$i++;
				}
				echo json_encode($titles);
			}
		}
	}

}
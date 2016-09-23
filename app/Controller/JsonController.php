<?php
namespace mp3vibez\Controller;

use mp3vibez\Service\mp3skull\beemp3;
use Pecee\Str;

class JsonController extends \Pecee\Controller\Controller {

	public function search() {
		$query = input()->get('query');
		if(!empty($query)) {
			$results = new beemp3();
			$results = $results->search($query);
			if($results) {
				$titles = array('query' => $query);
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
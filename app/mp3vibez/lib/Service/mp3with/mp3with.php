<?php
namespace mp3vibez\Service\mp3with;

use Sunra\PhpSimple\HtmlDomParser;

class mp3with {

    const SERVICE_URL = 'http://mp3with.co/search/?q=%1$s';

    public function search($query) {
        $dom = HtmlDomParser::file_get_html(sprintf(self::SERVICE_URL, urlencode($query)));

        $songs = $dom->find('ul.songs li');

        $results = array();

        if($songs) {
            /* @var $song \simple_html_dom_node */
            foreach($songs as $song) {
                $result = new mp3withResult();
                $result->id = $song->attr['data-id'];
                $result->url = 'http://mp3with.co' . $song->attr['data-mp3'];

                $song = $song->find('.song', 0);
                if($song) {
                    $result->title = trim($song->find('strong', 0)->innertext);
                    $result->artist = trim($song->find('strong.artist', 0)->innertext);
                }

                $results[] = $result;
            }
        }

        return $results;
    }

}
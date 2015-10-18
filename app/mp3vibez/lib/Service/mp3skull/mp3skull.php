<?php
namespace mp3vibez\Service\mp3skull;

use Sunra\PhpSimple\HtmlDomParser;

class mp3skull {

    const SERVICE_URL = 'https://mp3skull.wtf/search_db.php?q=%1$s&fckh=%2$s';

    public function search($query) {
        $dom = HtmlDomParser::file_get_html('https://mp3skull.wtf');
        $token = $dom->find('input[name="fckh"]',0)->attr['value'];
        $dom = HtmlDomParser::file_get_html(sprintf(self::SERVICE_URL, urlencode($query), $token));
        $songs = $dom->find('#song_html');

        $results = array();

        if($songs) {
            /* @var $song \simple_html_dom_node */
            foreach($songs as $song) {
                if($song !== null) {
                    $result = new mp3skullResult();
                    $url = $song->find('.download_button a', 0);

                    if($url) {
                        $result->url = $url->attr['href'];

                        $title = $song->find('.mp3_title', 0);
                        if ($title) {
                            $result->title = trim($title->find('b', 0)->innertext);
                        }

                        $info = $song->find('.songInfoMobile', 0);
                        if ($info) {
                            $info = explode("/", strip_tags($info));

                            if (isset($info[0])) {
                                $result->bitrate = trim($info[0]);
                            }

                            if (isset($info[1])) {
                                $result->length = trim($info[1]);
                            }

                            if (isset($info[2])) {
                                $result->size = trim($info[2]);
                            }
                        }


                        $results[] = $result;
                    }
                }
            }
        }

        return $results;
    }

}
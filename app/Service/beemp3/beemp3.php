<?php
namespace mp3vibez\Service\beemp3;

use Sunra\PhpSimple\HtmlDomParser;

class beemp3 {

    const SERVICE_URL = 'http://beemp3s.org/search?query=%1$s&field=all&page=%2$s';

    protected $page = 0;
    protected $results = array();

    public function search($query, $limit = 50) {
        $dom = HtmlDomParser::str_get_html($this->fetchPage(sprintf(self::SERVICE_URL, urlencode($query), ($this->page + 1))));
        $songs = $dom->find('.result .item');

        if($songs) {
            /* @var $song \simple_html_dom_node */
            foreach($songs as $song) {
                if ($song !== null) {

                    $title = $song->find('.title a', 0);

                    $info = $song->find('.block-info', 0);

                    $result = new beemp3Result();
                    $result->title = $title->find('.font-blur', 0)->innertext();
                    $result->artist = $info->find('div', 0)->innertext();

                    $details = HtmlDomParser::str_get_html($this->fetchPage($title->attr['href']));

                    $info = $details->find('table td');

                    $result->length = $info[1]->innertext();
                    $result->size = $info[3]->innertext();
                    $result->bitrate = $info[5]->innertext();
                    //$result->artist = strip_tags($info[7]->innertext());
                    //$result->title = strip_tags($info[9]->innertext());
                    //$result->title = strip_tags($info[9]->innertext()) . ' - ' . strip_tags($info[count($info)-1]->innertext());
                    $result->title = strip_tags($title->innertext());

                    $result->url = $details->find('a#download-button', 0)->attr['href'];

                    $this->results[] = $result;

                    if(count($this->results) >= $limit) {
                        return $this;
                    }
                }
            }

            $hasNext = ($dom->find('a[rel="next"]', 0) != null);

            if($hasNext && count($this->results) < $limit) {
                $this->page += 1;
                $this->search($query, $limit);
            }
        }

        return $this;

    }

    protected function fetchPage($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)');
        curl_setopt($ch, CURLOPT_URL, $url);
        return curl_exec($ch);
    }

    public function getResults() {
        return $this->results;
    }

}
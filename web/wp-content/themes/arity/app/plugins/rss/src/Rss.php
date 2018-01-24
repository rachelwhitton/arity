<?php

namespace Rss;

class Rss
{

    /**
     * Rss url.
     *
     * @var string
     */
    protected $url;

    /**
     * Rss data.
     *
     * @var string
     */
    protected $data;

    /**
     * Rss data.
     *
     * @var string
     */
    private $cache_expires = 1;

    /**
     * Construct rss.
     *
     * @param string $url the rss url
     *
     * @return self
     */
    public function __construct($url='')
    {
        $this->setUrl($url);
        if(empty($contents = $this->fetchCached($url))) {
            $contents = $this->fetch($url);
            $contents = $this->validate($contents);
            $contents = $this->cleanup($contents);
        }
        $this->setData($contents);
        return $this;
    }

    /**
     * Returns Rss data output
     *
     * @return object
     */
    public function output()
    {
        // Returns data
        return $this->getData();
    }

    /**
     * Fetches cached content from a URL
     *
     * @return string|false
     */
    private function fetchCached($url)
    {
        // HOUR_IN_SECONDS
        // $content.= '<!-- cached: '.date('Y-m-d H:i:s').'-->';
        return false;
    }

    /**
     * Fetches content from a URL via curl
     *
     * @return string
     */
    private function fetch($url)
    {
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,5);
        $content = curl_exec($ch);
        curl_close($ch);
        return $content;
    }

    /**
     * Returns Rss url
     *
     * @return object $url
     */
    private function getUrl() {
        return $this->url;
    }

    /**
     * Sets Rss url
     *
     * @return self
     */
    private function setUrl($url) {

        $this->url = $url;

        return $this;
    }

    /**
     * Returns Rss data
     *
     * @return object $data
     */
    private function getData() {
        return $this->data;
    }

    /**
     * Sets Rss data
     *
     * @return self
     */
    private function setData($data) {

        $this->data = $data;

        return $this;
    }

    /**
     * Cleanup RSS xml string
     *
     * @param string $xml
     *
     * @return string
     */
    private function cleanup($xml) {
        // Trim Spaces
        $xml = trim($xml);
        $xml = simplexml_load_string($xml);
        $xml = @json_decode(@json_encode($xml),1);

        return $xml;
    }

    /**
     * Validates Rss data
     *
     * @param string $data
     *
     * @return string|false $data
     */
    private function validate($data) {
        if(!$this->isValid($data)) {
            trigger_error('Failed to fetch RSS feed');
            return false;
        }

        return $data;
    }

    /**
     * Validates XML and returns boolean
     *
     * @param string $xml
     *
     * @return boolean
     */
    private function isValid($xml) {
        if(empty($xml)) {
            return false;
        }

        // Check for rss tag
        if( strpos( $xml, '<rss version="2.0">' ) === false ) {
            return false;
        }

        return true;
    }
}

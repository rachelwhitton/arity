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
     * Rss cache expires (in hours).
     *
     * @var string
     */
    private $cache_expires = 1;

    /**
     * Rss cache key prefix
     *
     * @var string
     */
    private $cache_key_prefix = 'rss_cache:';

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
        if(empty($contents = $this->getCached(urlencode($url)))) {
            $contents = $this->fetch($url);
            $contents = $this->validate($contents);
            $contents = $this->cleanup($contents);
            $this->setCached($contents, urlencode($url));
        }
        $this->setData($contents);
        return $this;
    }

    /**
     * Returns Rss data output
     *
     * @return object $data
     */
    public function output()
    {
        // Returns data
        return $this->getData();
    }

    /**
     * Returns cached content from a URL using transient cache
     *
     * @param string $key
     *
     * @return object|false $data
     */
    private function getCached($key='')
    {
        if(empty($data = get_transient( $this->cache_key_prefix . $key ))) {
            return false;
        }

        return $data;
    }

    /**
     * Sets cached data using transient cache
     *
     * @param object $data
     *
     * @return self
     */
    private function setCached($data, $key='') {
        $data['_cached'] = date('Y-m-d H:i:s');
        $this->cache = set_transient( $this->cache_key_prefix . $key, $data, ($this->cache_expires * HOUR_IN_SECONDS) );

        return $this;
    }

    /**
     * Fetches content from a URL via curl
     *
     * @param string $url
     *
     * @return string $content
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
     * @return string $url
     */
    private function getUrl() {
        return $this->url;
    }

    /**
     * Sets Rss url
     *
     * @param string $url
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
     * @param object $data
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
     * @return string $xml
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

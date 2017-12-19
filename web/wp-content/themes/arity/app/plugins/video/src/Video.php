<?php

namespace Video;

class Video
{

    /**
     * Video url.
     *
     * @var string
     */
    protected $url;

    /**
     * Video id.
     *
     * @var string
     */
    protected $id;

    /**
     * Video player url.
     *
     * @var string
     */
    protected $player;

    /**
     * Video player size.
     *
     * @var string
     */
    private $player_size = '720p';

    /**
     * Video provider.
     *
     * @var string
     */
    protected $provider;

    /**
     * Video iframe attributes.
     *
     * @var object
     */
    protected $attrs;

    /**
     * Video provider patterns.
     *
     * @var array
     */
    private $provider_patterns = array(
        'vimeo' => [
            '#(https?://vimeo.com)/([0-9]+)#i',
            '#(https?://player.vimeo.com)/video/([0-9]+)#i'
        ],
        'youtube' => [
            '%(?:youtube(?:-nocookie)?\.com/(?:[\w\-?&!#=,;]+/[\w\-?&!#=/,;]+/|(?:v|e(?:mbed)?)/|[\w\-?&!#=,;]*[?&]v=)|youtu\.be/)([\w-]{11})(?:[^\w-]|\Z)%i'
        ]
    );

    /**
     * Video provider's player url.
     *
     * @var array
     */
    private $provider_players = array(
        'vimeo' => 'https://player.vimeo.com/video/{id}',
        'youtube' => 'https://www.youtube.com/embed/{id}'
    );

    /**
     * Construct asset.
     *
     * @param string $url the video url
     * @param object $attrs attributes for the iframe
     *
     * @return self
     */
    public function __construct($url='', $attrs=array())
    {
        $this->setup($url);
        $this->setAttrs($attrs);

        return $this;
    }

    /**
     * Setup video parameters using video url
     *
     * @param string $url the video url
     *
     * @return self
     */
    private function setup($url)
    {
        // Set Url
        $this->setUrl($url);

        // Set Id & Provider based on url patterns
        foreach($this->provider_patterns as $provider=>$patterns) {
            foreach($patterns as $pattern) {
                if(!empty(preg_match($pattern, $url, $matches))) {
                    $this->setId($matches[count($matches)-1]);
                    $this->setProvider($provider);
                };
            }
        }

        // Set Player string used for iframe
        $this->setPlayer();

        return $this;
    }

    /**
     * Sets the video url..
     *
     * @param string $url video url
     *
     * @return self
     */
    private function setUrl($url='')
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Gets the video url..
     *
     * @return string $url video url
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Sets the video id..
     *
     * @param string $id video id
     *
     * @return self
     */
    private function setId($id='')
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Gets the video id..
     *
     * @return string $id video id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the video provider..
     *
     * @param string $provider video provider
     *
     * @return self
     */
    private function setProvider($provider='')
    {
        $this->provider = $provider;

        return $this;
    }

    /**
     * Gets the video provider..
     *
     * @return string $provider video provider
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * Sets the video player..
     *
     * @return self
     */
    private function setPlayer()
    {
        if(empty($this->id) || empty($this->provider)) {
            return false;
        }

        if(!empty($player = $this->provider_players[$this->provider])) {
            $this->player = str_replace('{id}', $this->id, $player);
        }

        return $this;
    }

    /**
     * Gets the video player..
     *
     * @return string $player video player
     */
    private function getPlayer()
    {
        return $this->player;
    }

    /**
     * Sets the video player size..
     *
     * @param string $size video player size
     *
     * @return self
     */
    public function setPlayerSize($size='')
    {
        $this->player_size = $size;

        return $this;
    }

    /**
     * Gets the video player size..
     *
     * @return string player_size Video player size
     */
    private function getPlayerSize()
    {
        return $this->player_size;
    }

    /**
     * Sets the iframe attributes..
     *
     * @param object $attrs Object of iframe attributes
     *
     * @return self
     */
    public function setAttrs($attrs=array())
    {
        $this->attrs = $attrs;

        return $this;
    }

    /**
     * Gets the iframe attributes..
     *
     * @return object $attrs Object of iframe attributes
     */
    private function getAttrs()
    {
        return $this->attrs;
    }

    /**
     * Returns video output
     *
     * @return string $url the url
     * @return self
     */
    public function output()
    {
        return $this->getIframe();
    }

    public function getIframe($attr=array())
    {
        if(empty($attr)) {
            $attr = $this->getAttrs();
        }

        $attr['src'] = $this->getPlayer();
        if(empty($attr['src'])) {
            return false;
        }

        // Start empty string
        if( empty($attr['class']) ) {
            $attr['class'] = '';
        }

        // Object to string conversion
        if( is_object($attr['class']) ) {
            $attr['class'] = implode(' ', $attr['class']);
        }

        // Lazyload
    	if( strpos($attr['class'], 'lazyload') !== false ) {

            // Change src
    		$attr['data-src'] = $attr['src'];
    		$attr['src'] = '';
    	}

        // Size
        if(!empty($attr['size'])) {
            $this->setPlayerSize($attr['size']);
            unset($attr['size']);
        }

        switch( $this->getPlayerSize() ) {
    		case "240p" :
    			$attr['width'] = '426';
    			$attr['height'] = '240';
    			break;
    		case "360p" :
    			$attr['width'] = '640';
    			$attr['height'] = '360';
    			break;
    		case "480p" :
    			$attr['width'] = '854';
    			$attr['height'] = '480';
    			break;
    		case "720p" :
    			$attr['width'] = '1280';
    			$attr['height'] = '720';
    			break;
    		case "1080p" :
    			$attr['width'] = '1920';
    			$attr['height'] = '1080';
    			break;
    		case "1440p" :
    			$attr['width'] = '2560';
    			$attr['height'] = '1440';
    			break;
    		case "2160p" :
    			$attr['width'] = '3840';
    			$attr['height'] = '2160';
    			break;
    	}

        // Add default class
        $attr['class'] .= ' iframe';

    	// Convert attrs to a string
    	$attrs = '';
        foreach ( $attr as $name => $value ) {
            $attrs .= " $name=" . '"' . trim($value) . '"';
        }

    	$output = '<iframe ' . trim($attrs) . 'frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';

    	return $output;
    }
}

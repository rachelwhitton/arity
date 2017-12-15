<?php

namespace Video;

class Video
{

    /**
     * Video url.
     *
     * @var string
     */
    private $url;

    /**
     * Video id.
     *
     * @var string
     */
    private $id;

    /**
     * Video provider.
     *
     * @var string
     */
    private $provider;

    /**
     * Video provider patterns.
     *
     * @var array
     */
    private $provider_patterns = array(
        'vimeo' => [
            '#(https?://vimeo.com)/([0-9]+)#i',
            '#(https?://vimeo.com)/([0-9]+)#i'
        ],
        'youtube' => [
            '#(https?://www.youtube.com)/watch?v=([0-9]+)#i',
            '#(https?://www.youtube.com)/embed/([0-9]+)#i',
            '#(https?://youtu.be)/([0-9]+)#i'
        ]
    );

    /**
     * Construct asset.
     *
     */
    public function __construct($id='', $provider='', $atts=array())
    {

        if($this->is_id($id)) {
            $this->setId($id);
            $this->setUrl($id);
        } else {
            $this->setUrl($id);
            $this->setId($id);
        }


        // $this->setProvider();
        // $this->setIframeAttributes($atts);

        // var_dump($this);
        return $this;
    }

    /**
     * Sets the video id..
     *
     * @param string $id the id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->$id = $id;

        return $this;
    }

    /**
     * Sets the video url..
     *
     * @param string $url the url
     *
     * @return self
     */
    public function setUrl($url)
    {
        $this->$url = $url;

        return $this;
    }

    /**
     * Sets the video type..
     *
     * @return self
     */
    public function setType()
    {
        $this->$type = 'vimeo';

        return $this;
    }

    /**
     * Returns video output
     *
     * @return string $url the url
     * @return self
     */
    public function getOutput()
    {
        return '<iframe src="https://player.vimeo.com/video/8733915" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
        return $this->getIframe(array(
            'src' => $this->$url
        ));
    }

    public function getIframe($attr=array(), $size='720p')
    {
        if( empty($attr) || empty($attr['src'] ) ) {
    		trigger_error('Missing required parameter.');
    	}

        // Lazyload
    	if( !empty($attr['class']) && strpos($attr['class'], 'lazyload') !== false ) {

            // Change src
    		$attr['data-src'] = $attr['src'];
    		$attr['src'] = '';
    	}

        $attr['class'] .= ' iframe';

        switch( $size ) {
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

    	// Convert attrs to a string
    	$attrs = '';
        foreach ( $attr as $name => $value ) {
            $attrs .= " $name=" . '"' . trim($value) . '"';
        }

    	$output = '<iframe ' . $attrs . '
    		allowfullscreen
            webkitallowfullscreen
            mozallowfullscreen></iframe>';

        // <iframe src="https://player.vimeo.com/video/8733915" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>

    	return $output;
    }

    /**
     * Evaluates string and returns Boolean to check if Id
     *
     * @return string $str Url or video id
     * @return boolean
     */
    private function is_id($str) {
        if(is_numeric($str)) {
            return true;
        }

        return false;
    }

    private function determine_provider() {

    }

    private function is_youtube() {

    }

    private function is_vimeo() {
        // https://player.vimeo.com/video/
    }
}

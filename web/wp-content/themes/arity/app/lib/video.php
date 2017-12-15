<?php

declare(strict_types=1);

namespace App\Theme;

/*
|-----------------------------------------------------------------
| Video Helpers
|-----------------------------------------------------------------
|
| Supports Vimeo, YouTube, Brightcove.
|
*/

// Vimeo Player
// --------------------------------------------------

function get_vimeo_video( $id=null, $attr=array(), $width=null ) {

	// Check required arguements
	if( empty($id) ) {
		trigger_error('Missing required id.');
	}

	// Define video ID
	$id = get_vimeo_video_id($id);

	// Define src
	$attr['src'] = 'https://player.vimeo.com/video/' . $id;
	$attr['class'] = $attr['class'] . ' iframe-video';

	$size = null;
	if( $width == 'full' ) {
		$size = '1080p';
	}

	// Return an iframe
	return get_iframe($attr, $size);
}

function the_vimeo_video( $id=null, $attr=array() ) {
	echo get_vimeo_video( $id, $attr );
}

function get_vimeo_video_id( $str ) {
	if( !strpos( $str, 'vimeo' ) ) {
		return $str;
	}

	$part = explode( '/', $str );
	$id = $part[count($part)-1];

	return trim($id);
}

// YouTube Player
// --------------------------------------------------

function get_youtube_video( $id=null, $attr=array(), $width=null ) {

	// Check required arguements
	if( empty($id) ) {
		trigger_error('Missing required id.');
	}

	// Define video ID
	$id = get_youtube_video_id($id);

	// Define src
	$attr['src'] = 'https://www.youtube.com/embed/' . $id . '?enablejsapi=1&origin=' . home_url();
	$attr['class'] = $attr['class'] . ' iframe-video';

	$size = null;
	if( $width == 'full' ) {
		$size = '1080p';
	}

	// Return an iframe
	return get_iframe($attr, $size);
}

function the_youtube_video( $id=null, $attr=array() ) {
	echo get_youtube_video( $id, $attr );
}

function get_youtube_video_id( $str ) {
	if( !strpos( $str, 'youtube' ) ) {
		return $str;
	}

	$part = explode( '?v=', $str );
	$id = $part[count($part)-1];

	if( strpos( $id, '&' ) > -1 ) {
		$part = explode('&', $id);
		$id = $part[0];
	}

	return trim($id);
}

// Brightcove Player
// --------------------------------------------------

$brightcove_video_counter = 0;
function get_brightcove_video( $id=null, $attr=array() ) {

	global $brightcove_video_counter;

	// Check required arguements
	if( empty($id) ) {
		trigger_error('Missing required id.');
	}

	// Define video ID
	$ids = get_brightcove_video_ids($id);

	if( empty($ids) )
		return false;

	$brightcove_video_counter++;

	$attr['class'] = str_replace('lazyload', '', $attr['class']);

	return '<object class="BrightcoveExperience' . ($attr['class'] ? ' ' . $attr['class'] : '') . '" id="BrightcoveExperience_' . $brightcove_video_counter . '">
				<param name="bgcolor" value="#FFFFFF" />
				<param name="width" value="800" />
				<param name="height" value="600" />
				<param name="playerID" value="' . $ids['player_id'] . '" />
				<param name="playerKey" value="' . $ids['video_playerkey'] . '" />
				<param name="isVid" value="true" />
				<param name="isUI" value="true" />
				<param name="dynamicStreaming" value="true" />
				<param name="templateLoadHandler" value="brightcoveLoaded' . $brightcove_video_counter . '" />
				<param name="templateReadyHandler" value="brightcoveReady' . $brightcove_video_counter . '">
				<param name="@videoPlayer" value="' . $ids['video_player'] . '" />
				<param name="secureConnections" value="true" />
  				<param name="secureHTMLConnections" value="true" />
			</object>
		';
}

function the_brightcove_video( $ids=null, $attr=array() ) {
	echo get_brightcove_video( $ids, $attr );
}

/**
 * get_brightcove_video_id
 * Return a valid brightcove id
 * @param  [type] $ids [description]
 * @return [type]      [description]
 */
function get_brightcove_video_ids( $ids ) {

	// Should be an array
	if( !is_array($ids) ) {
		return false;
	}

	// Check for required params
	if( empty($ids['video_player']) || empty($ids['video_playerkey']) || empty($ids['player_id']) ) {
		return false;
	}

	return $ids;
}

function get_iframe( $attr=array(), $size='720p' ) {
	if( empty($attr) || empty($attr['src'] ) ) {
		trigger_error('Missing required parameter.');
	}

	// Lazyload
	if( !empty($attr['class']) && strpos($attr['class'], 'lazyload') !== false ) {
		// Change src
		$attr['data-src'] = $attr['src'];
		$attr['src'] = '';
	}

	$attr['class'] = $attr['class'] . ' iframe';

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

	return $output;
}

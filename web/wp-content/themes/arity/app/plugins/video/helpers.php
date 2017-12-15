<?php

declare(strict_types=1);

namespace App\Theme;

use Video\Video;

// Exit if accessed directly
if (! defined('ABSPATH')) {
    exit;
}

/**
 * Gets video instance. Supports vimeo, youtube.
 *
 * @param string $id Url or id of the video.
 * @param string $provider Video provider
 * @param string $atts Attributes for video iframe
 *
 * @return \Video
 */
function video($id, $provider='', $atts=array())
{
    return new Video($id, $provider, $atts);
}

/**
 * Gets video instance. Supports vimeo, youtube.
 *
 * @param string $id Url or id of the video.
 * @param string $provider Video provider
 * @param string $atts Attributes for video iframe
 *
 * @return string html output
 */
function get_video($id, $provider='', $atts=array())
{
    return video($id, $provider, $atts)->getOutput();
}

/**
 * Echos video instance. Supports vimeo, youtube.
 *
 * @param string $id Url or id of the video.
 * @param string $provider Video provider
 * @param string $atts Attributes for video iframe
 *
 * @return void
 */
function the_video($id, $provider='', $atts=array())
{
    echo get_video($id, $provider, $atts);
}

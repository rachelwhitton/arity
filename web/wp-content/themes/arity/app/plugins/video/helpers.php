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
function video($id, $atts=array())
{
    return new Video($id, $atts);
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
function get_video($id, $atts=array())
{
    return video($id, $atts)->output();
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
function the_video($id, $atts=array())
{
    echo get_video($id, $atts);
}

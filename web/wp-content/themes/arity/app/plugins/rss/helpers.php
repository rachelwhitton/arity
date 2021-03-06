<?php

declare(strict_types=1);

namespace App\Theme;

use Rss\Rss;

// Exit if accessed directly
if (! defined('ABSPATH')) {
    exit;
}

/**
 * Gets rss instance. Supports vimeo, youtube.
 *
 * @param string $id Url or id of the rss.
 * @param string $provider Rss provider
 * @param string $atts Attributes for rss iframe
 *
 * @return \Rss
 */
function rss($id)
{
    return new Rss($id);
}

/**
 * Gets rss instance. Supports vimeo, youtube.
 *
 * @param string $id Url or id of the rss.
 * @param string $provider Rss provider
 * @param string $atts Attributes for rss iframe
 *
 * @return string html output
 */
function get_rss($id)
{
    // changed to parse new careers RSS feed
    $xml_array = (array) simplexml_load_file($id);
    return $xml_array;
    // return rss($id)->output();
}

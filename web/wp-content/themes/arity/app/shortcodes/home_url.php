<?php

namespace Shortcode;

/**
 * Home url Shortcode
 *
 * @since 1.0.0
 * @return string WP Home Url string.
 */
function home_url()
{
    return home_url();
}
add_shortcode('home_url', __NAMESPACE__ . '\\home_url');

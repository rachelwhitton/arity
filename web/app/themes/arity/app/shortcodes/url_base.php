<?php

namespace Shortcode;

/**
 * Url Base Shortcode
 *
 * @since 1.0.0
 * @return string WP url.
 */
add_shortcode('url_base', function () {
    return get_bloginfo("url");
});

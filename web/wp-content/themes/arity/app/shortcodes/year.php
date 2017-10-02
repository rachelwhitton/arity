<?php

namespace Shortcode;

/**
 * Year Shortcode
 *
 * @since 1.0.0
 * @return string current year.
 */
function year()
{
    return date('Y');
}
add_shortcode('year', __NAMESPACE__ . '\\year');

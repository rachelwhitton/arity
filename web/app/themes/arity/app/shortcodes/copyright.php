<?php

namespace Shortcode;

/**
 * Copyright Shortcode
 *
 * @since 1.0.0
 * @return string HTML output copyright string.
 */
function copyright()
{
    return '&copy; ' . date('Y') . ' Arity, LLC. All rights reserved.';
}
add_shortcode('copyright', __NAMESPACE__ . '\\copyright');

<?php

/*
 * This file is part of WordPlate.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

// Set a custom footer text.
add_filter('admin_footer_text', function () {
    $text = get_theme_support('plate-footer');

    return reset($text);
});

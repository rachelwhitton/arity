<?php

declare(strict_types=1);

namespace App\Theme;

/**
 * Page titles
 *
 * @return string
 */
function title()
{
    if (is_home()) {
        if ($home = get_option('page_for_posts', true)) {
            return get_the_title($home);
        }
        return __('Latest Posts', config('textdomain'));
    }
    if (is_archive()) {
        return get_the_archive_title();
    }
    if (is_search()) {
        return sprintf(__('Search Results for %s', config('textdomain')), get_search_query());
    }
    if (is_404()) {
        return __('Not Found', config('textdomain'));
    }
    return get_the_title();
}

/**
 * Page titles
 *
 * @param array $arr
 * @return string $attrs
 */
function arrayToAttrs(array $arr = array())
{
    $attrs = '';
    foreach ($arr as $att => $value) {
        $attrs .= "{$att}=\"{$value}\" ";
    }
    $attrs = trim($attrs);
    return $attrs;
}

/**
 * Page titles
 *
 * @param string $content
 * @return string $content
 */
function wrapSymbols($content)
{
    $content = preg_replace('#&reg;(?!\s*</sup>|[^<]*>)#', '<sup>&reg;</sup>', $content);
    $content = preg_replace('#®(?!\s*</sup>|[^<]*>)#', '<sup>&reg;</sup>', $content);
    $content = preg_replace('#&trade;(?!\s*</sup>|[^<]*>)#', '<sup>&trade;</sup>', $content);
    $content = preg_replace('#™(?!\s*</sup>|[^<]*>)#', '<sup>&trade;</sup>', $content);
    $content = preg_replace('#&copy;(?!\s*</sup>|[^<]*>)#', '<sup>&copy;</sup>', $content);
    $content = preg_replace('#©(?!\s*</sup>|[^<]*>)#', '<sup>&copy;</sup>', $content);
    $content = preg_replace('#&\#8480;(?!\s*</sup>|[^<]*>)#', '<sup>&\#8480;</sup>', $content);
    $content = preg_replace('#℠(?!\s*</sup>|[^<]*>)#', '<sup>&#8480;</sup>', $content);

    return $content;
}

function updateElImportance(string $el, $interval = 0)
{
    preg_match_all('/^([^\d]+)(\d+)/', $el, $parts);
    $el = $parts[1][0] . ($parts[2][0] + $interval);

    return $el;
}

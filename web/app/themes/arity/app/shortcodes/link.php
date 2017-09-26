<?php

namespace Shortcode;

/**
 * Link Shortcode
 *
 * @since 1.0.0
 * @return string
 */
add_shortcode('link', function ($attr, $text_link) {

    // Grab content between brackets and define as text_link
    if (!empty($text_link)) {
        $attr['text'] = $text_link;
    }

    // Define default link class
    $link_class = 'link';

    // Define link class if type if passed
    if (!empty($attr['type'])) {
        $link_class = $attr['type'].'_link';
    }

    // Add link classes to attr classes array
    $attr['classes'][] = $link_class;

    // Pull in classes from shortcode, convert to array, merge array into attr classes
    $attr['class'] = isset($attr['class']) ? $attr['class'] : '';
    $attr['class'] = explode(" ", $attr['class']);
    $attr['classes'] = array_merge($attr['classes'], $attr['class']);

    // Create <a> attributes
    $a_attrs_arr['href'] = isset($attr['href']) ? $attr['href'] : null;
    $a_attrs_arr['target'] = isset($attr['target']) ? $attr['target'] : null;
    $a_attrs_arr['title'] = isset($attr['title']) ? $attr['title'] : null;
    $a_attrs_arr['class'] = isset($attr['classes']) ? implode($attr['classes'], " ") : null;

    // Convert $a_attrs_arr array to a attributes string
    $a_attrs = '';
    foreach ($a_attrs_arr as $key => $value) {
        if (!empty($value)) {
            $a_attrs .= $key . '="' . htmlspecialchars($value) . '" ';
        }
    }

    // Start empty string
    $link = '';

    // Link HTML
    $link .= '<a '.$a_attrs.'>';

    // Link button circle, if 'circle-bkg-color' is passed
    if (!empty($attr['icon']) && !empty($attr['circle-bkg-color'])) {
        $link .= '<span class="button--circle '.$attr['circle-bkg-color'].'-bg--">';
    }

    // Link icon, if 'icon' is passed
    if (!empty($attr['icon'])) {
        $link .= '<svg class="icon-svg" title="" role="img"><use xlink:href="#'.$attr['icon'].'"/></svg>';
    }

    // End link circle-bkg span
    if (!empty($attr['icon']) && !empty($attr['circle-bkg-color'])) {
        $link .= '</span>';
    }

    // Link text
    $link .= '<span class="'.$link_class.'__text">'.$attr['text'].'</span>';

    // End link
    $link .= '</a>';

    return $link;
});

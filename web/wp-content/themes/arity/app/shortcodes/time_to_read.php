<?php

namespace Shortcode;

/**
 * Time to Read Shortcode
 *
 * @since 1.0.0
 * @return string time to read in minutes.
 */

function ttr($atts) {
  if($atts){
    $excerpt_count = str_word_count( strip_tags( get_post_field( 'post_excerpt', $atts['id'] ) ) );
    $word_count = str_word_count( strip_tags( get_post_field( 'post_content', $atts['id'] ) ) );
  }else{
    $excerpt_count = str_word_count( strip_tags( get_post_field( 'post_excerpt', get_the_ID() ) ) );
    $word_count = str_word_count( strip_tags( get_post_field( 'post_content', get_the_ID() ) ) );
  }

  $ttr = floor(($word_count+$excerpt_count) / 150);
  $ttr = $ttr < 1 ? 1 : $ttr;
   return sprintf(
      __( '%s min read', 'text-domain' ), $ttr
   );
}
add_shortcode('ttr', __NAMESPACE__ . '\\ttr');

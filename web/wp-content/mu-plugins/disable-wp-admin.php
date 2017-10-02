<?php
/*
Plugin Name:  Disable WP Admin
Description:  Disable WP Admin if you don't want it accessible. To enable, set DISABLE_ADMIN to true.
Version:      1.0.0
Author:       VSA Partners
Author URI:   http://www.vsapartners.com
License:      MIT License
*/

if (defined('DISABLE_ADMIN') && DISABLE_ADMIN == true ) {
  if ( is_admin() ) {
    wp_die(__('WP Admin is disabled.'));
  }
}

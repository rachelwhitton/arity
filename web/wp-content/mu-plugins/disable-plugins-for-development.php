<?php
/*
Plugin Name:  Disable Plugins for Development
Description:  Disable Plugins for your Development environment.
Version:      1.0.0
Author:       VSA Partners
Author URI:   http://www.vsapartners.com
License:      MIT License
*/

/**
 * Disable specified plugins in your development environment.
 *
 * This is a "Must-Use" plugin. Code here is loaded automatically before
 * regular plugins load. This is the only place from which regular plugins
 * can be disabled programatically.
 *
 * Place this code in a file in WP_CONTENT_DIR/mu-plugins or specify a
 * custom location by setting the WPMU_PLUGIN_URL and WPMU_PLUGIN_DIR
 * constants in wp-config.php.
 *
 * This code depends on a server environment variable of WP_ENV, which I set
 * to "development" or "production" in each particular server/environment.
 */

if (!empty(WP_ENV) && WP_ENV == 'development') {
  $plugins = array(
    'w3-total-cache/w3-total-cache.php',
    'loginizer/loginizer.php',
    'wp-optimize/wp-optimize.php',
    'wordfence/wordfence.php',
    'aryo-activity-log/aryo-activity-log.php',
    'ewww-image-optimizer/ewww-image-optimizer.php',
    'login-lockdown/loginlockdown.php',
    'wp-native-php-sessions/pantheon-sessions.php',
    'pantheon-hud/pantheon-hud.php',
    'pantheon-advanced-page-cache/pantheon-advanced-page-cache.php'
  );
  require_once(ABSPATH . 'wp-admin/includes/plugin.php');
  deactivate_plugins($plugins);
}

<?php
/*
Plugin Name:  Disable Htaccess Rewrite Rules
Plugin URI:   https://www.vsapartners.com
Description:  Disable Wordpress overwriting the htaccess file for changing rewrite rules.
Version:      1.0.0
Author:       VSA Partners
Author URI:   https://www.vsapartners.com
License:      MIT License
*/

// Stop WordPress from modifying .htaccess permalink rules
add_filter('flush_rewrite_rules_hard','__return_false');

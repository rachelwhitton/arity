<?php
/** Staging */

ini_set('display_errors', 0);
define('WP_DEBUG_DISPLAY', false);
define('SCRIPT_DEBUG', false);

/** Disable all file modifications including updates and update notifications */
defined('DISALLOW_FILE_MODS') || define('DISALLOW_FILE_MODS', env('DISALLOW_FILE_MODS') ?: true);

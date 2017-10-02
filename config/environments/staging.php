<?php
/** Staging */

ini_set('display_errors', 0);
define('WP_DEBUG_DISPLAY', false);
define('SCRIPT_DEBUG', false);

/** Disable all file modifications including updates and update notifications */
define('DISALLOW_FILE_MODS', env('DISALLOW_FILE_MODS') !== null ? env('DISALLOW_FILE_MODS') : true);
define('DISABLE_ADMIN', ( env('DISABLE_ADMIN') !== null ? env('DISABLE_ADMIN') : true ));

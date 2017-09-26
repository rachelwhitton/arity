<?php
/** Staging */
/** Disable all file modifications including updates and update notifications */
define('DISALLOW_FILE_MODS', true);
define('DISABLE_ADMIN', ( env('DISABLE_ADMIN') !== null ? env('DISABLE_ADMIN') : true ));

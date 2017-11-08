<?php

# This is a Windows-friendly symlink
if (file_exists($objectCache = WP_CONTENT_DIR . '/mu-plugins/wp-redis/object-cache.php')) {
    if (defined('DISABLE_CACHE') && DISABLE_CACHE == true)
		return;

	if ( ! defined('ENABLE_CACHE') || ENABLE_CACHE == false )
		return;

    require_once $objectCache;
}

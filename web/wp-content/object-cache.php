<?php

# This is a Windows-friendly symlink
if (file_exists($objectCache = WP_CONTENT_DIR . '/mu-plugins/wp-redis/object-cache.php')) {
    if (defined('DISABLE_CACHE') && DISABLE_CACHE == true)
		return;

	if ( ! defined('ENABLE_CACHE') || ENABLE_CACHE == false )
		return;

    $redis_server = array(
        'host'     => !empty(REDIS_HOST) ? REDIS_HOST : '127.0.0.1',
        'port'     => !empty(REDIS_PORT) ? REDIS_PORT : 6379,
        'auth'     => !empty(REDIS_AUTH) ? REDIS_AUTH : '',
        'database' => !empty(REDIS_DB) ? REDIS_DB : WP_CACHE_KEY_SALT, // Use a unique value to prevent multiple site conflics
    );

    require_once $objectCache;
}

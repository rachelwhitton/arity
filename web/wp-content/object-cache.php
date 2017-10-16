<?php

# This is a Windows-friendly symlink
if (file_exists($objectCache = WP_CONTENT_DIR . '/plugins/wp-redis/object-cache.php')) {
    require_once $objectCache;
}

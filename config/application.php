<?php

use Symfony\Component\HttpFoundation\Request;

/** @var string Directory containing all of the site's files */
$root_dir = dirname(__DIR__);

/** @var string Document Root */
$webroot_dir = $root_dir . '/web';

/**
 * Expose global env() function from oscarotero/env
 */
Env::init();

/**
 * Use Dotenv to set required environment variables and load .env file in root
 */
$dotenv = new Dotenv\Dotenv($root_dir);
if (file_exists($root_dir . '/.env')) {
    $dotenv->load();
    $dotenv->required(['DB_NAME', 'DB_USER', 'DB_PASSWORD']);
}

/**
 * Pantheon Hosting Environment
 */
if(isset( $_ENV['PANTHEON_ENVIRONMENT'] )) {
    $pantheon_config = __DIR__ . '/environments/pantheon.php';

    if (file_exists($pantheon_config)) {
        require_once $pantheon_config;
    }
}

/**
 * Set up our global environment constant and load its config first
 * Default: production
 */
define('WP_ENV', env('WP_ENV') ?: 'production');
define( 'IS_LOCAL', env('IS_LOCAL') ?: false);

$env_config = __DIR__ . '/environments/' . WP_ENV . '.php';

if (file_exists($env_config)) {
    require_once $env_config;
}

/**
 * URLs
 */
// Set the home url to the current domain.
$request = Request::createFromGlobals();
define('WP_HOME', env('WP_HOME') ?: $request->getSchemeAndHttpHost());
define('WP_SITEURL', env('WP_SITEURL') ?: WP_HOME);

/**
 * Custom Content Directory
 */
define('CONTENT_DIR', env('CONTENT_DIR') !== null ? env('CONTENT_DIR') : '/app');
define('WP_CONTENT_DIR', $webroot_dir . CONTENT_DIR);
define('WP_CONTENT_URL', WP_HOME . CONTENT_DIR);

/**
 * DB settings
 */
if(!defined('DB_NAME'))
    define('DB_NAME', env('DB_NAME'));
if(!defined('DB_USER'))
    define('DB_USER', env('DB_USER'));
if(!defined('DB_PASSWORD'))
    define('DB_PASSWORD', env('DB_PASSWORD'));
if(!defined('DB_HOST'))
    define('DB_HOST', env('DB_HOST') ?: 'localhost');
if(!defined('DB_CHARSET'))
    define('DB_CHARSET', env('DB_CHARSET') ?: 'utf8mb4');
if(!defined('DB_COLLATE'))
    define('DB_COLLATE', env('DB_COLLATE') ?: 'utf8mb4_unicode_ci');
$table_prefix = env('DB_PREFIX') ?: 'wp_';

/**
 * Authentication Unique Keys and Salts
 */
if(!defined('AUTH_KEY'))
    define('AUTH_KEY', env('AUTH_KEY'));
if(!defined('SECURE_AUTH_KEY'))
    define('SECURE_AUTH_KEY', env('SECURE_AUTH_KEY'));
if(!defined('LOGGED_IN_KEY'))
    define('LOGGED_IN_KEY', env('LOGGED_IN_KEY'));
if(!defined('NONCE_KEY'))
    define('NONCE_KEY', env('NONCE_KEY'));
if(!defined('AUTH_SALT'))
    define('AUTH_SALT', env('AUTH_SALT'));
if(!defined('SECURE_AUTH_SALT'))
    define('SECURE_AUTH_SALT', env('SECURE_AUTH_SALT'));
if(!defined('LOGGED_IN_SALT'))
    define('LOGGED_IN_SALT', env('LOGGED_IN_SALT'));
if(!defined('NONCE_SALT'))
    define('NONCE_SALT', env('NONCE_SALT'));

/**
 * Set the default WordPress theme
 */
if(env('ACF_PRO_KEY')) {
    define('ACF_PRO_KEY', env('ACF_PRO_KEY'));
}

/**
 * Set the default WordPress theme
 */
if(env('WP_THEME')) {
    define('WP_DEFAULT_THEME', env('WP_THEME'));
}

/**
 * WordPress debugging mode.
 */
$debug =  defined('WP_DEBUG') ? WP_DEBUG : (env('WP_DEBUG') ?: false);
if(!defined('WP_DEBUG')) {
    define('WP_DEBUG', $debug);
}

define('WP_DEBUG_LOG', env('WP_DEBUG_LOG') ?: false);
define('WP_DEBUG_DISPLAY', env('WP_DEBUG_DISPLAY') ?: $debug);
define('SCRIPT_DEBUG', env('SCRIPT_DEBUG') ?: $debug);
define('SAVEQUERIES', env('SAVEQUERIES') ?: $debug);

/**
 * Revisions Settings
 */
define('AUTOSAVE_INTERVAL', env('AUTOSAVE_INTERVAL') ?: 300);
define('EMPTY_TRASH_DAYS', env('EMPTY_TRASH_DAYS') ?: 14);
define('WP_POST_REVISIONS', env('WP_POST_REVISIONS') ?: 5);

/**
 * Custom Settings
 */
define('DISALLOW_FILE_EDIT', env('DISALLOW_FILE_EDIT') ?: true);
define('IMAGE_EDIT_OVERWRITE', env('IMAGE_EDIT_OVERWRITE') ?: true);
define('AUTOMATIC_UPDATER_DISABLED', env('AUTOMATIC_UPDATER_DISABLED') ?: true);
define('DISABLE_WP_CRON', env('DISABLE_WP_CRON') ?: false); // If WP Cron is disabled, it is required to setup a separate cron job
define('DISABLE_CACHE', env('DISABLE_CACHE') ?: false);
define('FORCE_SSL_ADMIN', env('FORCE_SSL_ADMIN') ?: false);
if (!defined('DISABLE_ADMIN')) {
    define('DISABLE_ADMIN', env('DISABLE_ADMIN') ?: false);
}

/**
 * Bootstrap WordPress
 */
if (!defined('ABSPATH')) {
    define('ABSPATH', $webroot_dir . '/wp/');
}

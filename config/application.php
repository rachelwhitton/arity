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
if (isset($_ENV['PANTHEON_ENVIRONMENT'])) {
    $pantheon_config = __DIR__ . '/environments/pantheon.php';

    if (file_exists($pantheon_config)) {
        require_once $pantheon_config;
    }
}

/**
 * Set up our global environment constant and load its config first
 * Default: production
 */

defined('WP_ENV') || define('WP_ENV', env('WP_ENV') ?: 'production');
defined('IS_LOCAL') || define('IS_LOCAL', env('IS_LOCAL') ?: false);

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
define('WP_SITEURL', env('WP_SITEURL') ?: WP_HOME . '/wp');

/**
 * Custom Content Directory
 */
define('CONTENT_DIR', env('CONTENT_DIR') !== null ? env('CONTENT_DIR') : '/wp-content');
define('WP_CONTENT_DIR', $webroot_dir . CONTENT_DIR);
define('WP_CONTENT_URL', WP_HOME . CONTENT_DIR);

/**
 * DB settings
 */
defined('DB_NAME') || define('DB_NAME', env('DB_NAME'));
defined('DB_USER') || define('DB_USER', env('DB_USER'));
defined('DB_PASSWORD') || define('DB_PASSWORD', env('DB_PASSWORD'));
defined('DB_HOST') || define('DB_HOST', env('DB_HOST') ?: 'localhost');
defined('DB_CHARSET') || define('DB_CHARSET', env('DB_CHARSET') ?: 'utf8mb4');
defined('DB_COLLATE') || define('DB_COLLATE', env('DB_COLLATE') ?: 'utf8mb4_unicode_ci');
$table_prefix = env('DB_PREFIX') ?: 'wp_';

/**
 * Authentication Unique Keys and Salts
 */
defined('AUTH_KEY') || define('AUTH_KEY', env('AUTH_KEY'));
defined('SECURE_AUTH_KEY') || define('SECURE_AUTH_KEY', env('SECURE_AUTH_KEY'));
defined('LOGGED_IN_KEY') || define('LOGGED_IN_KEY', env('LOGGED_IN_KEY'));
defined('NONCE_KEY') || define('NONCE_KEY', env('NONCE_KEY'));
defined('AUTH_SALT') || define('AUTH_SALT', env('AUTH_SALT'));
defined('SECURE_AUTH_SALT') || define('SECURE_AUTH_SALT', env('SECURE_AUTH_SALT'));
defined('LOGGED_IN_SALT') || define('LOGGED_IN_SALT', env('LOGGED_IN_SALT'));
defined('NONCE_SALT') || define('NONCE_SALT', env('NONCE_SALT'));

/**
 * Validate Authentication Keys and Salts are being used
 */
if (empty(AUTH_KEY) || empty(SECURE_AUTH_KEY) || empty(LOGGED_IN_KEY) || empty(NONCE_KEY) || empty(AUTH_SALT) || empty(SECURE_AUTH_SALT) || empty(LOGGED_IN_SALT) || empty(NONCE_SALT)) {
    trigger_error('Missing Wordpress Authentication Keys and Salts.', E_USER_ERROR);
}

/**
 * Set the default WordPress theme
 */
if (env('ACF_PRO_KEY')) {
    define('ACF_PRO_KEY', env('ACF_PRO_KEY'));
}

/**
 * Set the default WordPress theme
 */
if (env('WP_THEME')) {
    define('WP_DEFAULT_THEME', env('WP_THEME'));
}

/**
 * WordPress debugging mode.
 */
$debug =  defined('WP_DEBUG') ? WP_DEBUG : (env('WP_DEBUG') ?: false);
if (!defined('WP_DEBUG')) {
    define('WP_DEBUG', $debug);
}

defined('WP_DEBUG_LOG') || define('WP_DEBUG_LOG', env('WP_DEBUG_LOG') ?: false);
defined('WP_DEBUG_DISPLAY') || define('WP_DEBUG_DISPLAY', env('WP_DEBUG_DISPLAY') ?: $debug);
defined('SCRIPT_DEBUG') || define('SCRIPT_DEBUG', env('SCRIPT_DEBUG') ?: $debug);
defined('SAVEQUERIES') || define('SAVEQUERIES', env('SAVEQUERIES') ?: $debug);

/**
 * Revisions Settings
 */
defined('AUTOSAVE_INTERVAL') || define('AUTOSAVE_INTERVAL', env('AUTOSAVE_INTERVAL') ?: 300);
defined('EMPTY_TRASH_DAYS') || define('EMPTY_TRASH_DAYS', env('EMPTY_TRASH_DAYS') ?: 14);
defined('WP_POST_REVISIONS') || define('WP_POST_REVISIONS', env('WP_POST_REVISIONS') ?: 5);

/**
 * Redis Config
 */
define('WP_CACHE_KEY_SALT', md5( DB_NAME . $table_prefix . __FILE__ ) );
$redis_server = array(
    'host'     => env('REDIS_HOST') ?: '127.0.0.1',
    'port'     => env('REDIS_PORT') ?: 6379,
    'auth'     => env('REDIS_AUTH') ?: '',
    'database' => env('REDIS_DB') ?: WP_CACHE_KEY_SALT // Use a unique value to prevent multiple site conflics
);

/**
 * Custom Settings
 */
defined('DISALLOW_FILE_MODS') || define('DISALLOW_FILE_MODS', env('DISALLOW_FILE_MODS') ?: false);
defined('DISALLOW_FILE_EDIT') || define('DISALLOW_FILE_EDIT', env('DISALLOW_FILE_EDIT') ?: true);
defined('IMAGE_EDIT_OVERWRITE') || define('IMAGE_EDIT_OVERWRITE', env('IMAGE_EDIT_OVERWRITE') ?: true);
defined('AUTOMATIC_UPDATER_DISABLED') || define('AUTOMATIC_UPDATER_DISABLED', env('AUTOMATIC_UPDATER_DISABLED') ?: true);
defined('DISABLE_WP_CRON') || define('DISABLE_WP_CRON', env('DISABLE_WP_CRON') ?: false); // If WP Cron is disabled, it is required to setup a separate cron job
defined('DISABLE_CACHE') || define('DISABLE_CACHE', env('DISABLE_CACHE') ?: null);
defined('ENABLE_CACHE') || define('ENABLE_CACHE', env('ENABLE_CACHE') ?: false);
defined('FORCE_SSL_ADMIN') || define('FORCE_SSL_ADMIN', env('FORCE_SSL_ADMIN') ?: false);
defined('DISABLE_ADMIN') || define('DISABLE_ADMIN', env('DISABLE_ADMIN') ?: false);

/**
 * Bootstrap WordPress
 */
if (!defined('ABSPATH')) {
    define('ABSPATH', $webroot_dir . '/wp/');
}

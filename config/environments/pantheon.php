<?php

// ** MySQL settings - included in the Pantheon Environment ** //
/** The name of the database for WordPress */
define('DB_NAME', $_ENV['DB_NAME']);
/** MySQL database username */
define('DB_USER', $_ENV['DB_USER']);
/** MySQL database password */
define('DB_PASSWORD', $_ENV['DB_PASSWORD']);
/** MySQL hostname; on Pantheon this includes a specific port number. */
define('DB_HOST', $_ENV['DB_HOST'] . ':' . $_ENV['DB_PORT']);

// ** Authentication Unique Keys and Salts. ** //
define('AUTH_KEY', $_ENV['AUTH_KEY']);
define('SECURE_AUTH_KEY', $_ENV['SECURE_AUTH_KEY']);
define('LOGGED_IN_KEY', $_ENV['LOGGED_IN_KEY']);
define('NONCE_KEY', $_ENV['NONCE_KEY']);
define('AUTH_SALT', $_ENV['AUTH_SALT']);
define('SECURE_AUTH_SALT', $_ENV['SECURE_AUTH_SALT']);
define('LOGGED_IN_SALT', $_ENV['LOGGED_IN_SALT']);
define('NONCE_SALT', $_ENV['NONCE_SALT']);

// ** Ewww Image Optimization Settings. ** //
define('EWWW_IMAGE_OPTIMIZER_RELATIVE', true);

// Don't show deprecations; useful under PHP 5.5
error_reporting(E_ALL ^ E_DEPRECATED);

// Force the use of a safe temp directory when in a container
if (defined('PANTHEON_BINDING')) :
    define('WP_TEMP_DIR', sprintf('/srv/bindings/%s/tmp', PANTHEON_BINDING));
endif;

echo $_ENV['PANTHEON_ENVIRONMENT'];
exit;

// For Pantheon test and live sites use production, all others environments use development
if (!defined('WP_ENV')) {
    define('WP_ENV', 'production');
}

// ** Always force HTTPS for Pantheon. ** //
if (php_sapi_name() != 'cli') {
    $primary_domain = $_SERVER['HTTP_HOST'];

    if ($_ENV['PANTHEON_ENVIRONMENT'] === 'live' && !empty(env('PANTHEON_LIVE_DOMAIN'))) {
        $primary_domain = env('PANTHEON_LIVE_DOMAIN');
    }

    if ($_SERVER['HTTP_HOST'] != $primary_domain
      || !isset($_SERVER['HTTP_X_SSL'])
      || $_SERVER['HTTP_X_SSL'] != 'ON' ) {
        # Name transaction "redirect" in New Relic for improved reporting (optional)
        if (extension_loaded('newrelic')) {
            newrelic_name_transaction("redirect");
        }

        header('HTTP/1.0 301 Moved Permanently');
        header('Location: https://'. $primary_domain . $_SERVER['REQUEST_URI']);
        exit();
    }
}

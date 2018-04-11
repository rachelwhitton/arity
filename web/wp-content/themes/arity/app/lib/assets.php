<?php

declare(strict_types=1);

namespace App\Theme;

/*
|-----------------------------------------------------------------
| Theme Assets
|-----------------------------------------------------------------
|
| This file is for registering your theme stylesheets and scripts.
| In here you should also deregister all unwanted assets which
| can be shiped with various third-parity plugins.
|
*/

use function App\Theme\asset_path;

function is_pantheon_dev() {
    return (!empty($_ENV['PANTHEON_ENVIRONMENT']) && $_ENV['PANTHEON_ENVIRONMENT'] == 'dev');
}

/**
 * Registers theme stylesheet files.
 *
 * @since 1.0.0
 * @return void
 */
function register_stylesheets()
{
    $arity = asset_path('patterns/') . config('patterns-version') . "/css/style.css";
    $arity_version = null;
    if(!empty(WP_ENV) && WP_ENV == "staging") {
        $arity = "https://dev.patterns.arity.vsadev.com/css/style.css";
        if(is_pantheon_dev()) {
            $arity = "https://patterns.arity.vsadev.com/latest/css/style.css";
        }
        $arity_version = time();
    } else if(!empty(WP_ENV) && WP_ENV == "development") {
        $arity = "https://localhost:3000/css/style.css";
    }

    wp_enqueue_style('arity', $arity, null, $arity_version);
    wp_enqueue_style('main', asset_path('css/main.css'), array('arity'), config('version'));
    wp_enqueue_style('roboto', 'https://fonts.googleapis.com/css?family=Roboto', false );
}
add_action('wp_enqueue_scripts', __namespace__ . '\\register_stylesheets');
// add_action( 'get_footer', __namespace__ . '\\register_stylesheets');

/**
 * Registers vendor script files.
 *
 * @since 1.0.0
 * @return void
 */
function register_vendor_scripts()
{
    wp_register_script('ScrollMagic-tweenMax', '//cdnjs.cloudflare.com/ajax/libs/gsap/1.20.2/TweenMax.min.js', null, null, true);
    wp_register_script('ScrollMagic', '//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/ScrollMagic.min.js', null, null, true);
    wp_register_script('ScrollMagic-animation', '//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/plugins/animation.gsap.js', null, null, true);
}
add_action('wp_enqueue_scripts', __namespace__ . '\\register_vendor_scripts');

/**
 * Registers theme script files.
 *
 * @since 1.0.0
 * @return void
 */
function register_scripts()
{
    $arity = asset_path('patterns/') . config('patterns-version') . "/js/arity.js";
    $arity_version = null;
    if(!empty(WP_ENV) && WP_ENV == "staging") {
        $arity = "https://dev.patterns.arity.vsadev.com/js/arity.js";
        if(is_pantheon_dev()) {
            $arity = "https://patterns.arity.vsadev.com/latest/js/arity.js";
        }
        $arity_version = time();
    } else if(!empty(WP_ENV) && WP_ENV == "development") {
        $arity = "https://localhost:3000/js/arity.js";
    }

    wp_enqueue_script('arity', $arity, array( 'jquery', 'ScrollMagic-tweenMax', 'ScrollMagic', 'ScrollMagic-animation' ), $arity_version, true);
    wp_enqueue_script('lazysizes', asset_path('js/lazysizes.js'), '4.0.1', true);
    wp_enqueue_script('main', asset_path('js/main.js'), array( 'jquery', 'arity' ), config('version'), true);
}
add_action('wp_enqueue_scripts', __namespace__ . '\\register_scripts');

/*
|-----------------------------------------------------------------
| WP jQuery
|-----------------------------------------------------------------
*/

/**
 * If "jquery_version" config is set, then update jquery version number
 *
 * @param  \WP_Scripts $scripts
 * @since 1.0.0
 * @return void
 */
function update_jquery_version($scripts)
{
    // Return if the website is being requested via the admin or theme customizer
    global $wp_customize;
    if (is_admin() || isset($wp_customize)) {
        return;
    }

    if (config('jquery')['use_cdn'] && ($jquery_version = config('jquery')['version'])) {
        // var_dump($jquery_version);
        $scripts->remove('jquery');
        $scripts->add('jquery', false, array( 'jquery-core' ), $jquery_version);
    };
}
add_action('wp_default_scripts', __namespace__ . '\\update_jquery_version');

/**
 * Register jQuery
 */
function use_jquery_cdn()
{
    if (! config('jquery')['use_cdn']) {
        return;
    }

    $jquery_version = wp_scripts()->registered['jquery']->ver;

    wp_deregister_script('jquery');
    wp_register_script('jquery', 'https://code.jquery.com/jquery-' . $jquery_version . '.min.js', array(), null, true);

    add_filter('wp_resource_hints', function ($urls, $relation_type) {
        if ($relation_type === 'dns-prefetch') {
            $urls[] = 'code.jquery.com';
        }
        return $urls;
    }, 10, 2);
    add_filter('script_loader_src', __NAMESPACE__ . '\\jquery_local_fallback', 10, 2);
}
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\use_jquery_cdn', 100);

/**
 * Output the local fallback immediately after jQuery's <script>
 *
 * @link http://wordpress.stackexchange.com/a/12450
 */
function jquery_local_fallback($src, $handle = null)
{
    if (! config('jquery')['use_cdn']) {
        return $src;
    }

    static $add_jquery_fallback = false;
    if ($add_jquery_fallback) {
        echo '<script>(window.jQuery && jQuery.noConflict()) || document.write(\'<script src="' . $add_jquery_fallback .'"><\/script>\')</script>' . "\n";
        $add_jquery_fallback = false;
    }

    if ($handle === 'jquery') {
        // Check for jQuery local fallback in config
        if (empty($jquery_fallback = config('jquery')['local_fallback']) || empty(config('jquery')['version'])) {
            // Didn't provide local fallback and requested an unknown version to WP
            if (config('jquery')['version']) {
                return $src;
            }

            // Use WP local fallback, which comes with WP
            $jquery_fallback = includes_url('/js/jquery/jquery.js');
        };

        $add_jquery_fallback = apply_filters('script_loader_src', $jquery_fallback, 'jquery-fallback');
    }
    return $src;
}
add_action('wp_head', __NAMESPACE__ . '\\jquery_local_fallback');

/*
|-----------------------------------------------------------------
| WP Editor
|-----------------------------------------------------------------
*/

/**
 * Registers editor stylesheets.
 *
 * @since 1.0.0
 * @return void
 */
function register_editor_stylesheets()
{
    wp_enqueue_style('main', asset_path('css/editor.css'));
}
add_action('admin_init', __namespace__ . '\\register_editor_stylesheets');

/*
|-----------------------------------------------------------------
| WP Login Page
|-----------------------------------------------------------------
*/

/**
 * Registers login stylesheets.
 *
 * @since 1.0.0
 * @return void
 */
function register_login_stylesheets()
{
    wp_enqueue_style('main', asset_path('css/main.css'), null, config('version'));
    // wp_enqueue_script('main', asset_path('js/main.js'), null, config('version'), true);
}
add_action('login_enqueue_scripts', __namespace__ . '\\register_login_stylesheets');

/*
|-----------------------------------------------------------------
| BrowserSync
|-----------------------------------------------------------------
*/

/**
 * Adds BrowserSync
 *
 * @since 1.0.0
 * @return void
 */
function add_browser_sync()
{
    if (WP_ENV === 'development' || WP_ENV === 'local') {
        if (defined('BROWSER_SYNC') && constant('BROWSER_SYNC') == false) {
            return;
        }

        // Check for browser sync
        $headers = @get_headers('http://localhost:3001');
        if (empty($headers) || $headers[0] == 'HTTP/1.1 404 Not Found') {
            return;
        }

        echo '
			<script type=\'text/javascript\' id="__bs_script__">//<![CDATA[
				document.write("<script async src=\'https://HOST:8000/browser-sync/browser-sync-client.js\'><\/script>".replace("HOST", location.hostname));
			//]]></script>
		';
    }
}
add_action('wp_footer', __namespace__ . '\\add_browser_sync', 100);

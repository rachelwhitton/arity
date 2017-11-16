<?php

declare(strict_types=1);

namespace App\Theme;

/*
|-----------------------------------------------------------------
| Theme Configurations
|-----------------------------------------------------------------
|
| Theme settings.
|
*/

/**
 * Remove admin bar
 * @since 1.0.0
 * @return void
 */
add_filter('show_admin_bar', '__return_false');

/**
 * Add additional mime types
 * @since 1.0.0
 * @return void
 */
add_filter('mime_types', function ($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
});

/**
 * Remove JPEG compression.
 * @since 1.0.0
 * @return void
 */
add_filter('jpeg_quality', function () {
    return 100;
});

/**
 * Set custom excerpt more.
 * @since 1.0.0
 * @return void
 */
add_filter('excerpt_more', function () {
    return '...';
});

/**
 * Set custom excerpt length.
 * @since 1.0.0
 * @return void
 */
add_filter('excerpt_length', function () {
    return 101;
});

/**
 * Wrap symbols.
 * @since 1.0.0
 * @return void
 */
add_filter('the_content', 'App\Theme\wrapSymbols');

/**
 * Fix empty search
 * @since 1.0.0
 * @return void
 */
add_filter('pre_get_posts', function ($query) {
    // If 's' request variable is set but empty
    if (isset($_GET['s']) && empty($_GET['s']) && $query->is_main_query()) {
        $query->is_search = true;
        $query->is_home = false;
    }
    return $query;
});

/**
 * Shortcut to redirect to WP Admin Edit Screen
 * @since 1.0.0
 * @return void
 *
 * Add ?edit to the end of a page url and it will redirect you to the Wordpress admin screen
 */
add_action('wp', function () {
    if (isset($_GET['edit'])) {
        $user = wp_get_current_user();
        $allowed_roles = array('editor', 'administrator', 'author');
        if (!empty($user) && array_intersect($allowed_roles, $user->roles)) {
            global $post;
            $edit_link = get_edit_post_link($post->ID, '');
            header("Location: " . $edit_link);
        }
    }
});

/**
 * Check if redirect setting is being used.
 * @since 1.0.0
 * @return void
 */
add_action('template_redirect', function () {
    if (!function_exists('get_field')) {
        return;
    }

    if (get_field('_settings_redirect_page')) {
        wp_redirect(get_field('_settings_redirect_page'));
        exit();
    }
});

/**
 * Remove the tools admin link for editors.
 * @since 1.0.0
 * @return void
 */
add_action('admin_menu', function () {
    if (current_user_can('editor') || current_user_can('author')) {
        remove_menu_page('tools.php');
    }
});

/**
 * Remove items from WP Admin Menus.
 * @since 1.0.0
 * @return void
 */
add_filter('nav_menu_meta_box_object', function ($tax) {

    $disallowed_types = array('post','category','post_tag');
    if (in_array($tax->name, $disallowed_types)) {
        return false;
    }

    return $tax;
}, 200);

/**
 * Make sure Editors can update Menus
 * @since 1.0.0
 * @return void
 */
add_action('admin_init', function () {
    $role_object = get_role('editor');
    $role_object->add_cap('edit_theme_options');
});

/*
|-----------------------------------------------------------------
| SEO Configurations
|-----------------------------------------------------------------
|
| Configurations for SEO.
|
*/

/**
 * Moves Yoast metabox to bottom.
 * @since 1.0.0
 * @return void
 */
add_filter('wpseo_metabox_prio', function () {
    return 'low';
});

/**
 * Update login page title
 * @todo This doesn't seem to be working. Why not?
 * @since 1.0.0
 * @return void
 */
add_filter('document_title_separator', function () {
    return "|";
});

/**
 * Remove Yoast WP SEO dashboard widget.
 * @since 1.0.0
 * @return void
 */
add_action('wp_dashboard_setup', function () {
    global $wp_meta_boxes;

    unset($wp_meta_boxes['dashboard']['normal']['core']['wpseo-dashboard-overview']);
});

/*
|-----------------------------------------------------------------
| Analytics
|-----------------------------------------------------------------
|
| Configurations for Analytics.
|
*/

/**
 * Add Google Analytics.
 * @since 1.0.0
 * @return void
 */
$google_analytics_id = 'UA-90423861-1';
add_action('wp_head', function () use ($google_analytics_id) {

    if( empty($google_analytics_id) ) {
        return;
    }

    if( !empty(WP_ENV) && WP_ENV != 'production' ) {
        return;
    }

    echo <<<EOD

<!-- Google Analytics -->
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

ga('create', '$google_analytics_id', 'auto');
ga('send', 'pageview');
</script>
<!-- End Google Analytics -->

EOD;
});

/**
 * Add Google Tag Manager.
 * @since 1.0.0
 * @return void
 */
$gtag_id = false;
add_action('wp_head', function () use ($gtag_id) {

    if( empty($gtag_id) ) {
        return;
    }

    if( !empty(WP_ENV) && WP_ENV != 'production' ) {
        return;
    }

    echo <<<EOD

<!-- Google Tag Manager -->
<script async src="https://www.googletagmanager.com/gtag/js?id=$gtag_id"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments)};
  gtag('js', new Date());

  gtag('config', '$gtag_id');
</script>
<!-- End Google Tag Manager -->

EOD;
});

/**
 * Add Hot Jar Tracking Code.
 * @since 1.0.0
 * @return void
 */
$hotjar_tracking_code = '426469';
add_action('wp_head', function () use($hotjar_tracking_code) {
    if( empty($hotjar_tracking_code) ) {
        return;
    }

    if( !empty(WP_ENV) && WP_ENV != 'production' ) {
        return;
    }

    echo <<<EOD

<!-- Hotjar -->
<script>
(function(h,o,t,j,a,r){ h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)}; h._hjSettings={hjid:$hotjar_tracking_code,hjsv:5}; a=o.getElementsByTagName('head')[0]; r=o.createElement('script');r.async=1; r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv; a.appendChild(r); })(window,document,'//static.hotjar.com/c/hotjar-','.js?sv=');
</script>
<!-- End Hotjar -->

EOD;
});

/**
 * Add Adobe DTM Tracking Code.
 * @since 1.0.0
 * @return void
 */
$adobe_dtm_tracking_code = '0893390c40d93db48cc0d98a10c4fe9f90b72e2c';
add_action('wp_head', function () use($adobe_dtm_tracking_code) {
    if( !empty(WP_ENV) && !in_array(WP_ENV, array('production','staging'))) {
        return;
    }

    if( WP_ENV == 'staging' ) {
        $adobe_dtm_tracking_code .= '-staging';
    }

    echo <<<EOD

<!-- Adobe DTM -->
<script src="//assets.adobedtm.com/b46e318d845250834eda10c5a20827c045a4d76f/satelliteLib-$adobe_dtm_tracking_code.js"></script>
<!-- End Adobe DTM -->

EOD;
});

/**
 * Add Adobe DTM Tracking Code for Footer.
 * @since 1.0.0
 * @return void
 */
add_action('wp_footer', function () {
    if( !empty(WP_ENV) && !in_array(WP_ENV, array('production','staging'))) {
        return;
    }

    echo <<<EOD

<!-- Adobe DTM -->
<script type="text/javascript">_satellite.pageBottom();</script>
<!-- End Adobe DTM -->

EOD;
});

/*
|-----------------------------------------------------------------
| Login Configurations
|-----------------------------------------------------------------
|
| Configurations for the login page.
|
*/

/**
 * Change login logo url to homepage not wordpress.org
 * @since 1.0.0
 * @return void
 */
add_filter('login_headerurl', function () {
    return home_url();
});

/**
 * Update login page title
 * @since 1.0.0
 * @return void
 */
add_filter('login_headertitle', function () {
    return 'Return to ' . get_bloginfo('name');
});

/*
|-----------------------------------------------------------------
| Theme Building Configurations
|-----------------------------------------------------------------
|
| Configurations that affect the html output.
|
*/

/**
 * Add <body> classes
 *
 * @since 1.0.0
 * @param array $classes array of current classes on the body tag
 * @return array with updated classes
 */
add_filter('body_class', function (array $classes, array $class=array()) {
    global $post;

    $classes = array();

    if ( is_404() ) {
        $classes[] = 'template--error404';
    }

    // Add post details
    if ( isset( $post ) ) {
        $classes[] = $post->post_type . '--' . $post->post_name;

        // Add page template
        if( in_array($post->post_type, array('page')) )
        $template = get_post_meta( $post->ID, '_wp_page_template', true );
        $classes[] = 'template--' . $template;
    }

    // Add classes add through body_class function
    $classes = array_merge( $classes, $class );

    if ( is_user_logged_in() )
		$classes[] = 'logged-in';

    // Add environment class
    if (WP_ENV && WP_ENV != 'production') {
        $classes[] = 'env--' . WP_ENV;
    }

    $classes = array_map( 'esc_attr', $classes );

    return array_unique( $classes );
}, 15,  2);

/**
 * Add module class
 *
 * @since 1.0.0
 * @param array $classes array of current classes on the module div tags
 * @return array with updated classes
 */
add_action('module_class', function (array $classes) {
    $classes[] = 'ar-module';

    return array_unique($classes);
});

/**
 * Add component class
 *
 * @since 1.0.0
 * @param array $classes array of current classes on the component div tags
 * @return array with updated classes
 */
add_action('component_class', function (array $classes) {
    $classes[] = 'ar-component';

    return array_unique($classes);
});

/**
 * Add element class
 *
 * @since 1.0.0
 * @param array $classes array of current classes on the element div tags
 * @return array with updated classes
 */
add_action('element_class', function (array $classes) {
    $classes[] = 'ar-element';

    return array_unique($classes);
});

/**
 * Add partial class
 *
 * @since 1.0.0
 * @param array $classes array of current classes on the element div tags
 * @return array with updated classes
 */
add_action('partial_class', function (array $classes) {
    // $classes[] = '';
    return array_unique($classes);
});

/**
 * Theme head action used to add html to the theme's head
 * @see - https://github.com/audreyr/favicon-cheat-sheet
 * @see - http://www.favicon-generator.org/
 * @since 1.0.0
 * @return void
 */
add_action('theme/head', function () {
    $assets_folder = config('paths')['uri'] . '/' . config('directories')['dist'];

    echo <<<EOD
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="format-detection" content="telephone=no">

  <!-- Favicon & App Icons -->
  <link rel="shortcut icon" href="$assets_folder/icons/favicon.ico" type="image/x-icon">
  <link rel="icon" href="$assets_folder/icons/favicon.ico" type="image/x-icon">
  <link rel="apple-touch-icon" sizes="57x57" href="$assets_folder/icons/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="$assets_folder/icons/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="$assets_folder/icons/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="$assets_folder/icons/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="$assets_folder/icons/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="$assets_folder/icons/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="$assets_folder/icons/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="$assets_folder/icons/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="$assets_folder/icons/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192"  href="$assets_folder/icons/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="$assets_folder/icons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="$assets_folder/icons/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="$assets_folder/icons/favicon-16x16.png">
  <link rel="manifest" href="$assets_folder/icons/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="$assets_folder/icons/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">
EOD;
});

/**
 * Theme After Body
 * @since 1.0.0
 * @return void
 */
add_action('theme/after_body', function () {
    // echo <<<EOD
//   <div class="sr-only" id="_top"></div>
//   <div class="sr-only" id="_skipToMain"><a href="#main" class="jumplink">Skip to the main content</a></div>
//
// EOD;
});

/*
|-----------------------------------------------------------------
| Navigation
|-----------------------------------------------------------------
|
| Filters to update navigation without using a WP Nav Walker
|
*/

/**
 * Reset nav menu classes
 * @since 1.0.0
 * @return Array
 *
 * Returning an empty array resets all silly wp navigation classes
 */
add_filter('nav_menu_css_class', function ($classes, $item, $args) {
    if (is_object($args->walker)) { // Filter if custom walker
        $classes   = [];
        $classes[] = $args->menu_id . '__item';
        if ($args->menu_id === 'primary-navigation') {
            $classes[] = 'navlist__item--vertical';
        }
    }
    return $classes;
}, 10, 4);

/**
 * navMenuLinkAttributes
 * @since 1.0.0
 * @return $atts
 */
add_filter('nav_menu_link_attributes', function ($atts, $item, $args) {
    if (is_object($args->walker)) { // Filter if custom walker
        $post = get_post($item->object_id);

        $classes   = [];

        $classes[] = $args->menu_id . '__link';

        if ($item->current == 1 && strpos($item->url, '#') === false) {
            $classes[] = 'current-page';
        }

        if ($item->current == 1 && strpos($item->url, '#') === false) {
            $classes[] = 'current-page';
        }

        if ($item->current_item_parent == 1 && strpos($item->url, '#') === false) {
            $classes[] = 'current-page';
        }

        $atts['class'] = implode(' ', $classes);

        $atts['aria-selected'] = 'false';

        if (strpos($item->url, '#') !== false) {
            $atts['data-event-text'] = $item->title;
        }
    }
    return $atts;
}, 10, 3);

/**
 * Nav Menu Element
 * @since 1.0.0
 * @return String $item_output
 *
 * Returns html string that includes <a> element
 */
add_filter('walker_nav_menu_start_el', function ($item_output, $item, $depth, $args) {
    if (empty($item->is_last)) {
        $item_output .= '<svg class="icon-svg" title="" role="img"><use xlink:href="#dot-divider"></use></svg>';
    }

    return $item_output;
}, 10, 4);

/**
 * Nav Menu Item Id
 * @since 1.0.0
 * @return String $item_output
 */
add_filter('nav_menu_item_id', function ($menu_item_item_id, $item, $args, $depth) {
    // Don't return an id
    return null;
}, 10, 4);

/**
 * Nav Menu Item Title
 * @since 1.0.0
 * @return $title
 *
 * Returns <a> display text
 */
add_filter('nav_menu_item_title', function ($title) {
    return $title;
}, 10, 3);

/**
 * Nav Menu Objects
 * @since 1.0.0
 * @return Array $items
 *
 * Returns array of Nav Menu Objects
 */
add_filter('wp_nav_menu_objects', function ($items) {
    // Check make sure full url is used
    foreach ($items as $item) {
        if (strpos($item->url, '/') === 0) {
            $item->url = home_url() . $item->url;
        }
    }

    $items[1]->is_first = true;
    $items[count($items)]->is_last = true;
    return $items;
});


/*
|-----------------------------------------------------------------
| ACF
|-----------------------------------------------------------------
|
| Filters relating to ACF
|
*/

/**
 * Set ACF Pro license key on theme activation.
 * @since 1.0.0
 * @return void
 */
add_action('admin_init', function () {
    if (defined('ACF_PRO_KEY') && ! get_option('acf_pro_license')) {
        $save = array(
            'key'   => ACF_PRO_KEY,
            'url'   => home_url()
        );

        $save = maybe_serialize($save);
        $save = base64_encode($save);
        update_option('acf_pro_license', $save);
    }
});

/**
 * Apply the_content filter to ACF wysiwyg fields so shortcodes work
 * @since 1.0.0
 * @return string $value
 */
add_filter('acf/format_value/type=wysiwyg', function ($value) {
    $value = apply_filters('the_content', $value);
    return $value;
}, 10, 3);

/**
 * Dynamically create a robots.txt file
 * @since 1.0.0
 * @param string $output
 * @return string
 */
add_filter('robots_txt', function ($output) {
    $sitemap = home_url('/sitemap.xml');

    return <<<EOD
# www.robotstxt.org/

# Allow crawling of all content
User-agent: *
Disallow: /wp-admin/
Disallow: /wp/
Disallow: /trackback/
Disallow: /xmlrpc.php
Disallow: /feed/
Sitemap: $sitemap
EOD;

}, 10,  2);

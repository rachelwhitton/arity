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
add_action('theme/after_wphead', function () use ($google_analytics_id) {

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
$gtag_id = 'GTM-KH6GQ88';
add_action('theme/after_wphead', function () use ($gtag_id) {

    if( empty($gtag_id) ) {
        return;
    }

    if( !empty(WP_ENV) && WP_ENV != 'production' ) {
        return;
    }

    echo <<<EOD

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','$gtag_id');</script>
<!-- End Google Tag Manager -->

EOD;
});

/**
 * Add Google Tag Manager.
 * @since 1.0.0
 * @return void
 */
add_action('theme/after_body', function () use ($gtag_id) {

    if( empty($gtag_id) ) {
        return;
    }

    if( !empty(WP_ENV) && WP_ENV != 'production' ) {
        return;
    }

    echo <<<EOD

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=$gtag_id"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

EOD;
});

/**
 * Add Hot Jar Tracking Code.
 * @since 1.0.0
 * @return void
 */
// $hotjar_tracking_code = '426469';
$hotjar_tracking_code = false;
add_action('theme/after_wphead', function () use($hotjar_tracking_code) {
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
add_action('theme/after_wphead', function () use($adobe_dtm_tracking_code) {
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
add_action('theme/after_wpfooter', function () {
    if( !empty(WP_ENV) && !in_array(WP_ENV, array('production','staging'))) {
        return;
    }

    echo <<<EOD

<!-- Adobe DTM -->
<script type="text/javascript">_satellite.pageBottom();</script>
<!-- End Adobe DTM -->

EOD;
}, 100);

/**
 * Add Quantcast Tag for Footer.
 * @since 1.1.0
 * @return void
 */
add_action('theme/after_wphead', function () {

    if( !empty(WP_ENV) && WP_ENV != 'production' ) {
        return;
    }

    echo <<<EOD

<!-- Start Quantcast Tag -->
<script type="text/javascript">
var _qevents = _qevents || [];

 (function() {
   var elem = document.createElement('script');
   elem.src = (document.location.protocol == "https:" ? "https://secure" : "http://edge") + ".quantserve.com/quant.js";
   elem.async = true;
   elem.type = "text/javascript";
   var scpt = document.getElementsByTagName('script')[0];
   scpt.parentNode.insertBefore(elem, scpt);
  })();

_qevents.push({qacct: "p-CT9p1As87v16a"});

</script>
<noscript>
 <img src="//pixel.quantserve.com/pixel/p-CT9p1As87v16a.gif?labels=_fp.event.Default" style="display: none;" border="0" height="1" width="1" alt="Quantcast" class="sr-only" />
</noscript>
<!-- End Quantcast tag -->

EOD;
}, 101);

/**
 * Add Simplifi Tag for Footer.
 * @since 1.1.0
 * @return void
 */
add_action('theme/after_wpfooter', function () {

    if( !empty(WP_ENV) && WP_ENV != 'production' ) {
        return;
    }

    echo <<<EOD

<!-- Start Simplifi Tag -->
<script async src='https://tag.simpli.fi/sifitag/cf95b860-a880-0135-3fd2-067f653fa718'></script>
<!-- End Simplifi tag -->

EOD;
}, 101);

/**
 * Add DoubleClick global site tag to Head.
 * @since 1.2.0
 * @return void
 */
$doubleclick_floodlight_id = '8268350';
add_action('theme/after_wphead', function () use($doubleclick_floodlight_id) {

    if( !empty(WP_ENV) && WP_ENV != 'production' ) {
        return;
    }

    echo <<<EOD

<!-- Start DoubleClick -->
<!--
Start of global snippet: Please do not remove
Place this snippet between the <head> and </head> tags on every page of your site.
-->
<!-- Global site tag (gtag.js) - DoubleClick -->
<script async src="https://www.googletagmanager.com/gtag/js?id=DC-$doubleclick_floodlight_id"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'DC-$doubleclick_floodlight_id');
</script>
<!-- End of global snippet: Please do not remove -->
<!-- End DoubleClick -->

EOD;
}, 90);

/**
 * Add netmining global site tag to Footer.
 * @since 1.2.0
 * @return void
 */
$enable_netmining = true;
add_action('theme/after_wpfooter', function () use($enable_netmining) {

    if( !empty(WP_ENV) && WP_ENV != 'production' ) {
        return;
    }

    if(empty($enable_netmining)) {
        return;
    }

    echo <<<EOD

<!-- Start Netmining -->
<script type='text/javascript'>
(function(){
var Data = {}
,i=Data,d=document,u=encodeURIComponent,x=z='',j=d.createElement('script'),
r=d.referrer,s=d.getElementsByTagName('script')[0];j.type='text/javascript';
j.async=!0;r&&r.split(/[/:?]/)[3]!=d.location.hostname&&(i.ref=r);for(y in i)
x+='&'+y+'='+u(i[y]);j.src='//arity.netmng.com/'
+'?aid=5441&siclientid='+x;s.parentNode.insertBefore(j,s);
})();
</script>
<!-- End Netmining -->

EOD;
}, 91);

/**
 * Add DoubleClick event snippet to right after <body> tag. Only for homepage.
 * @since 1.2.0
 * @return void
 */
add_action('theme/after_body', function () {

    if( !empty(WP_ENV) && WP_ENV != 'production' ) {
        return;
    }

    // Only homepage
    if( !is_front_page() ) {
        return;
    }

    // Unique id for cache busting
    $ord = time();

    echo <<<EOD

<!--
Start of DoubleClick Floodlight Tag: Please do not remove
Activity name of this tag: Homepage Counter_FL
URL of the webpage where the tag is expected to be placed: https://www.arity.com
This tag must be placed between the <body> and </body> tags, as close as possible to the opening tag.
Creation Date: 12/20/2017
-->
<script type="text/javascript">
var axel = Math.random() + "";
var a = axel * 10000000000000;
document.write('<img src="https://ad.doubleclick.net/ddm/activity/src=8268350;type=fl;cat=homep0;dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=' + a + '?" width="1" height="1" alt="" class="sr-only" />');
</script>
<noscript>
<img src="https://ad.doubleclick.net/ddm/activity/src=8268350;type=fl;cat=homep0;dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=$ord?" width="1" height="1" alt="" class="sr-only" />
</noscript>
<!-- End of DoubleClick Floodlight Tag: Please do not remove -->

EOD;
}, 100);

/**
 * Add DoubleClick event snippet to right after <body> tag. Only for CES page.
 * @since 1.2.0
 * @return void
 */
add_action('theme/after_body', function () {

    if( !empty(WP_ENV) && WP_ENV != 'production' ) {
        return;
    }

    // Only homepage
    if( !is_page('ces-2018') && !is_page('ces2018') ) {
        return;
    }

    // Unique id for cache busting
    $ord = time();

    echo <<<EOD

<!--
Start of DoubleClick Floodlight Tag: Please do not remove
Activity name of this tag: CES Homepage Counter
URL of the webpage where the tag is expected to be placed: https://www.arity.com/ces2018/
This tag must be placed between the <body> and </body> tags, as close as possible to the opening tag.
Creation Date: 12/20/2017
-->
<script type="text/javascript">
var axel = Math.random() + "";
var a = axel * 10000000000000;
document.write('<img src="https://ad.doubleclick.net/ddm/activity/src=8268350;type=fl;cat=cesho0;dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=' + a + '?" width="1" height="1" alt="" class="sr-only" />');
</script>
<noscript>
<img src="https://ad.doubleclick.net/ddm/activity/src=8268350;type=fl;cat=cesho0;dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=$ord?" width="1" height="1" alt="" class="sr-only" />
</noscript>
<!-- End of DoubleClick Floodlight Tag: Please do not remove -->

<!-- Start Netmining Conversion -->
<script type='text/javascript'>
(function(){
var Conversion = {};
,i=Conversion,d=document,u=encodeURIComponent,x=z='',j=d.createElement('script'),
r=d.referrer,s=d.getElementsByTagName('script')[0];j.type='text/javascript';
j.async=!0;r&&r.split(/[/:?]/)[3]!=d.location.hostname&&(i.ref=r);for(y in i)
x+='&'+y+'='+u(i[y]);j.src='//arity.netmng.com/conv/'
+'?aid=5441&siclientid=&cpid=306616898'+x;s.parentNode.insertBefore(j,s);
})();
</script>
<!-- End Netmining Conversion -->

EOD;

}, 100);

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
    return home_url('/');
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
add_action('theme/before_wphead', function () {
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
}, 10);

/**
 * Theme After Body
 * @since 1.0.0
 * @return void
 */
add_action('theme/after_body', function () {
    echo <<<EOD
  <div class="sr-only" id="_top"></div>
  <div class="sr-only" id="_skipToMain"><a href="#main" class="jumplink">Skip to the main content</a></div>

EOD;
}, 10);


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
 * Apply filter to ACF link fields
 * @since 1.0.0
 * @return string $value
 */
add_filter('acf/format_value/type=link', function ($link) {

    // Stop html tags from showing
    if(!empty($link['title'])) {
        $link['title'] = str_replace('&lt;', '<', $link['title']);
        $link['title'] = str_replace('&gt;', '>', $link['title']);
    }

    return $link;
}, 10, 3);

add_filter('template_redirect', function() {
    if(is_admin()) {
        return;
    }

    // Determine if should show header lite
    if(!empty(get_field('enable_header_lite')) ) {

        // Define Logo
        if(!empty($logo = get_field('header_lite_brand_logo'))) {
            $logo = home_url() . wp_get_attachment_image_src($logo, 'full')[0];
        }

        // Define Header Lite data
        $GLOBALS['THEME_SITE_HEADER_LITE'] = array(
            'menu' => get_field('header_lite_menu_items'),
            'brand' => array(
                'link' => get_field('header_lite_brand_link'),
                'name' => get_field('header_lite_brand_name'),
                'logo' => $logo
            )
        );
    }

    // Determine if should show footer lite
    if(!empty(get_field('enable_footer_lite')) ) {
        $GLOBALS['THEME_SITE_FOOTER_LITE'] = true;
    }


});

add_filter('theme/before_wpfooter', function() {
    if(is_admin()) {
        return;
    }

    global $post;

    if($post->post_name != 'contact') {
        return;
    }

    $home_url = home_url('/');

    echo <<<EOD
<div id="thankyou_modal" class="modal" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
          <div class="modal-body--left">
            <div class="align-vertical-middle">
              <h2>Thanks!</h2>
            </div>
          </div>
        <div class="modal-body--right">
          <p>Your request has been submitted and someone will get back to you shortly.</p>
          <a href="$home_url" class="ar-element button button--primary blue-button--">
            <span class="button__label">Return to homepage</span>
          </a>
        </div>
      </div>
    </div>
    <button type="button" class="close" data-dismiss="modal">
      <svg class="icon-svg" title="" role="img">
          <use xlink:href="#close"></use>
      </svg>
    </button>
  </div>

</div>
EOD;

});

add_filter('theme/before_wpfooter', function() {
    if(is_admin()) {
        return;
    }

    global $post;

    if(strpos($post->post_name, 'astronaut') === false ) {
        return;
    }

    $url = get_permalink($post->ID);

    echo <<<EOD
<div id="emailform_modal" class="modal" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
          <div class="modal-body--left">
            <div class="align-vertical-middle">
              <h2>Thank You</h2>
            </div>
          </div>
        <div class="modal-body--right">
          <p>You're all set.</p>
          <a href="$url" class="ar-element button button--primary blue-button--">
            <span class="button__label">Ok</span>
          </a>
        </div>
      </div>
    </div>
    <button type="button" class="close" data-dismiss="modal">
      <svg class="icon-svg" title="" role="img">
          <use xlink:href="#close"></use>
      </svg>
    </button>
  </div>

</div>
EOD;

});

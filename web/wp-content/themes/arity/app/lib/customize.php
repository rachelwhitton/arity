<?php

namespace App\Theme;

/**
 * Register navigation menus
 * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
 *
 * @since 1.0.0
 * @return void
 */
function registerMenus()
{
    register_nav_menus([
        'header_primary' => __('Header Primary Navigation', config('textdomain')),
        'footer_copyright' => __('Footer Copyright Navigation', config('textdomain')),
    ]);
}

add_action('widgets_init', function () {
    // register_sidebar([
    //     'name' => __('Primary', config('textdomain')),
    //     'id' => 'sidebar-primary',
    //     'before_widget' => '<section class="widget %1$s %2$s">',
    //     'after_widget' => '</section>',
    //     'before_title' => '<h3>',
    //     'after_title' => '</h3>',
    // ]);
    //
    // register_sidebar([
    //     'name' => __('Footer', config('textdomain')),
    //     'id' => 'sidebar-footer',
    //     'before_widget' => '<section class="widget %1$s %2$s">',
    //     'after_widget' => '</section>',
    //     'before_title' => '<h3>',
    //     'after_title' => '</h3>',
    // ]);
});

/**
 * Add image sizes
 *
 * @since 1.0.0
 * @return void
 */
function addImageSizes()
{
    // add_image_size( 'largest', 1920, 1200 );
    // add_image_size( 'small', 400, 400 );
}

/**
 * Theme setup
 *
 * @since 1.0.0
 * @return void
 */
add_action('after_setup_theme', function () {

    /**
     * Enable features from Wordplate Plate when plugin is activated
     * @link https://github.com/wordplate/plate
     */

    /**
     * Set custom permalink structure.
     */
    add_theme_support('plate-permalink', '/%postname%/');

    /**
     * Remove meta boxes in post editor.
     */
    add_theme_support('plate-editor', [
        'commentsdiv',
        'commentstatusdiv',
        'linkadvanceddiv',
        'linktargetdiv',
        'linkxfndiv',
        'postcustom',
        'postexcerpt',
        'revisionsdiv',
        'slugdiv',
        'sqpt-meta-tags',
        'trackbacksdiv',
        //'categorydiv',
        //'tagsdiv-post_tag',
    ]);

    /**
     * Remove dashboard tabs.
     */
    add_theme_support('plate-tabs', [
        'help',
        'screen-options'
    ]);

    /**
     * Remove links from admin toolbar.
     */
    add_theme_support('plate-toolbar', [
        'comments',
        'wp-logo',
        // 'edit',
        // 'appearance',
        // 'view',
        'new-content',
        'updates',
        'search',
        'wpseo-menu'
    ]);

    /**
     * Remove links from admin menu-items.
     */
    add_theme_support('plate-menu', [
        // 'edit-comments.php', // comments
        // 'index.php', // dashboard
        // 'link-manager.php', // links
        // 'upload.php', // media
    ]);

    /**
     * Remove dashboard widgets.
     */
    add_theme_support('plate-dashboard', [
        'dashboard_activity',
        'dashboard_incoming_links',
        'dashboard_plugins',
        'dashboard_recent_comments',
        'dashboard_primary',
        'dashboard_quick_press',
        'dashboard_recent_drafts',
        'dashboard_secondary',
        //'dashboard_right_now',
    ]);

    /**
     * Add custom footer message
     */
    $details = 'Using '.config('title').' v'.config('version').' ('.WP_ENV.').';
    add_theme_support('plate-footer', 'Thank you for creating with VSA Partners. '.$details);

    /**
     * Enable features from Soil when plugin is activated
     * @link https://roots.io/plugins/soil/
     */
    add_theme_support('soil-clean-up');
    // add_theme_support('soil-nav-walker');
    add_theme_support('soil-nice-search');
    add_theme_support('soil-relative-urls');
    add_theme_support('soil-disable-trackbacks');

    // Register Menus
    registerMenus();

    // Add Image Sizes
    addImageSizes();
});

add_action('wp_head', function() {
  ?>
  <script type="text/javascript">
    window.lazySizesConfig = window.lazySizesConfig || {};
    window.lazySizesConfig.init = false;
  </script>
  <?php
});

add_action('wp_footer', function() {
  ?>
  <script type="text/javascript">
    if (typeof window.lazySizes !== 'undefined') {
      var images = document.querySelectorAll('img');

      images.forEach(function(img) {
        var src = img.getAttribute('src');
        var srcset = img.getAttribute('srcset');
        var sizes = img.getAttribute('sizes');

        img.classList.add('lazyload');

        img.removeAttribute('src');
        img.removeAttribute('srcset');
        img.removeAttribute('sizes');

        img.setAttribute('data-src', src);
        if (srcset) {
          img.setAttribute('data-srcset', srcset);
        }
        if (sizes) {
          img.setAttribute('data-sizes', sizes || 'auto');
        }
      });
      lazySizes.init();
    }

  </script>
  <?php
});

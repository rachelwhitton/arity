<?php

declare(strict_types=1);

/*
 |------------------------------------------------------------------
 | Bootstraping a Theme
 |------------------------------------------------------------------
 |
 | This file is responsible for bootstrapping your theme. Autoloads
 | composer packages, checks compatibility and loads theme files.
 | Most likely, you don't need to change anything in this file.
 | Your theme custom logic should be distributed across a
 | separated components in the `/app` directory.
 |
 */


/**
 * Require Composer
 * @since 1.0.0
 * @return void
 *
 * Require Composer's autoloading file
 * if it's present in theme directory.
 */
if (file_exists($composer = __DIR__ . '/vendor/autoload.php')) {
    require_once $composer;
}

/**
 * Autoload plugins
 * @since 1.0.0
 * @return void
 *
 * Autoloads plugins/plugins in <theme>/app/plugin/
 * Similar to how Wordpress autoloads plugins
 */
$plugins = require_once __DIR__ . '/app/bootstrap/plugins.php';
foreach ($plugins as $filename) {
    require_once $filename;
}

// Before running we need to check if everything is in place.
// If something went wrong, we will display friendly alert.
$ok = require_once __DIR__ . '/app/bootstrap/compatibility.php';

/**
 * Bootstrap Theme
 * @since 1.0.0
 * @return void
 *
 * Bootstraps Theme and autoloads required files in <theme>/app/config/app.php
 */
if ($ok) {
    // Now, we can bootstrap our theme.
    $theme = require_once __DIR__ . '/app/bootstrap/theme.php';

    // Autoload theme. Uses localize_template() and
    // supports child theme overriding. However,
    // they must be under the same dir path.
    (new \Arity\Autoloader($theme->get('config')))->register();
}

function my_datavis_save_post($post_id){
    // bail early if no ACF data
    if (empty($_POST['acf'])) {
        return;
    }
    $arr = $_POST['acf']['field_modules_modules'];
    $mainArr = $_POST['acf']['field_modules_modules'];
    //echo 'Before <pre>'; print_r($mainArr);
    foreach ($arr as $key => $value) {
        $attachment_id = $arr[$key]['field_module_content-image-block_field_module_content-image-block_visualization'];
        //echo '<pre>'; print_r(get_attached_file($attachment_id)); echo '</pre>';
        echo get_attached_file($attachment_id);
        $path = get_attached_file($attachment_id);
        echo $fileWithExt = basename($path);
        $file = basename($path, ".zip");

        phpinfo();

// Read this for more info 
// https://pantheon.io/docs/private-paths/

        WP_Filesystem();
        echo $destination = wp_upload_dir();
        echo $destination_path = $destination['path'];
        echo $new_destination_path = str_replace('code/web/wp-content/uploads','files',$destination_path);
        $unzipfile = unzip_file($new_destination_path.'/'.$fileWithExt, $new_destination_path.'/'.$file);
        
        echo '<br/><pre>';
        print_r($destination);
        echo '</pre><br/>';
        echo $new_destination_path.'/'.$fileWithExt;
        echo '<br/>';
        echo $new_destination_path.'/'.$file;

        var_dump($unzipfile);

        if (is_wp_error($unzipfile)) {
            echo 'There was an error unzipping the file.';
        } else {
            echo 'Successfully unzipped the file!';
        }

        exit;
    }
}
add_action('acf/save_post', 'my_datavis_save_post', 1);
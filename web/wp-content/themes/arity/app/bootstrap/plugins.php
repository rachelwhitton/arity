<?php

/**
 * Returns array with plugin paths
 */
$plugins = array();
$plugins_path = __DIR__ . '/../plugins';
$plugins_dir = opendir($plugins_path);
while (( $dir = readdir($plugins_dir) ) !== false) {
    if (substr($dir, 0, 1) == '.') {
        continue;
    }

    if( substr($dir, -4) == '.php' ) {
        $plugins[] = $plugins_path. '/'.$dir;
    } else if(is_dir($plugins_path. '/'.$dir)) {
        $plugin = $plugins_path. '/'.$dir.'/'.$dir.'.php';
        if (file_exists($plugin)) {
            $plugins[] = $plugin;
        }
    }
}
closedir($plugins_dir);
return $plugins;

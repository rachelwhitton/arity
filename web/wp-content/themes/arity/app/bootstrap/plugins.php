<?php

/**
 * Returns array with plugin paths
 */
$plugins = array();
$plugins_path = __DIR__ . '/../plugins';
$plugins_dir = opendir($plugins_path);
while (( $dir = readdir($plugins_dir) ) !== false) {
    if (substr($dir, 0, 1) == '.' || !is_dir($plugins_path. '/'.$dir)) {
        continue;
    }

    $plugins[] = $plugins_path. '/'.$dir.'/'.$dir.'.php';
}
closedir($plugins_dir);

return $plugins;

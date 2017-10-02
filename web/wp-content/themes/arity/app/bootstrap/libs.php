<?php

/**
 * Returns array with lib paths
 */
$libs = array();
$libs_path = __DIR__ . '/../lib';
$libs_dir = opendir($libs_path);
while (( $dir = readdir($libs_dir) ) !== false) {
    if (substr($dir, 0, 1) == '.' || !is_dir($libs_path. '/'.$dir)) {
        continue;
    }

    $libs[] = $libs_path. '/'.$dir.'/'.$dir.'.php';
}
closedir($libs_dir);

return $libs;

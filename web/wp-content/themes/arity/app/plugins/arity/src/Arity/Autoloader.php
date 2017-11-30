<?php

namespace Arity;

use Arity\Exception\FileNotFoundException;
use Arity\Theme;
use Arity\Notices;

class Autoloader
{
    /**
     * Theme config instance.
     *
     * @var array
     */
    protected $config;

    /**
     * Autoloader autoloads each php file in these directories.
     *
     * @var array
     */
    protected $loadMore = [
        "customize",
        "shortcodes",
        "widgets",
        "theme-settings",
        "post-types"
    ];

    /**
     * Construct autoloader.
     *
     * @param \Arity\Theme $theme
     */
    public function __construct($config)
    {
        $this->config = $config;
    }

    /**
     * Autoload registered files.
     *
     * @throws \Arity\Exception\FileNotFoundException
     *
     * @return void
     */
    public function register()
    {
        do_action('autoloader/before_load');

        $this->load();
        $this->loadMore();

        do_action('autoloader/after_load');
    }

    /**
     * Localize and autoloads files.
     *
     * @return void
     */
    public function load()
    {
        foreach ($this->config['autoload'] as $file) {
            $file = 'lib/'.$file;
            if (! locate_template($this->getRelativePath($file), true, true)) {
                Notices::error("Autoloaded file [{$this->getPath($file)}] cannot be found. Please, check your autoloaded entries in `app/config/app.php` file.");
            }
        }
    }

    /**
     * Autoload more Wordpress stuff
     *
     * @return void
     */
    public function loadMore()
    {
        foreach ($this->loadMore as $dir) {
            $more_path = $this->getPath($dir, false);
            if(!file_exists($more_path)) {
                continue;
            }

            $more_files = array();
            $more_dir = opendir($more_path);

            // Glob
            while (( $filename = readdir($more_dir) ) !== false) {
                if (substr($filename, 0, 1) == '.' || substr($filename, -4) != '.php') {
                    continue;
                }

                $more_files[] = $more_path . DIRECTORY_SEPARATOR . $filename;
            }
            closedir($more_dir);

            // Require Each
            foreach ($more_files as $filename) {
                require_once $filename;
            }
        }
    }

    /**
     * Gets absolute file path.
     *
     * @param  string $file
     *
     * @return string
     */
    public function getPath($file, $ext='.php')
    {
        $file = $this->getRelativePath($file, $ext);

        return $this->config['paths']['directory'] . DIRECTORY_SEPARATOR . $file;
    }

    /**
     * Gets file path within `theme` directory.
     *
     * @param  string $file
     *
     * @return string
     */
    public function getRelativePath($file, $ext='.php')
    {
        return $this->config['directories']['app'] . DIRECTORY_SEPARATOR . $file . $ext;
    }
}

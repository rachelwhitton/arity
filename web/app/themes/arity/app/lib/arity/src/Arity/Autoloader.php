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
            if (! locate_template($this->getRelativePath($file), true, true)) {
                Notices::error("Autoloaded file [{$this->getPath($file)}] cannot be found. Please, check your autoloaded entries in `app/config/app.php` file.");
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
    public function getPath($file)
    {
        $file = $this->getRelativePath($file);

        return $this->config['paths']['directory'] . DIRECTORY_SEPARATOR . $file;
    }

    /**
     * Gets file path within `theme` directory.
     *
     * @param  string $file
     *
     * @return string
     */
    public function getRelativePath($file)
    {
        return $this->config['directories']['app'] . DIRECTORY_SEPARATOR . $file . '.php';
    }
}

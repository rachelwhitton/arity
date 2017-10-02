<?php

namespace Arity;

use Arity\Config;
use Arity\Exception\FileNotFoundException;
use Arity\Theme;

class Template
{
    /**
     * Theme config instance.
     *
     * @var array
     */
    protected $config;

    /**
     * File path to the template.
     *
     * @var string
     */
    protected $file;

    /**
     * Template partial type.
     *
     * @var string
     */
    protected $partialType;

    /**
     * Template partial name.
     *
     * @var string
     */
    protected $partialName;

    /**
     * Template partial.
     *
     * @var string
     */
    protected $partial;

    /**
     * Template data.
     *
     * @var array
     */
    protected $data;

    /**
     * Construct template.
     *
     * @param \Arity\Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * Render template.
     *
     * @param  array $context
     * @throws \Arity\Exception\FileNotFoundException
     *
     * @return void
     */
    public function render(array $context = [])
    {
        // If data is set, set context to data
        if(isset($this->data)) {
            $context = $this->data;
        }

        // If context turned false, then don't render
        if($context === false) {
            return;
        }

        if (locate_template($path = $this->getRelativePath(), false, false)) {
            $this->setContext([
                'data' => $context
            ]);
            $this->doActions();

            return locate_template($path, true, false);
        }

        throw new FileNotFoundException("Template file [{$this->getRelativePath()}] cannot be located.");
    }

    /**
     * Gets the content for the template.
     *
     * @param  array $context
     * @throws \Arity\Exception\FileNotFoundException
     *
     * @return string
     */
    public function getContent(array $context = [])
    {
        // If data is set, set context to data
        if(isset($this->data)) {
            $context = $this->data;
        }

        // If context turned false, then don't render
        if($context === false) {
            return "";
        }

        if (locate_template($path = $this->getRelativePath(), false, false)) {
            $this->setContext([
                'data' => $context
            ]);
            $this->doActions();

            return $this->load($path);
        }

        throw new FileNotFoundException("Template file [{$this->getRelativePath()}] cannot be located.");
    }

    /**
     * Load a template
     *
     * @param  string $path
     *
     * @return string $contents
     */
    public function load($path) {
        ob_start();
        locate_template($path, true, false);
        $contents = ob_get_contents();
        ob_end_clean();
        return $contents;
    }

    /**
     * Sets context dataset on query.
     *
     * @param array $context
     *
     * @return void
     */
    public function setContext(array $context)
    {
        $context = apply_filters("template/context/{$this->getFilename()}", $context);

        foreach ($context as $key => $value) {
            set_query_var($key, $value);
        }
    }

    /**
     * Calls before including template actions.
     *
     * @return void
     */
    public function doActions()
    {
        if ($this->isNamed()) {
            list($slug, $name) = $this->file;

            do_action("get_template_part_{$slug}", $slug, $name);

            return;
        }

        // Use first template name, if template
        // file is an array, but is not named.
        if (is_array($this->file) && isset($this->file[0])) {
            return do_action("get_template_part_{$this->file[0]}", $this->file[0], null);
        }

        do_action("get_template_part_{$this->file}", $this->file, null);
    }

    /**
     * Gets absolute path to the template.
     *
     * @return string
     */
    public function getPath()
    {
        $directory = $this->config['paths']['directory'];

        return $directory . DIRECTORY_SEPARATOR . $this->getRelativePath();
    }

    /**
     * Gets template path within `resources/templates` directory.
     *
     * @return string
     */
    public function getRelativePath()
    {
        if($this->isPartial()) {
            $templates = $this->config['directories']['templates-partials'];
        } else {
            $templates = $this->config['directories']['templates'];
        }

        $extension = $this->config['templates']['extension'];

        return $templates . DIRECTORY_SEPARATOR . $this->getFilename($extension);
    }

    /**
     * Gets template name.
     *
     * @return string
     */
    public function getFilename($extension = '.php')
    {
        // If template is named,
        // return joined template names.
        if ($this->isNamed()) {
            return join('-', $this->file) . $extension;
        }

        // Use first template name, if template
        // file is an array, but is not named.
        if (is_array($this->file) && isset($this->file[0])) {
            return "{$this->file[0]}{$extension}";
        }

        return apply_filters('template/filename', "{$this->file}{$extension}");
    }

    /**
     * Checks if temlate has variant name.
     *
     * @return boolean
     */
    public function isNamed()
    {
        // If file is not array, then template
        // is not named for sure.
        if (! is_array($this->file)) {
            return false;
        }

        // Return false if template is named,
        // but name is bool or null.
        if (isset($this->file[1]) && is_bool($this->file[1]) || is_null($this->file[1])) {
            return false;
        }

        return true;
    }

    /**
     * Sets the file path to the template.
     *
     * @param string $file
     *
     * @return self
     */
    public function setFile($file)
    {
        if(!empty($this->partialType)) {
            $this->setPartialName($file);
            $this->file = $this->partialType . DIRECTORY_SEPARATOR . $file . DIRECTORY_SEPARATOR . $file;
        } else {
            $this->file = $file;
        }

        return $this;
    }

    /**
     * Gets the File path to the template.
     *
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Sets the partial for the template.
     *
     * @param array $partial
     *
     * @return self
     */
    public function setPartial($partial)
    {
        $this->partial = $partial;
        $this->setPartialType($partial->type);
        $this->setPartialName($partial->name);
        $this->setFile($partial->name);
        $this->setData($partial->data);

        return $this;
    }

    /**
     * Gets the partial for the template.
     *
     * @return array
     */
    public function getPartial()
    {
        return $this->partial;
    }

    /**
     * Sets the partial type for the template.
     *
     * @param string $type
     *
     * @return self
     */
    public function setPartialType($type)
    {
        $this->partialType = $type;

        return $this;
    }

    /**
     * Gets the partial type for the template.
     *
     * @return string
     */
    public function getPartialType()
    {
        return $this->partialType;
    }

    /**
     * Sets the partial name for the template.
     *
     * @param string $name
     *
     * @return self
     */
    public function setPartialName($name)
    {
        $this->partialName = $name;

        return $this;
    }

    /**
     * Gets the partial name for the template.
     *
     * @return string
     */
    public function getPartialName()
    {
        return $this->partialName;
    }

    /**
     * Determines if template is a partial.
     *
     * @return boolean
     */
    public function isPartial() {
        if(!empty($this->partialType) || !empty($this->partial)) {
            return true;
        }

        return false;
    }

    /**
     * Helper function to clean up data.
     *
     * @param array|string $data
     *
     * @return array $data
     */
    public function cleanUpData($data)
    {
        // Make sure its an array if null or false
        if(empty($data)) {
            $data = array();
        }

        // If classes are set and a string is passed, turn them into an array
        if(!empty($data['classes']) && is_string($data['classes'])) {
            $data['classes'] = explode(' ', $data['classes']);
        }

        // Strip parts from the array keys
        if(!empty($data) && $this->isPartial()) {
            $cleaned = array();
            foreach($data as $key=>$value) {
                $key = $this->stripPartialType($key);
                $key = $this->stripPartialName($key);
                $cleaned[$key] = $value;
            }
            $data = $cleaned;
        }

        // Check for data file, if exists use as data mixin.
        $extension = $this->config['templates']['extension'];
        $data_file = str_replace($this->getFilename($extension), $this->getFilename('.data.php'), $this->getPath());
        if(file_exists($data_file)) {
            $data = (require $data_file);
        }

        // If classes are set and a string is passed, turn them into an array
        // if(!empty($data['classes']) && is_array($data['classes'])) {
        //     $data['classes'] = join(' ', $data['classes']);
        // }

        return $data;
    }

    public function stripPartialName($str)
    {
        $name = $this->getPartialName();
        if(strpos($str, $name) === 0) {
            return str_replace($name . '__', '', $str);
        }
        return $str;
    }

    public function stripPartialType($str)
    {
        $type = $this->getPartialType();
        if(strpos($str, $type) === 0) {
            return str_replace($type . '__', '', $str);
        }
        return $str;
    }

    /**
     * Sets the data for the template.
     *
     * @param array|string $data
     *
     * @return self
     */
    public function setData($data)
    {
        $this->data = $this->cleanUpData($data);

        return $this;
    }

    /**
     * Gets the data for the template.
     *
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }
}

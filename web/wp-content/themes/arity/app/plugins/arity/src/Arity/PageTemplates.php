<?php

// @link - http://www.wpexplorer.com/wordpress-page-templates-plugin/

namespace Arity;

use Arity\Config;
use Arity\Exception\FileNotFoundException;

class PageTemplates
{

    /**
     * Theme config instance.
     *
     * @var array
     */
    protected $config;

    /**
     * Page templates.
     *
     * @var array
     */
    protected $templates;

    /**
     * Templates Path.
     *
     * @var string
     */
    protected $templatesPath;

    /**
     * Construct pageTemplates.
     *
     * @param \Arity\Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;

        // Define templates
        $this->templates = !empty($this->config['pageTemplates']) ? $this->config['pageTemplates'] : array();

        // Define templates location
        $this->templatesPath = !empty($this->config['directories']['templates-page']) ? $this->config['directories']['templates-page'] : null;
        if (empty($this->templatesPath)) {
            $this->templatesPath = !empty($this->config['directories']['templates']) ? $this->config['directories']['templates'] : 'page-templates';
        }

        // Define templates extension
        if (!empty($this->config['templates']['extension'])) {
            $this->templatesExt = $this->config['templates']['extension'];
        } else {
            $this->templatesExt = '.php';
        }

        // Define templates default file path
        if (!empty($this->config['pageTemplatesDefaultTemplate'])) {
            $this->defaultTemplatePath = $this->config['pageTemplatesDefaultTemplate'];
        } else {
            $this->defaultTemplatePath = $this->config['paths']['directory'] . '/' . $this->templatesPath . '/t0-default';
        }

        // If custom template file string does not contain an extension then add one.
        if (substr($this->defaultTemplatePath, -4) != '.php') {
            $this->defaultTemplatePath .= $this->templatesExt;
        }

        // Add a filter to the attributes metabox to inject template into the cache.
        add_filter(
            'theme_page_templates',
            array( $this, 'addNewTemplate' )
        );

        // Add a filter to the save post to inject out template into the page cache
        add_filter(
            'wp_insert_post_data',
            array( $this, 'registerProjectTemplates' )
        );


        // Add a filter to the template include to determine if the page has our
        // template assigned and return it's path
        add_filter(
            'template_include',
            array( $this, 'viewProjectTemplate')
        );

        return $this->templates;
    }

    /**
     * Adds our template to the page dropdown for v4.7+
     *
     */
    public function addNewTemplate($posts_templates)
    {
        $posts_templates = array_merge($posts_templates, $this->templates);
        return $posts_templates;
    }

    /**
     * Adds our template to the pages cache in order to trick WordPress
     * into thinking the template file exists where it doens't really exist.
     */
    public function registerProjectTemplates($atts)
    {

        // Create the key used for the themes cache
        $cache_key = 'page_templates-' . md5(get_theme_root() . '/' . get_stylesheet());

        // Retrieve the cache list.
        // If it doesn't exist, or it's empty prepare an array
        $templates = wp_get_theme()->get_page_templates();
        if (empty($templates)) {
            $templates = array();
        }

        // New cache, therefore remove the old one
        wp_cache_delete($cache_key, 'themes');

        // Now add our template to the list of templates by merging our templates
        // with the existing templates array from the cache.
        $templates = array_merge($templates, $this->templates);

        // Add the modified cache to allow WordPress to pick it up for listing
        // available templates
        wp_cache_add($cache_key, $templates, 'themes', 1800);

        return $atts;
    }

    /**
     * Checks if the template is assigned to the page
     */
    public function viewProjectTemplate($template)
    {

        // Get global post
        global $post;

        // Return template if post is empty
        if (! $post) {
            return $template;
        }

        // Return default template if we don't have a custom one defined
        if (! isset($this->templates[get_post_meta(
            $post->ID,
            '_wp_page_template',
            true
        )]) ) {
            return $template;
        }

        // Define file location
        $file = $this->config['paths']['directory'] . '/' . $this->templatesPath . '/';
        $file .= get_post_meta(
            $post->ID,
            '_wp_page_template',
            true
        );

        // If custom template file string does not contain an extension then add one.
        if (substr($file, -4) != '.php') {
            $file .= $this->templatesExt;
        }

        // Check if custom template file exists, if not just provide the default
        if (!file_exists($file)) {
            return $this->defaultTemplatePath;
        }

        return $file;
    }
}

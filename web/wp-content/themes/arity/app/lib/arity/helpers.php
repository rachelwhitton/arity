<?php

declare(strict_types=1);

namespace App\Theme;

use Arity\Asset;
use Arity\Theme;
use Arity\Template;

// Exit if accessed directly
if (! defined('ABSPATH')) {
    exit;
}

/**
 * Gets theme instance.
 *
 * @param string|null $key
 * @param array $parameters
 *
 * @return \Arity\Theme
 */
function theme($key = null, $parameters = [])
{
    if (null !== $key) {
        return Theme::getInstance()->get($key, $parameters);
    }

    return Theme::getInstance();
}

/**
 * Gets theme config instance.
 *
 * @param string|null $key
 *
 * @return array
 */
function config($key = null)
{
    if (null !== $key) {
        return theme('config')->get($key);
    }

    return theme('config');
}

/**
 * Renders template file with data.
 *
 * @param  string $file Relative path to the template file or partialName.
 * @param  string|array  $type If an array, represents dataset for the template. If a string, represents partial type.
 * @param  array  $data Dataset for the template.
 *
 * @return void
 */
function template($file, $partialType = [], $data = [])
{
    if(!is_string($partialType)) {
        $data = $partialType;
        $partialType = null;
    }

    $template = new Template(config());

    if(is_string($partialType)) {
      $template->setPartialType($partialType);
    }

    return $template
        ->setFile($file)
        ->setData($data)
        ->render();
}

/**
 * Renders component with data.
 *
 * @param  string $name Name of partial component.
 * @param  array  $data Dataset for the template.
 *
 * @return void
 */
function component($name, $data = [])
{
    return template($name, 'component', $data);
}

/**
 * Renders element with data.
 *
 * @param  string $name Name of partial element.
 * @param  array  $data Dataset for the template.
 *
 * @return void
 */
function element($name, $data = [])
{
    return template($name, 'element', $data);
}

/**
 * Renders module with data.
 *
 * @param  string $name Name of partial module.
 * @param  array  $data Dataset for the template.
 *
 * @return void
 */
function module($name, $data = [])
{
    return template($name, 'module', $data);
}

/**
 * Uses module builder to render acf fields
 *
 * @return void
 */
function the_acf_content() {
    global $module_builder;

    if( function_exists('get_field') && (get_field('modules') || get_field('content')) ) {
        $module_builder->render();
    } else {
        the_content();
    }
}

/**
 * Renders partials from an array of acf data
 *
 * @return void
 */
function the_partials($arr) {
    foreach($arr as $data) {
        the_partial($data);
    }
}

/**
 * Renders partial from acf data
 *
 * @return void
 */
function the_partial($data) {
    if($partial = get_partial($data)) {
        $partial->render();
    }
}

/**
 * Returns partials from an array of acf data
 *
 * @param array $arr Array of acf data.
 *
 * @return array $partials
 */
function get_partials($arr) {
    $partials = array();
    foreach($arr as $data) {
        if($partial = get_partial($data)) {
            $partials[] = $partial;
        }
    }

    return $partials;
}

/**
 * Returns partials from an array of acf data
 *
 * @param array $data Acf data.
 *
 * @return array $partials
 */
function get_partial($data) {
    global $module_builder;

    return $module_builder->getPartial($data);
}

/**
 * Gets asset instance.
 *
 * @param  string $file Relative file path to the asset file.
 *
 * @return \Arity\Asset
 */
function asset($file)
{
    $asset = new Asset(config());

    return $asset->setFile($file);
}

/**
 * Gets asset file from public directory.
 *
 * @param  string $file Relative file path to the asset file.
 *
 * @return string
 */
function asset_path($file)
{
    return asset($file)->getUri();
}

/**
 * Display the classes for the module elements.
 *
 * @param string|array $class One or more classes to add to the class list.
 */
function module_class($class = '')
{
    // Separates classes with a single space, collates classes for body element
    echo 'class="' . join(' ', get_module_class($class)) . '"';
}

/**
 * Retrieve the classes for the module elements as an array.
 *
 * @param string|array $class One or more classes to add to the class list.
 * @return array Array of classes.
 */
function get_module_class($class = '')
{

    $classes = array();

    if (! empty($class)) {
        if (!is_array($class)) {
            $class = preg_split('#\s+#', $class);
        }
        $classes = array_merge($classes, $class);
    } else {
        // Ensure that we always coerce class to being an array.
        $class = array();
    }

    $classes = array_map('esc_attr', $classes);

    /**
     * Filters the list of CSS module classes for the current post or page.
     *
     * @param array $classes An array of body classes.
     * @param array $class   An array of additional classes added to the body.
     */
    $classes = apply_filters('module_class', $classes, $class);

    // Merge all partial classes
    $classes = array_merge($classes, get_partial_class());

    return array_unique($classes);
}

/**
 * Display the classes for the component elements.
 *
 * @param string|array $class One or more classes to add to the class list.
 */
function component_class($class = '')
{
    // Separates classes with a single space, collates classes for body element
    echo 'class="' . join(' ', get_component_class($class)) . '"';
}

/**
 * Retrieve the classes for the component elements as an array.
 *
 * @param string|array $class One or more classes to add to the class list.
 * @return array Array of classes.
 */
function get_component_class($class = '')
{

    $classes = array();

    if (! empty($class)) {
        if (!is_array($class)) {
            $class = preg_split('#\s+#', $class);
        }
        $classes = array_merge($classes, $class);
    } else {
        // Ensure that we always coerce class to being an array.
        $class = array();
    }

    $classes = array_map('esc_attr', $classes);

    /**
     * Filters the list of CSS component classes for the current post or page.
     *
     * @param array $classes An array of body classes.
     * @param array $class   An array of additional classes added to the body.
     */
    $classes = apply_filters('component_class', $classes, $class);

    // Merge all partial classes
    $classes = array_merge($classes, get_partial_class());

    return array_unique($classes);
}

/**
 * Display the classes for the element elements.
 *
 * @param string|array $class One or more classes to add to the class list.
 */
function element_class($class = '')
{
    // Separates classes with a single space, collates classes for body element
    echo 'class="' . join(' ', get_element_class($class)) . '"';
}

/**
 * Retrieve the classes for the element elements as an array.
 *
 * @param string|array $class One or more classes to add to the class list.
 * @return array Array of classes.
 */
function get_element_class($class = '')
{

    $classes = array();

    if (! empty($class)) {
        if (!is_array($class)) {
            $class = preg_split('#\s+#', $class);
        }
        $classes = array_merge($classes, $class);
    } else {
        // Ensure that we always coerce class to being an array.
        $class = array();
    }

    $classes = array_map('esc_attr', $classes);

    /**
     * Filters the list of CSS element classes for the current post or page.
     *
     * @param array $classes An array of body classes.
     * @param array $class   An array of additional classes added to the body.
     */
    $classes = apply_filters('element_class', $classes, $class);

    // Merge all partial classes
    $classes = array_merge($classes, get_partial_class());

    return array_unique($classes);
}

/**
 * Retrieve the classes for the partial elements as an array.
 *
 * @param string|array $class One or more classes to add to the class list.
 * @return array Array of classes.
 */
function get_partial_class($class = '')
{

    $classes = array();

    if (! empty($class)) {
        if (!is_array($class)) {
            $class = preg_split('#\s+#', $class);
        }
        $classes = array_merge($classes, $class);
    } else {
        // Ensure that we always coerce class to being an array.
        $class = array();
    }

    $classes = array_map('esc_attr', $classes);

    /**
     * Filters the list of CSS element classes for the current post or page.
     *
     * @param array $classes An array of body classes.
     * @param array $class   An array of additional classes added to the body.
     */
    $classes = apply_filters('partial_class', $classes, $class);

    return array_unique($classes);
}

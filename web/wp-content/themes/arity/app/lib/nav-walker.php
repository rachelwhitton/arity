<?php

declare(strict_types=1);

namespace App\Theme;

class NavWalker extends \Walker_Nav_Menu
{

    private $cpt; // Boolean, is current post a custom post type
    private $archive; // Stores the archive page for current URL

    public function __construct()
    {
        $cpt           = get_post_type();
        $this->cpt     = in_array($cpt, get_post_types(array('_builtin' => false)));
        $this->archive = get_post_type_archive_link($cpt);
    }

    /**
    * Traverse elements to create list from elements.
    *
    * Display one element if the element doesn't have any children otherwise,
    * display the element and its children. Will only traverse up to the max
    * depth and no ignore elements under that depth.
    *
    * This method shouldn't be called directly, use the walk() method instead.
    *
    * @see NavWalker::display_element()
    * @since 1.1.0
    *
    * @param object $element Data object
    * @param array $children_elements List of elements to continue traversing.
    * @param int $max_depth Max depth to traverse.
    * @param int $depth Depth of current element. Default 0.
    * @param array $args
    * @param string $output Passed by reference. Used to append additional content.
    * @return null Null on failure with no changes to parameters.
    */
    // @codingStandardsIgnoreStart
    public function display_element($element, &$children_elements, $max_depth, $depth = 0, $args = array(), &$output) {
        if ( ! $element ) { return; }

        $element->has_children = ((!empty($children_elements[$element->ID]) && (($depth + 1) < $max_depth || ($max_depth === 0))));
        if($element->has_children) {
            $element->current_item_parent = $children_elements[$element->ID];
        }

        parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }
    // @codingStandardsIgnoreEnd

    /**
	 * Starts the list before the elements are added.
	 *
	 * @since 1.1.0
	 *
	 * @see Walker::start_lvl()
	 *
	 * @param string   $output Used to append additional content (passed by reference).
	 * @param int      $depth  Depth of menu item. Used for padding.
	 * @param stdClass $args   An object of wp_nav_menu() arguments.
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {

		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		$indent = str_repeat( $t, $depth );

		// Default class.
		$classes = array( 'sub-menu' );
		$class_names = join( ' ', apply_filters( 'nav_menu_submenu_css_class', $classes, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

        $current_item_parent = '';
        if(!empty($args->current_item_parent)) {
            $current_item_parent = $args->current_item_parent;
        }

		$output .= "{$n}{$indent}<ul$class_names role=\"menu\" aria-label=\"{$current_item_parent}\" tabindex=\"-1\" aria-hidden=\"true\">{$n}";
	}
}

/**
 * Use this nav walker as default for all WP menus.
 *
 * Clean up wp_nav_menu_args
 * - Remove the container
 * - Remove the id="" on nav menu items
 * - Add aria role
 *
 * @since 1.1.0
 *
 * @param object $args
 * @return object $args
 */
add_filter('wp_nav_menu_args', function ($args = array()) {
    $nav_menu_args = [];

    // Get rid of container div
    $nav_menu_args['container'] = false;

    // Define menu role
    $menu_role = '';
    $args['menu_role'] = isset($args['menu_role']) ? $args['menu_role'] : 'menubar';
    if(!empty($args['menu_role'])) {
        $menu_role = ' role="'.$args['menu_role'].'"';
    }

    // If menu_id is not defined or is false, then don't use it
    if (empty($args['menu_id'])) {
        $nav_menu_args['items_wrap'] = '<ul class="%2$s"'.$menu_role.'>%3$s</ul>';
    }

    // Force this nav walker
    if (empty($args['walker'])) {
        $nav_menu_args['is_walker'] = true;
        $nav_menu_args['walker'] = new NavWalker();
    }

    return array_merge($args, $nav_menu_args);
}, 10, 1);

/**
 * Nav Menu Objects
 * @since 1.1.0
 * @param array $items
 * @param object $args
 * @return array $items
 *
 * Returns array of Nav Menu Objects
 */
add_filter('wp_nav_menu_objects', function ($items, $args = array()) {

    // Don't mess with other walkers
    if(empty($args->is_walker)) {
        return $items;
    }

    // Define first and last
    $items[1]->is_first = true;
    $items[count($items)]->is_last = true;

    return $items;
}, 10, 2);

/**
 * Nav Menu Objects
 * @since 1.1.0
 * @param array $classes
 * @param object $item
 * @param object $args
 * @return array $classes
 *
 * Returns array of Nav Menu Objects
 */
add_filter('nav_menu_css_class', function ($classes, $item, $args = array()) {

    // Don't mess with other walkers
    if(empty($args->is_walker)) {
        return $classes;
    }

    global $post;

    $is_active = in_array('current-menu-item', $item->classes);
    $is_parent = in_array('current-menu-parent', $item->classes);
    $is_ancestor = in_array('current-menu-ancestor', $item->classes);
    $has_children = in_array('menu-item-has-children', $item->classes);

    // Set the blog to be active for wp 'posts'
    if($item->post_name == 'move' && isset( $post ) && $post->post_type == 'post') {
        $is_active = true;
    }

    // Reset classes
    $classes = array();

    $classes[] = 'menu-item';

    // Add `menu-<ID>` class
    $classes[] = 'menu-item-' . $item->ID;

    // Add `menu-<slug>` class
    $slug = sanitize_title($item->title);
    $classes[] = 'menu-' . $slug;

    if($is_active) {
        $classes[] = 'menu-item-is-current';
    }

    if($is_parent) {
        $classes[] = 'menu-item-is-parent';
    }

    if($is_ancestor) {
        $classes[] = 'menu-item-is-ancestor';
    }

    if($has_children) {
        $classes[] = 'menu-item-has-children';
    }

    // Trim whitespace
    $classes = array_map('trim', $classes);

    return array_filter($classes);
}, 10, 3);

/**
 * Removes Nav Menu Item Id
 * @since 1.1.0
 * @param string id
 * @param object $item
 * @param object $args
 * @return null
 */
add_filter('nav_menu_item_id', function ($id, $item, $args = array()) {

    // Don't mess with other walkers
    if(empty($args->is_walker)) {
        return $id;
    }

    // Return null cuz menu item id is dumb.
    return null;
}, 10, 3);

/**
 * Nav Menu Item Title
 * @since 1.1.0
 * @param string $title
 * @param object $item
 * @param object $args
 * @return string $title
 *
 * Returns <a> display text
 */
add_filter('nav_menu_item_title', function ($title, $item, $args = array()) {

    // Don't mess with other walkers
    if(empty($args->is_walker)) {
        return $title;
    }

    return $title;
}, 10, 3);

/**
 * navMenuLinkAttributes
 * @since 1.0.0
 * @param $atts
 * @param object $item
 * @param object $args
 * @return $atts
 */
add_filter('nav_menu_link_attributes', function ($atts, $item, $args = array()) {

    // Don't mess with other walkers
    if(empty($args->is_walker)) {
        return $atts;
    }

    // Add role attribute
    $atts['role'] = 'menuitem';

    // Change tabindex
    if(empty($item->is_first)) {
        $atts['tabindex'] = '-1';
    } else {
        $atts['tabindex'] = '0';
    }

    // Change tabindex
    if($item->current) {
        $atts['aria-activedescendant'] = 'true';
    }

    // Change tabindex
    if($item->has_children) {
        $atts['data-toggle'] = 'collapsed';
        $atts['aria-haspopup'] = 'true';
        $atts['aria-expanded'] = 'false';
    }

    // Check make sure full url is used
    if (strpos($atts['href'], '/') === 0) {
        $atts['href'] = home_url($atts['href']);
    }

    return $atts;
}, 10, 3);

/**
 * Nav Menu Element
 * @since 1.0.0
 * @return string $item_output
 * @param object $item
 * @param int $depth
 * @param object $args
 * @return string $item_output
 *
 * Returns html string that includes <a> element
 * In case you need to append or prepend something insde the <li>
 */
add_filter('walker_nav_menu_start_el', function ($item_output, $item, $depth, $args = array()) {

    // Don't mess with other walkers
    if(empty($args->is_walker)) {
        return $item_output;
    }

    return $item_output;
}, 10, 4);

/**
 * Nav Menu Element
 * @since 1.0.0
 * @param array $classes
 * @param object $args
 * @return array $classes
 *
 * Returns html string that includes <a> element
 * In case you need to append or prepend something insde the <li>
 */
add_filter('nav_menu_submenu_css_class', function ($classes, $args = array()) {

    // Don't mess with other walkers
    if(empty($args->is_walker)) {
        return $classes;
    }

    if(!empty($args->submenu_class)) {
        $classes = explode(" ", $args->submenu_class);
    }

    return $classes;
}, 10, 2);

/**
 * Nav Menu Item Args
 * @since 1.0.0
 * @param object $args
 * @param object $item
 * @return array $args
 *
 * Returns html string that includes <a> element
 * In case you need to append or prepend something insde the <li>
 */
add_filter('nav_menu_item_args', function ($args = array(), $item) {

    // Don't mess with other walkers
    if(empty($args->is_walker)) {
        return $args;
    }

    // This is used for the submenu label
    if(!empty($item->has_children)) {
        $args->current_item_parent = $item->title;
    }

    return $args;
}, 10, 2);

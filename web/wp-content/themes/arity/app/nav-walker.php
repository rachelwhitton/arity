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
        $this->cpt     = in_array($cpt, get_post_types(['_builtin' => false]));
        $this->archive = get_post_type_archive_link($cpt);
    }

    /**
    * @see Walker::start_lvl()
    * @since 3.0.0
    *
    * @param string $output Passed by reference. Used to append additional content.
    * @param int $depth Depth of page. Used for padding.
    */
    // @codingStandardsIgnoreStart
    public function start_lvl(&$output, $depth = 0, $args = []) {
        parent::start_lvl($output, $depth, $args);
    }
    // @codingStandardsIgnoreEnd

    /**
    * Traverse elements to create list from elements.
    *
    * Display one element if the element doesn't have any children otherwise,
    * display the element and its children. Will only traverse up to the max
    * depth and no ignore elements under that depth.
    *
    * This method shouldn't be called directly, use the walk() method instead.
    *
    * @see Walker::start_el()
    * @since 2.5.0
    *
    * @param object $element Data object
    * @param array $children_elements List of elements to continue traversing.
    * @param int $max_depth Max depth to traverse.
    * @param int $depth Depth of current element.
    * @param array $args
    * @param string $output Passed by reference. Used to append additional content.
    * @return null Null on failure with no changes to parameters.
    */
    // @codingStandardsIgnoreStart
    public function display_element($element, &$children_elements, $max_depth, $depth, $args, &$output) {
        if (!$element) {
            return;
        }

        $id_field = $this->db_fields['id'];
        $this->has_children = !empty($children_elements[$element->$id_field]);

        parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }
    // @codingStandardsIgnoreEnd
}

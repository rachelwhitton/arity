<?php

/*
|--------------------------------------------------------------------------
| Post Type
|--------------------------------------------------------------------------
*/

add_action('init', function () {
    register_post_type( 'author', array(
        'labels' => array(
            'name' => __( 'Authors' ),
            'singular_name' => __( 'Author' ),
            'add_new' => __( 'Add New' ),
            'add_new_item' => __( 'Add Author' ),
            'edit_item' => __( 'Edit Author' ),
        ),
        'public' => true,
        'publicly_queryable' => false,
        'exclude_from_search' => true,
        'supports' => array('title','revisions'),
        'hierarchical'        => false,
        'show_in_menu' => true,
        'has_archive'         => false,
        'rewrite'             => false,
        'query_var'           => true,
        'can_export'          => true,
        'show_in_nav_menus' => false,
        'capability_type' => 'post',
        'menu_icon' => 'dashicons-groups'
        )
    );

    // Role Taxonomy
    register_taxonomy(
        'role',
        array('person'),
        array(
            'hierarchical' => true,
            'label' => 'Role',
            'publicly_queryable' => false,
            'query_var' => false,
            'rewrite' => false,
            'show_in_quick_edit'  => false
        )
    );

    // Remove View Link
    // add_filter( 'role_row_actions', function($actions, $tag) {
    //   unset($actions['view']);
    //   return $actions;
    // }, 10, 2);

});

?>

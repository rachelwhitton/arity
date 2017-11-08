<?php

return;

/*
|--------------------------------------------------------------------------
| Post Type
|--------------------------------------------------------------------------
*/

add_action('init', function () {
    register_post_type( 'product', array(
        'labels' => array(
            'name'            => __( 'Products' ),
            'singular_name'   => __( 'Products' ),
            'add_new'         => __( 'Add New' ),
            'add_new_item'    => __( 'Add Product' ),
            'edit_item'       => __( 'Edit Product' ),
        ),
        'description'         => '',
        'public'              => true,
        'publicly_queryable'  => false,
        'exclude_from_search' => true,
        'supports'            => array('title','revisions','page-attributes','excerpt','thumbnail'),
        'hierarchical'        => false,
        'show_in_menu'        => 'edit.php?post_type=page',
        'has_archive'         => false,
        'rewrite'             => false,
        'query_var'           => true,
        'can_export'          => true,
        'show_in_nav_menus'   => false,
        'capability_type'     => 'page'
        )
    );
});

/*
|--------------------------------------------------------------------------
| Post Type Columns
|--------------------------------------------------------------------------
*/

// Column Headers
add_filter('manage_edit-product_columns', function ($columns) {
    $new_columns['cb'] = '<input type="checkbox" />';
    $new_columns['title'] = $columns['title'];
    return $new_columns;
});

// Column Data
add_action('manage_posts_custom_column', function ($column_name, $id) {
    global $post;
    switch ($column_name) {
        default:
            break;
    }
});

?>

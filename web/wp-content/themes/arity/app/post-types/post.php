<?php

/*
|--------------------------------------------------------------------------
| Post Type
|--------------------------------------------------------------------------
*/

add_action('init', function () {
    register_taxonomy(
        'industry',  //The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces).
        array('post'),        //post type name
        array(
            'hierarchical' => true,
            'label' => 'Industries',  //Display name
            'labels'=> array(
              'edit_item' => 'Edit Industry',
              'update_item' => 'Update Industry',
              'add_new_item' => 'Add New Industry'
            ),
            'query_var' => true,
            'show_in_quick_edit' => false,
            'rewrite' => array(
                'slug' => 'industry', // This controls the base slug that will display before each term
                'with_front' => true // Don't display the category base before
            )
        )
    );
});

?>

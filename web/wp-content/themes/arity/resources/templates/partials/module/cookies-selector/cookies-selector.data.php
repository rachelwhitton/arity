<?php

$menu_name = 'cookies_selector';

if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
    $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );

    $menu_items = wp_get_nav_menu_items($menu->term_id);

    $data['menu_list'] = '<select class="form-control custom-select" name="" id="menu-' . $menu_name . '" onChange="window.document.location.href=this.options[this.selectedIndex].value;">';
    // $data['menu_list'] .= '<option value="">View this text in different language</option>';
    foreach ( (array) $menu_items as $key => $menu_item ) {
        $selected = '';
        $title = $menu_item->title;
        $url = $menu_item->url;
        if(get_permalink() == $url){
            $selected='selected';
        }
        $data['menu_list'] .= '<option value="' . $url . '" '.$selected.'>' . $title . '</option>';
    }
    $data['menu_list'] .= '</select>';
} else {
    $data['menu_list'] = '<ul><li>Menu "' . $menu_name . '" not defined.</li></ul>';
}

return $data;

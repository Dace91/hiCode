<?php
/**
 * @author: Antoine07
 * @description: taxonomy tag for map and post
 */

add_action('init', 'alCreateCountryTax');

function alCreateCountryTax()
{

    $labels = [
        'name' => 'pays',
        'singular_name' => 'pays',
        'search_items' => 'rechercher une pays',
        'all_items' => 'tous les pays',
        'parent_item' => 'parent pays',
        'edit_item' => 'edit pays',
        'update_item' => 'mettre à jour un pays',
        'add_new_item' => 'ajouter un pays',
        'new_item_name' => 'nouveau pays',
        'show_admin_column' => true,
        'menu_name' => 'pays',
    ];

    register_taxonomy('country', ['post', 'map'], [
        'hierarchical' => false, // tag
        'public' => true,
        'labels' => $labels,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'pays'),
    ]);
}













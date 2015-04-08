<?php

add_action('init', 'al_create_map_type');

function al_create_map_type() {
    //labels 
    $labels = array(
        'name' => 'map',
        'singular_name' => 'map',
        'all_items' => 'tous les maps',
        'add_new' => 'ajouter',
        'add_new_item' => 'ajouter un map',
        'edit' => 'éditer',
        'edit_item' => 'éditer un map',
        'new_item' => 'nouveau map',
        'view' => 'voir ',
        'view_item' => 'voir un map',
        'search_items' => 'rechercher un map',
        'not_found' => 'aucun map trouvé',
        'not_found_in_trash' => 'pas map dans la poubelle',
    );

    register_post_type('map', array(
        'labels' => $labels,
        'public' => true, 
        'public_queyrable' => true, 
        'show_in_menu' => true,
        'exclude_from_search' => false,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post', 
        'has_archives' => true, 
        'hierarchical' => false, 
        'menu_position' => 5, 
        'supports' => array('title','thumbnail', 'excerpt', 'author'),
            )
    );
}
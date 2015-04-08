<?php

add_action('init', 'alCreatePortfolioType');

function alCreatePortfolioType() {
    //labels 
    $labels = array(
        'name' => 'portfolio',
        'singular_name' => 'portfolio',
        'all_items' => 'tous les portfolios',
        'add_new' => 'ajouter',
        'add_new_item' => 'ajouter un portfolio',
        'edit' => 'éditer',
        'edit_item' => 'éditer un portfolio',
        'new_item' => 'nouveau portfolio',
        'view' => 'voir ',
        'view_item' => 'voir un portfolio',
        'search_items' => 'rechercher un portfolio',
        'not_found' => 'aucun portfolio trouvé',
        'not_found_in_trash' => 'pas portfolio dans la poubelle',
    );

    register_post_type('portfolio', array(
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
        'supports' => array('title','thumbnail', 'excerpt', 'comments'),
            )
    );
}
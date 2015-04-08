<?php
/**
 * @author: Antoine07
 * @description: manage all column gomobility
 * @tags: @post, @map, @comment
 */

/* ----------------- @post ---------------------------------------------- */

add_filter('manage_post_posts_columns', 'alAddPostColumns');
function alAddPostColumns($columns)
{
    unset($columns['tags']);
    $newColumns = [];

    foreach ($columns as $name => $label) {

        if ($name == 'author') {
            $newColumns['thumbnail'] = 'Miniature';
        }

        if ($name == 'comments') {
            $newColumns['country'] = 'pays';
        }
        $newColumns[$name] = $label;
    }

    return $newColumns;
}

add_action('manage_post_posts_custom_column', 'alAddPostColumn', 10, 2);

function alAddPostColumn($column, $postId)
{
    if (has_post_thumbnail($postId) && $column == 'thumbnail') {
        the_post_thumbnail('thumbnail-column');
    }

    if ($column == 'country') {
        $terms = get_the_terms($postId, $column);

        if ($terms && !is_wp_error($terms)) {

            $termsNames = [];
            foreach ($terms as $term) {
                $termsNames[] = sprintf('<a href="edit.php?%s=%s">%s</a>', $column, $term->name, $term->name);
            }

            echo implode(", ", $termsNames);
        }
    }
}

/* ----------------- @map ---------------------------------------------- */


add_filter('manage_map_posts_columns', 'al_add_map_columns');
function al_add_map_columns($columns)
{
    $newColumns = [];
    foreach ($columns as $name => $label) {
        if ($name == 'author') {
            $newColumns['country'] = 'pays';
        }
        $newColumns[$name] = $label;
    }

    return $newColumns;
}

add_action('manage_map_posts_custom_column', 'al_add_map_column', 10, 2);

function al_add_map_column($tax, $postId)
{
    $terms = get_the_terms($postId, $tax);
    if ($terms && !is_wp_error($terms)) {
        $termsName = [];
        foreach ($terms as $term) {
            $termsName[] = sprintf('<a href="edit.php?post_type=map&%s=%s">%s</a>', $tax, $term->name, $term->name);
        }
        echo implode(", ", $termsName);
    }
}

/* ----------------- @comment ---------------------------------------------- */

add_filter('manage_edit-comments_columns', 'al_add_comment_columns');

function al_add_comment_columns($columns)
{
    $columns['twitter_custom_column'] = '@twitter';
    return $columns;
}

add_filter('manage_comments_custom_column', 'al_add_comment_column', 10, 2);

function al_add_comment_column($column, $commentID)
{
    if ('twitter_custom_column' == $column) {
        if ($twitter = get_comment_meta($commentID, '_al_twitter', true)) {
            echo sprintf('compte twitter: %s', $twitter);
        }
    }
}


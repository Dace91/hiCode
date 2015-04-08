<?php if (is_active_sidebar('widget_sidebar')) : ?>

    <div class="wrapper">
        <?php dynamic_sidebar('widget_sidebar'); ?>
    </div>

<?php endif; ?>

<?php

if (is_author()) {

    $authorId = (int)get_query_var('author');
    $postMaps = $wpdb->get_results(
        "
	SELECT *
	FROM $wpdb->posts as p
	INNER JOIN $wpdb->term_relationships AS tr ON (tr.object_id = p.ID)
	INNER JOIN $wpdb->term_taxonomy AS tt ON (tr.term_taxonomy_id = tt.term_taxonomy_id)
	WHERE p.post_type = 'map'
	AND tt.taxonomy IN ('country')
	AND p.post_author=$authorId
	"
    );

    if ($postMaps) {
        foreach ($postMaps as $post) {
            setup_postdata($post);
            ?>
            <h2>
                <a href="<?php the_permalink(); ?>" rel="bookmark" title="Permalink: <?php the_title(); ?>">
                    <span class="glyphicon glyphicon-map-marker"></span><?php the_title(); ?>
                </a>
            </h2>
        <?php
        }
    } else {
        ?>
        <h2>Not Found</h2>
    <?php
    }

} else {
    wp_tag_cloud(['smallest' => 8, 'largest' => '25', 'taxonomy' => 'country']);
}


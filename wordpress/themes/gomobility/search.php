<?php
$query_args = explode("&", $query_string);
$search_query = array();

foreach ($query_args as $key => $string) {
    $query_split = explode("=", $string);
    $search_query[$query_split[0]] = urldecode($query_split[1]);
} // foreach

$search = new WP_Query($search_query);

get_header();
?>
<div class="container search">
    <div class="row search">
        <div class="col-xs-12">
            <?php if ($search->have_posts()): ?> 
                <?php while ($search->have_posts()): $search->the_post(); ?>
                    <h2> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <?php the_excerpt(); ?>
                    <p><?php the_date(); ?></p>
                    <p><?php the_category(); ?></p>
                <?php endwhile; ?>
            <?php endif; ?>

        </div>
    </div>
</div>
<?php get_footer(); ?>
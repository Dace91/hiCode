<?php
/*
 * Template Name: portfolio
 */

get_header('nologo');

$portfolios = new WP_Query([
    'post_type' => 'portfolio',
    'orderby' => 'post_date',
    'order' => 'DESC'
]);
?>
    <div class="container content">
        <div class="row content">
            <div class="col-xs-8">
                <?php if ($portfolios->have_posts()) : ?>
                    <?php while ($portfolios->have_posts()) : $portfolios->the_post(); ?>
                        <div class="portfolio clearfix">
                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <?php if (has_post_thumbnail()): ?>
                               <a href="<?php the_permalink() ?>" ><?php the_post_thumbnail('thumbnail', ['class' => 'img-thumbnail pull-left',]); ?></a>
                           <?php endif; ?>
                            <p><?php the_excerpt(); ?></p>
                            <?php
                            echo get_the_term_list($post->ID, 'country', '<ul class="list-inline"><li>', ',</li><li>', '</li></ul>');
                            ?>
                            <p><?php the_date('m-Y'); ?></p>
                        </div>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                <?php else: ?>
                    <p>Désolé pas de maps</p>
                <?php endif; ?>
            </div>
            <div class="col-xs-4">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div><!-- content -->
<?php get_footer(); ?>
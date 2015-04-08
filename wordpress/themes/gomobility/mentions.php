<?php
/**
 * Template Name: mentions légales
 */

get_header('nologo'); ?>
<div class="container mentions">
    <div class="row mentions">
<?php if (have_posts()): ?>
    <?php while (have_posts()): the_post(); ?>
        <h2> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <?php the_content(); ?>

    <?php endwhile; ?>
<?php endif;?>
        </div>
    </div>
<?php get_footer(); ?>
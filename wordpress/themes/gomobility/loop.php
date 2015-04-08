<?php if (have_posts()): ?> 
    <?php while (have_posts()): the_post(); ?>
        <h2> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <?php the_content(); ?>
        <p><?php the_tags('<ul class="list-inline"><li>','</li><li>','</li></ul>'); ?></p>
        <p>auteur: <?php the_author_posts_link(); ?></p>
        <?php comments_template(); ?>
    <?php endwhile; ?>
<?php else: ?>
        <p>Désolé pas d'article</p>
<?php endif;?>
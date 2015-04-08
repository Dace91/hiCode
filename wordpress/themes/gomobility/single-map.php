<?php get_header('nologo'); ?>
    <div class="container content">
        <div class="row content">
            <div class="col-xs-12">
                <?php if (have_posts()): ?>
                    <?php while (have_posts()): the_post(); ?>
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <?php the_excerpt(); ?>
                        <?php echo get_the_term_list($post->ID, 'country', '<ul class="list-inline">pays:<li>', ',</li><li>', '</li></ul>'); ?>
                        <p>auteur: <?php the_author_posts_link(); ?></p>
                        <?php if($coord = get_post_meta($post->ID, '_al_metamap_coord', true)) : ?>
                            <?php echo do_shortcode('[googlemap lat='.$coord['lat'].' lng='.$coord['lng'].' description="'.$coord['description'].'"]'); ?>
                        <?php endif; ?>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>Désolé pas d'article</p>
                <?php endif; ?>
            </div>
        </div>
    </div><!-- content -->
<?php get_footer(); ?>
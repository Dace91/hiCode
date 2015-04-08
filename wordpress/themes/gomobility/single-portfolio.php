<?php get_header('nologo'); ?>
    <div class="container content">
        <div class="row content">
            <div class="col-xs-6">
                <?php if (have_posts()): ?>
                    <?php while (have_posts()): the_post(); ?>
                        <div class="clearfix">
                            <h2><?php the_title(); ?></h2>
                            <?php if (has_post_thumbnail()):
                                the_post_thumbnail('large', ['class' => 'img-thumbnail pull-left',]);
                            endif; ?>
                            <?php the_excerpt(); ?>
                            <p><?php the_tags('<ul class="list-inline"><li>', '</li><li>', '</li></ul>'); ?></p>
                            <p>auteur: <?php the_author_posts_link(); ?></p>
                        </div>
                        <?php comments_template(); ?>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>Désolé pas de portfolio</p>
                <?php endif; ?>
            </div>
            <div class="col-xs-6">
                <h1>GoMobility</h1>
            </div>
        </div>
    </div><!-- content -->
<?php get_footer(); ?>
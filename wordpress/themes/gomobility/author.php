<?php
$authorId = get_query_var('author');
$userInfo = get_userdata($authorId);
get_header('nologo'); ?>
    <div class="container author">
        <div class="row author">
            <div class="col-xs-8">
                <div class="container author">
                    <div class="row author">
                        <div class="col-xs-6 col-md-4">
                            <h2>About: <?php echo $userInfo->nickname; ?></h2>
                            <dl>
                                <dt>Profile</dt>
                                <dd><?php echo $userInfo->user_description; ?></dd>
                                <dd><?php echo get_avatar($authorId, 200); ?></dd>
                            </dl>
                        </div>
                        <div class="col-xs-6 col-md-4">
                            <?php if (have_posts()) : ?>
                                <ul>
                                    <h2>Articles de l'auteur</h2>
                                    <?php while (have_posts()) : the_post(); ?>
                                        <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                                        <?php
                                        the_tags('<ul class="list-inline"><li>', ',</li><li>', '</li></ul>');
                                        ?>
                                        <p><?php the_time(); ?></p>
                                    <?php endwhile; ?>
                                </ul>
                            <?php else: ?>
                                <p>Désolé je n'ai pas encore écris d'article...</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-4">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div><!-- content -->
<?php get_footer(); ?>
<?php if (have_posts()): ?>
    <?php while (have_posts()): the_post(); ?>
        <div class="clearfix">
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><?php echo (get_post_type()=='map')? '<span class="glyphicon glyphicon-map-marker"></span>' :''; ?> </h2>
            <?php if (has_post_thumbnail()): ?>
                <?php the_post_thumbnail('thumbnail', ['class' => 'img-thumbnail pull-left',]); ?>
            <?php endif; ?>
            <?php the_excerpt(); ?>
            <p><?php comments_popup_link( 'Aucun commentaire', '1 commentaire', '% commentaires' ); ?></p>
            <p>catégories: <?php the_category(' '); ?></p>
            <p><?php the_tags('<ul class="list-inline"><small>mot(s) clef(s): </small><li>', ',</li><li>', '</li></ul>'); ?></p>
            <?php echo get_the_term_list($post->ID, 'country', '<ul class="list-inline">Pays:<li>', ',</li><li>', '</li></ul>'); ?>
            <p>auteur: <?php the_author_posts_link(); ?>,
                <?php echo (is_sticky()) ? '<span class="glyphicon glyphicon-star"></span>' : ''; ?>
                <?php echo (has_post_format('video')) ? '<span class="glyphicon glyphicon-facetime-video"></span>' : ''; ?>
            </p>
            <p><small>date de publication<?php the_date(); ?></small></p>
        </div>
    <?php endwhile; ?>
<?php endif; ?>
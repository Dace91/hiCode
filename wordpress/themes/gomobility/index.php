<?php get_header(); ?>
    <div class="container content">
        <div class="row content">
            <div class="col-xs-8">
                <?php get_template_part('loop', 'excerpt'); ?>
            </div>
            <div class="col-xs-4">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div><!-- content -->
<?php get_footer(); ?>
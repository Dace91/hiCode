<?php get_header(); ?>
<div class="container content bike">
    <div class="row content">
        <div class="col-xs-8">
           <?php get_template_part('loop', 'excerpt'); ?>
        </div>
        <div class="col-xs-4">
            <?php get_sidebar(); ?>
        </div>
    </div> <!-- row content -->
</div><!-- content -->
<?php get_footer(); ?>
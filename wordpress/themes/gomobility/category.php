<?php get_header(); ?>
<div class="text-center">

</div>
<div class="container content"> 
    <div class="row content">
        <div class="col-xs-8">
           <?php get_template_part('loop', 'excerpt'); // loop-excerpt.php ?>
        </div>
        <div class="col-xs-4">
            <?php get_sidebar(); ?>
        </div>
    </div> <!-- row content -->
</div>
</div>
</div><!-- content -->
<div class="text-center">

</div>
<?php get_footer(); ?>
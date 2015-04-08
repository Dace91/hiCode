<div class="container footer text-right">
    <div class="row footer">
        <!-- menu utilisateur -->
        <ul class="list-inline navbar-right">
            <?php wp_list_authors('hide_empty=0'); ?>
        </ul>
        <?php
        wp_nav_menu(array(
            'theme_location' => 'footer',
            'container' => 'div',
            'container_class' => 'navbar-collapse collapse navbar-right',
            'menu_class' => 'list-inline' // classe de Twitter Bootstrap
        ));
        ?>
    </div>
</div><!-- content -->
<?php wp_footer(); ?>
<?php if (is_active_sidebar('footer')): ?>
    <?php dynamic_sidebar('footer'); ?>
<?php endif; ?>
</body>
</html>
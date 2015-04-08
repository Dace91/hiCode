<html>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <?php wp_head(); ?>
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen"/>
    <title><?php wp_title(''); ?></title>
</head>
<body <?php body_class(); ?>>
<div class="container navigation">
    <div class="row navigation">
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <ol class="breadcrumb">
                    <?php echo alGetBreadcrumb(); ?>
                </ol>
            </div>
            <?php
            wp_nav_menu([
                'theme_location' => 'main',
                'container' => 'div',
                'container_class' => 'navbar-collapse collapse navbar-right',
                'menu_class' => 'nav navbar-nav',
                'walker' => new al_Walker_nav_menu()
            ]);
            ?>
        </nav>
    </div>
</div>
<!-- navigation -->
<div class="container header">
    <div class="row header">
        <div class="col-xs-12">
            <h1><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
        </div>
    </div>

</div>
<!-- header-->

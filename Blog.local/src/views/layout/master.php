<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="<?php echo Services\Config::url('dist/css/bootstrap.css'); ?>" />
        <link rel="stylesheet" href="<?php echo Services\Config::url('dist/css/mystyle.css'); ?>" />
    </head>
    <body>
        <div class="container navigation">
            <div class="row navigation">
                <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
                    <ol class="breadcrumb">
                        <li><span class="glyphicon glyphicon-bookmark"></span> <a href="<?php echo Services\Config::url(); ?>">Home</a></li>
                    </ol>
                    <div class="navbar-collapse collapse navbar-right">

                    </div>
                </nav>
            </div> <!-- row navigation -->
        </div> <!-- container navigation -->
        <div class="container header">
            <div class="row header">
                <div class="col-xs-4">
                    <img src="<?php echo Services\Config::url('img/Elephpant.png'); ?>" class="img-responsive" />
                </div>
                <div class="col-xs-4 col-xs-offset-4">
                    <blockquote>
                        <p><?php echo (isset($title)) ? $title : 'PHP 5.6 c\'est encore mieux' ?></p>
                        <small>dev</small>
                    </blockquote>
                </div>
            </div> <!-- row header -->
        </div> <!-- container header -->
        <section class="container content">
            <div class="row content">
                <?php echo $content; ?>
            </div>
        </section> <!-- row content -->
    </div> <!-- container content -->
    <div class="container footer text-right">

    </div> <!-- container footer -->

</body>
</html>
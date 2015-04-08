<div class="col-xs-6">
    <?php if ($posts): ?>
        <article>
            <?php foreach ($posts as $post) : ?>
            <h1><a href="<?php echo Services\Config::slugy($post->title, $post->id); ?>"><?php echo $post->title; ?></a></h1>
                <p><?php echo $post->excerpt; ?></p>
                <p>auteur: <a href="<?php echo Services\Config::slugy( 'user/'.$post->username , $post->user_id); ?>"><?php echo $post->username; ?></a></p>
                <p><a href="<?php echo Services\Config::slugy($post->title, $post->id); ?>">lire la suite...</a></p>
            <?php endforeach; ?>
        </article>
    <?php else: ?>
        <p>Désolé mais il n'y a pas de contenu pour l'instant...</p>
    <?php endif; ?>
</div>
<div class="col-xs-4">
    sidebar
</div>
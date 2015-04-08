<?php if ($post): ?>
    <article>
        <?php foreach ($post as $p) : ?>
            <h1><?php echo $p->title; ?></h1>
            <?php echo $p->content; ?>
        </article>
    <?php endforeach; ?>
<?php else: ?>
    <p>Désolé mais il n'y a pas de contenu pour l'instant...</p>
<?php endif; ?>
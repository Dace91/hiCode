<?php if (have_comments()): ?>

    <h3>il y a <?php echo get_comments_number(); ?> commentaire(s)</h3>

    <ul>
        <?php
        $args = ['callback' => 'al_show_comments'];
        wp_list_comments($args); ?>

    </ul>

<?php else : ?>
    <p>pas de commentaire pour cet article</p>
<?php endif; ?>

<?php

$fields = [
    'author' => '<div class="form-group"><p class="comment-form-author">' . '<label for="author">Auteur</label> ' . ($req ? '<span class="required">*</span>' : '') .
        '<input required  id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30" /></p></div>',
    'email' => '<p class="comment-form-email"><label for="email">Email</label> ' . ($req ? '<span class="required">*</span>' : '') .
        '<input required id="email" name="email" type="text" value="' . esc_attr($commenter['comment_author_email']) . '" size="30"/></p>',
    'url' => '<p class="comment-form-url"><label for="url">Site Web</label>' .
        '<input id="url" name="twitter" type="text" value="' . esc_attr($commenter['comment_twitter']) . '" size="30" /></p>',
    'twitter' => '<p class="comment-form-twitter"><label for="twitter">Twitter</label>' .
        '<input id="twitter" name="_al_twitter" type="text" value="' . esc_attr($commenter['comment_twitter']) . '" size="30" /></p>',
];
?>
<?php
comment_form(array('fields' => $fields)); ?>












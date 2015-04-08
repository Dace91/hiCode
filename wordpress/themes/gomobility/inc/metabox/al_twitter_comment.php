<?php

add_action('add_meta_boxes_comment', 'al_comment_add_meta_box');

function al_comment_add_meta_box()
{
    add_meta_box('al-twitter', 'twitter', 'alAddFieldTwitter', 'comment', 'normal', 'core');
}

function alAddFieldTwitter($comment)
{
    $twitter = get_comment_meta($comment->comment_ID, '_al_twitter', true);
    wp_nonce_field('al_metatwitter_field', 'al_metatwitter_field_nonce');
    ?>
    <p><label for="twitter">Twitter </label><input id="twitter" type="text" name="al_twitter"
                                                         value="<?php echo esc_attr($twitter); ?>"/></p>
<?php

}

add_action('edit_comment', 'alSaveTwitter');

function alSaveTwitter($commentId)
{

    $nonce = $_POST['al_metatwitter_field_nonce'];

    if (!wp_verify_nonce($nonce, 'al_metatwitter_field'))
        return $commentId;

    if (!current_user_can('edit_page', $commentId))
        return $commentId;

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return $commentId;

    //on vérifie que les données post sont envoyés
    if (isset($_POST['al_twitter'])) {
        $al_twitter = sanitize_text_field($_POST['al_twitter']);

        update_comment_meta($commentId, '_al_twitter', $al_twitter);
    }
}


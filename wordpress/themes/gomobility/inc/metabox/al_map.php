<?php

add_action('add_meta_boxes', 'alAddMetaMap');

function alAddMetaMap() {

    add_meta_box('al-metamap', '[Label] Map', 'alFieldsMap', 'map', 'normal', 'high');
}

function alFieldsMap($post) {

    $_al_metamap_coord = get_post_meta($post->ID, '_al_metamap_coord', true);

    $lat = isset($_al_metamap_coord['lat'])? $_al_metamap_coord['lat'] : '';
    $lng = isset($_al_metamap_coord['lng'])? $_al_metamap_coord['lng'] : '';
    $description = isset($_al_metamap_coord['description'])? $_al_metamap_coord['description'] : '';
    echo 'Définir les coordonnées de votre point';
    ?>
    <p>Lat <input type="text" name="al_map_lat" value="<?php echo esc_attr($lat); ?>" /></p>
    <p>Lng <input type="text" name="al_map_lng" value="<?php echo esc_attr($lng); ?>" /></p>

    <?php echo 'une description' ; ?>

    <textarea rows="1" cols="40" name="al_description" id="al_description"><?php echo esc_attr($description); ?></textarea>

    <?php wp_nonce_field('al_metamap_field', 'al_metamap_field_nonce'); ?>
    <?php
    if ($_al_metamap_coord) { ?>
        <p>lat: <?php echo esc_attr($_al_metamap_coord['lat']); ?>, lng: <?php echo esc_attr($_al_metamap_coord['lng']); ?></p>
    <?php
    }
}

add_action('save_post', 'alMetamapSave');

function alMetamapSave($postId) {

    $nonce = $_POST['al_metamap_field_nonce'];

    if (!wp_verify_nonce($nonce, 'al_metamap_field'))
        return ;

    if (!current_user_can('edit_post', $postId))
        return ;

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return ;

    if (isset($_POST['al_map_lat']) && isset($_POST['al_map_lng']) ) {
        $al_map_lat = sanitize_text_field($_POST['al_map_lat']);
        $al_map_lng = sanitize_text_field($_POST['al_map_lng']);
        $al_description = sanitize_text_field($_POST['al_description']);

        update_post_meta($postId, '_al_metamap_coord', [
            'lat' => $al_map_lat,
            'lng' => $al_map_lng,
            'description' =>  $al_description,
        ]);
    }
}

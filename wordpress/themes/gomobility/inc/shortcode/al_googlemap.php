<?php
/**
 * @param $atts
 * @return string map
 */


function alGooglemap($atts)
{
    global $post;
    static $script;
    $coord = shortcode_atts(array(
        'lat' => '48.85820982828746',
        'lng' => '2.340087890625',
        'description' => '',
        'link' => false,
        'zoom' => 8
    ), $atts);


    $lat = esc_js($coord['lat']);
    $lng = esc_js($coord['lng']);
    $description = esc_js($coord['description']);

    $width = '300';
    $height = '300';
    $zoom = 12;
    $permalink = ($link)? '<p> <a href="'.get_permalink($post->ID).'">lire la suite...</a></p>' : '';

    $output = '';
    if(is_null($script))
    {
        $script = '<script type="text/javascript"
        src="http://maps.google.com/maps/api/js?sensor=false"></script>';
        $output = $script;
    }

    $hash =  mt_rand(5, 15);

    $output .= <<<CODE
    <div id="al_mapal_map$hash"></div>

    <script type="text/javascript">
    function generate() {
        var latlng = new google.maps.LatLng( $lat, $lng );
        var options = {
            zoom: $zoom,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }

        var map = new google.maps.Map(
            document.getElementById("al_map"),
            options
        );

        var legend = '<div class="map_legend"><p>$description</p>$permalink</div>';

        var infowindow = new google.maps.InfoWindow({
            content: legend,
        });

        var marker = new google.maps.Marker({
            position: latlng,
            map: map,
        });

        google.maps.event.addListener(marker, 'click', function() {
            infowindow.open(map,marker);
        });
    }

    generate();

    </script>

    <style type"text/css">
    .map_legend{
        width:200px;
        max-height:200px;
        min-height:100px;
    }
    #al_map$hash {
        position: relative;
        padding-bottom: 56.25%;
        padding-top: 30px;
        height: 0;
        overflow: hidden;
    }
    </style>

CODE;

    return $output;
}

add_shortcode('googlemap', 'alGooglemap');
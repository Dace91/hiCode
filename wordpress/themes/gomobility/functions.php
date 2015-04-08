<?php
/**
 * @author: Antoine07
 *
 * @tags: @scripts, @theme, @breadcrumb, @cpt, @shorcode, @metabox, @Walker, @cms, @comment, @columns, @home
 *
 */

define('AL_THEME_NAME', 'gomobility');

/* ----------------@cms ------------------------------------------------ */

add_action( 'init', 'alRemoveTags' );

function alRemoveTags() {
    //register_taxonomy( 'category', [] );
    register_taxonomy( 'post_tag', [] );
}

add_action('dashboard_glance_items', 'alGlanceDashboard');

function alGlanceDashboard()
{
    $args = [
        'public' => true,
        '_builtin' => false
    ];

    $output = 'objects';
    $operator = 'and';

    $postTypes = get_post_types($args, $output, $operator);
    foreach ($postTypes as $postType) {
        $numPosts = wp_count_posts($postType->name);
        $num = number_format_i18n($numPosts->publish);
        $text = _n($postType->labels->name, $postType->labels->name, intval($numPosts->publish));
        if (current_user_can('edit_posts')) {
            $cptName = $postType->name;
        }
        echo '<li><tr><a class="' . $cptName . '" href="edit.php?post_type=' . $cptName . '"><td></td>' . $num . ' <td>' . $text . '</td></a></tr></li>';
    }
    $taxonomies = get_taxonomies($args, $output, $operator);
    foreach ($taxonomies as $taxonomy) {
        $numTerms = wp_count_terms($taxonomy->name);
        $num = number_format_i18n($numTerms);
        $text = _n($taxonomy->labels->name, $taxonomy->labels->name, intval($numTerms));
        if (current_user_can('manage_categories')) {
            $cptTax = $taxonomy->name;
        }
        echo '<li><tr><a class="' . $cptTax . '" href="edit-tags.php?taxonomy=' . $cptTax . '"><td></td>' . $num . ' <td>' . $text . '</td></a></tr></li>';
    }
}

// login wordpress
add_action( 'login_enqueue_scripts', 'alLogoAdmin' );

function alLogoAdmin() { ?>
    <style type="text/css">
        body.login div#login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/assets/images/fenley.png);
            padding-bottom: 30px;
        }
    </style>
<?php }

add_action( 'login_enqueue_scripts', 'alStylesheetAdmin' );

function alStylesheetAdmin() {
    wp_enqueue_style( 'custom-login', get_template_directory_uri() . '/assets/css/login.css' );
    //wp_enqueue_script( 'custom-login', get_template_directory_uri() . '/assets/style-login.js' );
}

/* ----------------@scripts ------------------------------------------------- */

add_action('wp_enqueue_scripts', 'alSetUpScripts');

function alSetUpScripts()
{
    wp_enqueue_script('jquery');

    wp_enqueue_style(
        'bootstrap-css',
        get_template_directory_uri() . '/assets/css/bootstrap.min.css',
        [],
        false,
        'screen'
    );

    wp_enqueue_script(
        'bootstrap-js',
        get_template_directory_uri() . '/assets/js/bootstrap.min.js',
        ['jquery']
    );

    if (is_user_logged_in()) {
        wp_enqueue_style('admin-css',
            get_template_directory_uri() . '/assets/css/admin-css.css', ['bootstrap-css']
        );
    }

    if (is_category(3)) {
        wp_enqueue_style(
            'byke-css',
            get_template_directory_uri() . '/assets/css/byke.css',
            [],
            false,
            'screen'
        );
    }
}

/* ----------------@themes -------------------------------------------- */

add_action('after_setup_theme', 'alSetUpTheme');

function alSetUpTheme()
{
    register_nav_menus([
        'main' => 'Mon joli menu principal', // position 
        'footer' => 'Mon menu dans le footer'
    ]);

    add_theme_support('post-thumbnails');
    add_theme_support('post-formats', ['video']);
    add_image_size('thumbnail-column', 90, 90, true);
}

/* ----------------- @widget ------------------------------------------------ */

add_action('widgets_init', 'alSetUpWidgets');

function alSetUpWidgets()
{
    register_sidebar([
        'name' => 'widget sidebar',
        'id' => 'widget_sidebar',
        'description' => 'zone widgets sibebar',
        'before_widget' => '<div class="widget_%1$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ]);

}

/* ----------------@home ---------------------------------------------------- */

add_filter('pre_get_posts', 'alGetMapPostHome');

function alGetMapPostHome($query)
{
    if (is_home() && $query->is_main_query())
        $query->set('post_type', [ 'map', 'post']);

    return $query;
}

/* -------- @breadcrumb ------------------------------------------------------ */

function alGetBreadcrumb()
{

    if (is_home()) {
        return "<li class=\"active\">Home</li>";
    }

    // Je met le lien vers la page d'accueil pour tous les autres fil d'arianes
    $html = sprintf('<li><a href="%s">Home</a></li>', get_home_url());

    if (is_category()) {
        $id = (int)$_GET['cat'];
        $category = get_the_category_by_ID($id);
        $html .= sprintf('<li>%s</li>', $category);
        return $html;
    }

    // un post mais pas un cpt map
    if (is_single() && !is_singular('map')) {
        $category = get_the_category();
        $urlCat = get_category_link($category[0]->term_id);
        $titleCat = $category[0]->cat_name;
        $html .= sprintf('<li><a href="%s">%s</a></li>', $urlCat, $titleCat);
        $html .= sprintf('<li>%s</li>', single_post_title('', false));
        return $html;
    }

    // custom post type map ou page c'est le même code
    if (is_singular('map') || is_page()) {
        $html .= sprintf('<li>%s</li>', single_post_title('', false));
        return $html;
    }
}

/* ----------------- @filter ----------------------------------------------------- */
add_filter('excerpt_more', 'alReadMore');

function alReadMore($more)
{
    global $post;
    return '<a class="moretag" href="' . get_permalink($post->ID) . '"> lire la suite...</a>';
}


add_filter('bloginfo', 'alChangeBloginfo', 10, 2);

function alChangeBloginfo($text, $show)
{
    if ('description' == $show) {
        $user = get_user_by('id', 1);
        $text = '<p>' . get_bloginfo('description') . '</p>';
        $text .= '<small>' . $user->user_nicename . '</small>';
    }
    return $text;
}

/* ----------------    @cpt @tax --------------------------------------------------------------- */

require_once ABSPATH . 'wp-content/themes/' . AL_THEME_NAME . '/inc/tax/al_country.php';

require_once ABSPATH . 'wp-content/themes/' . AL_THEME_NAME . '/inc/cpt/al_portfolio.php';
require_once ABSPATH . 'wp-content/themes/' . AL_THEME_NAME . '/inc/cpt/al_map.php';

/* -------------------- @metabox    ------------------------------------------------------------*/

require_once ABSPATH . 'wp-content/themes/' . AL_THEME_NAME . '/inc/metabox/al_map.php';
require_once ABSPATH . 'wp-content/themes/' . AL_THEME_NAME . '/inc/metabox/al_twitter_comment.php';

//@comment
require_once ABSPATH . 'wp-content/themes/' . AL_THEME_NAME . '/inc/metabox/al_comment.php';

/* ----------------     @column -------------------------------------------------------------- */

require_once ABSPATH . 'wp-content/themes/' . AL_THEME_NAME . '/inc/column/al_column.php';

/* -------------------- @shorcode ----------------------------------------------------------- */

require_once ABSPATH . 'wp-content/themes/' . AL_THEME_NAME . '/inc/shortcode/al_googlemap.php';

/* ---------------------@walker -------------------------------------------------------------- */

require_once ABSPATH . 'wp-content/themes/' . AL_THEME_NAME . '/inc/Walker/al_Walker_nav_menu.php';

/* ---------------@email -------------------------------------------------------------------- */

add_action('phpmailer_init', 'alPhpMailer');

function alPhpMailer($phpmailer)
{
    $phpmailer->isSMTP();
    $phpmailer->Host = 'smtp.orange.fr';
    $phpmailer->SMTPAuth = true; // Force it to use Username and Password to authenticate
    $phpmailer->Port = 25;
    $phpmailer->Username = 'antoine.lucsko';
    $phpmailer->SMTPSecure = 'tls';
    $phpmailer->Password = 'XXXXXX';
}

// email with HTML
add_filter('wp_mail_content_type', 'alSetContentType');

function alSetContentType()
{
    return "text/html";
}






















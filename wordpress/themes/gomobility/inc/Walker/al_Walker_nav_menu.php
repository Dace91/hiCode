<?php

class al_Walker_nav_menu extends Walker_Nav_Menu
{

    function start_lvl(&$output, $depth = 0, $args = [])
    {

        $depth++; // // because it counts the first submenu as 0

        $className = '';
        $target = '';

        if ($depth > 0) {
            $className = 'dropdown-menu';
            $target = '<li class="dropdown" ><a class="dropdown-toggle" data-toggle="dropdown" href="#"><b class="caret"></b></a>';
        }

        $indent = str_repeat("\t", $depth);
        $output .= "\n" . $indent . $target . '<ul class="' . $className . '">' . "\n";

    }

    public function end_el(&$output, $item, $depth = 0, $args = array())
    {

        $depth++;
        $li = $depth > 0 ? '</li>' : '';
        $output .= "$li</li>\n";
    }


    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        $classes = empty($item->classes) ? array() : (array)$item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));

        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';

        $output .= $indent . '<li' . $id . $class_names . '>';

        $atts = array();

        $span = !empty($item->attr_title)? '<span class="glyphicon glyphicon-'.$item->attr_title.'"></span>' : '';
        $semantic = ['home' => 'accueil', 'road' =>'route vélo', 'inbox' =>'contact', 'picture' => 'portfolio', 'cog'=>'velo en ville'];

        $attrTitle =isset($semantic[$item->attr_title])? $semantic[$item->attr_title]: $item->attr_title;

        $atts['title'] = !empty($item->attr_title) ? $attrTitle : '';
        $atts['target'] = !empty($item->target) ? $item->target : '';
        $atts['rel'] = !empty($item->xfn) ? $item->xfn : '';
        $atts['href'] = !empty($item->url) ? $item->url : '';

        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }



        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>' . $span;
        /** This filter is documented in wp-includes/post-template.php */
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }


}
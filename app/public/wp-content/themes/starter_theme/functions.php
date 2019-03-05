<?php
// Enqueue scripts and styles -->
function site_files() {
  wp_enqueue_script('site_js', get_theme_file_uri('/js/scripts-bundled.js'), NULL, true);
  wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
  wp_enqueue_style('site_main_styles', get_stylesheet_uri(), NULL, microtime());
}
add_action( 'wp_enqueue_scripts', 'site_files' );


function site_features() {
    add_theme_support('title-tag');
    //Register menu
    register_nav_menu('headerMenuLocation', 'Header Menu Location');
    //Image Size Option
    add_theme_support('post-thumbnails');
    add_image_size('small', 300, '', false);
    add_image_size('medium', 768, '', false);
    add_image_size('large', 1024, '', false);
    add_image_size('xlarge', 1500, '', false);
    add_image_size('fullHD', 1920, '', false);
    add_image_size('fullHDup', 2500, '', false);
}

add_action( 'after_setup_theme', 'site_features' );

//Add Thumbnail to all Posts screen
function admin_columns_head($defaults) {
    $defaults['thumbnail']  = 'thumbnail';
    return $defaults;
}

function admin_columns_content($column_name, $post_ID) {
    if ($column_name == 'thumbnail') {
         $img_choice = get_field('img_choice', $post_ID);
        if ($img_choice) {
            echo  '<img style="width:50px" src="' . $img_choice['sizes']['thumbnail'] .  '" />';
        }
    }
}

add_filter('manage_posts_columns', 'admin_columns_head');
add_action('manage_posts_custom_column', 'admin_columns_content', 10, 2);
?>
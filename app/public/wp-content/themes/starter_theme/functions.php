<?php
/////////////// GET RID OF DEFAULT UNWANTED
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' ); 

function my_deregister_scripts(){
  wp_deregister_script( 'wp-embed' );
  }
  add_action( 'wp_footer', 'my_deregister_scripts' );
  
/////////////////////////////////////////////

// Enqueue scripts and styles -->
function site_files() {
  wp_register_script('site_js', get_theme_file_uri('/dist/scripts-bundled.js'), NULL, '1.0',true);
  wp_enqueue_script('site_js');
  wp_enqueue_style('site_main_styles', get_theme_file_uri('/dist/styles.css'), NULL);
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
?>
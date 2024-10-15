<?php


function load_css()
{
    wp_register_style('main', get_template_directory_uri() . '/css/main.css', [], 1, 'all');
    wp_enqueue_style('main');
}
add_action('wp_enqueue_scripts', 'load_css');

// Register menus
register_nav_menus(array(
    'top-menu' => __('Top Menu', 'theme'),
    'footer-menu' => __('Footer Menu', 'theme'),
));
add_theme_support('menus');
add_theme_support('post-thumbnails');

// Image size
add_image_size('small', 600, 600, false);



// function create_product_taxonomy() {
//     register_taxonomy(
//         'product_category',
//         'product',
//         array(
//             'label' => __( 'Product Categories' ),
//             'rewrite' => array( 'slug' => 'product-category' ),
//             'hierarchical' => true,
//         )
//     );
// }
// add_action( 'init', 'create_product_taxonomy' );

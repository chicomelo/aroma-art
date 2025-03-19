<?php
    // adiciona suporte a thumbs
    add_theme_support('post-thumbnails');

    // Slide home
    add_image_size( 'featured-post', 556, 300, true );
    add_image_size( 'big-featured-post', 556, 630, true );
    add_image_size( 'post-list', 556, 350, true );
    add_image_size( 'single-featured-post', 1424, 540, true );
    add_image_size( 'sidebar-post', 500, 500, true );
    add_image_size( 'category-featured-post', 936, 540, true );
    add_image_size( 'most-read-post', 652, 480, true );

    // para aparecer tbm no admin
    add_filter( 'image_size_names_choose', 'my_custom_sizes' );
    function my_custom_sizes( $sizes ) {
        return array_merge( $sizes, array(
            'featured-post' => __( 'Featured Post' ),
            'big-featured-post' => __( 'Big Featured Post' ),
            'post-list' => __( 'Post List' ),
            'single-featured-post' => __( 'Single Featured Post' ),
            'sidebar-post' => __( 'Sidebar Featured Post' ),
            'category-featured-post' => __( 'Category Featured Post' ),
            'most-read-post' => __( 'Most Read Post' ),
        ) );
    }

    // muda default size das imagens que subir nos posts
    function custom_image_size() {
        update_option('image_default_align', 'center' );
        update_option('image_default_size', 'large' );
    }
    add_action('after_setup_theme', 'custom_image_size');


?>

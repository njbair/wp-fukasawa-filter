<?php

add_action( 'wp_enqueue_scripts', 'fukasawa_filter_enqueue_scripts' );
function fukasawa_filter_enqueue_scripts() {
    wp_enqueue_style( 'fukasawa_parent_style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'fukasawa_filter_style', get_stylesheet_directory_uri() . '/style.css', [ 'fukasawa_parent_style' ], wp_get_theme()->get('Version') );
    wp_enqueue_script( 'fukasawa_filter_main', get_stylesheet_directory_uri() . '/js/main.js', [ 'fukasawa_global' ], wp_get_theme()->get('Version') );
}

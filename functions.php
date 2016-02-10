<?php

function IRAWebsite_resources() {

    wp_enqueue_style('style', get_stylesheet_uri());

    wp_register_style('animate-css', get_stylesheet_directory_uri() . '/animate.min.css', array(), '20160209', 'screen');
    wp_enqueue_style('animate-css');

    wp_enqueue_script('roboto-google-font', 'https://fonts.googleapis.com/css?family=Roboto+Condensed');

    wp_enqueue_script('jquery', get_template_directory_uri() . '/jquery-1.12.0.min.js', array(), '1.12.0', true);
    wp_enqueue_script('test-isotope', get_template_directory_uri() . '/js/test_isotope.js', array('jquery'));

    wp_enqueue_script('isotope', get_template_directory_uri() . '/isotope.pkgd.min.js', array(), '2.2.2', 'true');
}

add_action('wp_enqueue_scripts', 'IRAWebsite_resources');

// Navigation Menus
register_nav_menus(array(
    'primary' => __( 'Primary Menu'),
    'footer' => __( 'Footer Menu'),
    'sidebar' => __( 'Sidebar Menu'),

));

<?php

function IRAWebsite_resources() {

    wp_enqueue_style('style', get_stylesheet_uri());
    wp_enqueue_script('roboto-google-font', 'https://fonts.googleapis.com/css?family=Roboto+Condensed');
}

add_action('wp_enqueue_scripts', 'IRAWebsite_resources');

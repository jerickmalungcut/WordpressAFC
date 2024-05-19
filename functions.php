<?php

// Styling Components

function load_css() {
    wp_register_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), false, 'all');
    wp_enqueue_style('bootstrap');

    wp_register_style('main', get_template_directory_uri() . '/css/main.css', array(), false, 'all');
    wp_enqueue_style('main');

    wp_enqueue_style('tailwindcss', get_template_directory_uri() . '/assets/css/style.css', array(), '1.0.0', 'all');
}

add_action('wp_enqueue_scripts', 'load_css');

// Script Components

function load_js() {

    wp_enqueue_script('jquery'); //Because JQuery is already installed automatically on Wordpress

    wp_register_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', 'jquery',false, true);
    wp_enqueue_script('bootstrap');
}

add_action('wp_enqueue_scripts', 'load_js');

//Theme Options
add_theme_support('menus');


// Navigation Links

function my_theme_setup() {
    //Register Navmenus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'mytheme'),
        'mobile-menu' => __('Mobile Menu', 'mytheme'),
    ));
}

add_action('after_setup_theme', 'my_theme_setup');

//Include Navwalker

require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
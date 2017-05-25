<?php


if (!defined('ABSPATH')) {
    exit;
}
function bargp_add_scripts(){
    add_action('wp_enqueue_scripts', 'check_lib_load', 99999);

    function check_lib_load() {
        global $wp_styles;
        $srcs = array_map('basename', (array) wp_list_pluck($wp_styles->registered, 'src') );
        //bootstrap
        if ( in_array('bootstrap.css', $srcs) || in_array('bootstrap.min.css', $srcs)  ) {
            return;
        } else {
            wp_enqueue_style('bargp-bootstrap-light', plugins_url() . '/barbareshet-github-projects/assets/lib/bootstrap-light/css/bootstrap.min.css' );
        }
        //devicons.css
        if ( in_array('devicons.css', $srcs) || in_array('devicons.min.css', $srcs)  ) {
                return;
        } else {
            wp_enqueue_style('bargp-devicons', plugins_url() . '/barbareshet-github-projects/assets/lib/devicons/css/devicons.min.css' );
        }
        //font-awesome
        if ( in_array('font-awesome.css', $srcs) || in_array('font-awesome.min.css', $srcs)  ) {
            return;
        } else {
            wp_enqueue_style('bargp-devicons', plugins_url() . '/barbareshet-github-projects/assets/lib/devicons/css/devicons.min.css' );
            wp_enqueue_style('bargp-font-awesome', plugins_url() . '/barbareshet-github-projects/assets/lib/font-awesome/css/font-awesome.min.css' );
        }
    }


    wp_enqueue_style('bargp-styles', plugins_url() . '/barbareshet-github-projects/assets/css/barbareshet-github-projects-style.css');
    wp_enqueue_script('bargp-js', plugins_url() . '/barbareshet-github-projects/assets/js/barbareshet-github-projects-javascript.js',array('jquery'), microtime(), true );
    wp_enqueue_script('github-buttons-js', 'https://buttons.github.io/buttons.js',array('jquery'), microtime(), false );

}
add_action('wp_enqueue_scripts', 'bargp_add_scripts');
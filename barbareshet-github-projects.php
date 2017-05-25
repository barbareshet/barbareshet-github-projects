<?php

/*
Plugin Name: Barbareshet GitHub projects
Plugin URI: https://github.com/barbareshet
Description: My personal GitHub projects
Author: Iod Barnea
Author URI: http://www.barbareshet.co.il
Version: 1.0
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: bargp
*/

if (!defined('ABSPATH')) {
    exit;
}

/*
 *
 * Include files
 * Since 1.0
 */

require_once (plugin_dir_path(__FILE__) . '/inc/barbareshet-github-projects-scripts.php');
require_once (plugin_dir_path(__FILE__) . '/inc/barbareshet-github-projects-class.php');

/**
 * Register the Widget
 *
 * since 1.0
 */

function bargp_register_widget(){

    //Class name
    register_widget('barbareshet_github_projects');
}

add_action('widgets_init', 'bargp_register_widget');
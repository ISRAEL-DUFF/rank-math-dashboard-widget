<?php
/**
* Plugin Name: Rank Math Graph Widget
* Author: Israel Duff
* Version: 1.0.0
* Description: A wordpress plugin for the Rank Math code challenge.
* Text Domain: rank-math-graph-widget
* Domain Path: /languages
*/

namespace Israel;

require_once plugin_dir_path(__FILE__) . 'definitions.php';

if (! defined('ABSPATH')) :
    exit();
endif; // No direct access allowed.


register_activation_hook(__FILE__, 'wprk_rank_math_plugin_create_db');


/**
* Loading Necessary Scripts
*/
add_action('admin_enqueue_scripts', 'wprk_load_scripts');
add_action('init', 'wprk_set_script_translations');
    
require_once WPRK_PATH . 'classes/class-create-dashboard-widget.php';
require_once WPRK_PATH . 'classes/class-create-settings-routes.php';
    

new WPRKCreateDashboardWidget();
new WPRKReactSettingsRestRoute();

<?php
/**
* Define Plugins Contants and functiona
*/
if (! defined('WPRK_PATH')) {
    define('WPRK_PATH', trailingslashit(plugin_dir_path(__FILE__)));
}

if (! defined('WPRK_URL')) {
    define('WPRK_URL', trailingslashit(plugins_url('/', __FILE__)));
}

if (!function_exists('wprk_load_scripts')) {
    function wprk_load_scripts($hook)
    {
        if (is_admin()) {
            if ($hook != 'index.php') {
                return;
            }
            wp_enqueue_script(
                'wprk-rank-math-analysis',
                WPRK_URL . 'build/index.js',
                ['wp-element', 'wp-api-fetch', 'wp-i18n'],
                wp_rand(),
                true
            );

            wp_localize_script(
                'wprk-rank-math-analysis',
                'appLocalizer',
                [
                'apiUrl' => home_url('/wp-json'),
                'nonce' => wp_create_nonce('wp_rest'),
                ]
            );
        }
    }
}

if (!function_exists('wprk_rank_math_plugin_create_db')) {
    function wprk_rank_math_plugin_create_db()
    {

        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();
        $table_name = $wpdb->prefix . 'rank_math_analysis';
        
        $sql = "CREATE TABLE $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
            name varchar(100) NOT NULL,
            uv int(5) NOT NULL,
            pv int(5) NOT NULL,
            amt int(5) NOT NULL,
            UNIQUE KEY id (id)
            ) $charset_collate;";
            
            $insert_sql = "INSERT INTO $table_name (name, uv, pv, amt) VALUES
            ('Page A', '4000', '24000', '2400'), ('Page B', '3000', '14200', '7500'), 
            ('Page C', '6300', '67000', '1400'), ('Page D', '7100', '84000', '2500'), 
            ('Page E', '9000', '22000', '2600'),
            ('Page F', '3500', '26000', '2800'), ('Page G', '1000', '94000', '4400'),
            ('Page H', '4300', '2000', '2400'), ('Page I', '7000', '15200', '1500'), 
            ('Page J', '4300', '117000', '3100'), ('Page K', '9100', '34000', '5100'), 
            ('Page L', '4500', '43000', '2200'),
            ('Page M', '1000', '85000', '3300'), ('Page N', '2394', '48374', '2837')
            ";
            
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
        dbDelta($insert_sql);
    }
}

if (!function_exists('wprk_set_script_translations')) {
    function wprk_set_script_translations()
    {
        wp_set_script_translations('rank-math-graph-widget-script', 'rank-math-graph-widget');
    }
}

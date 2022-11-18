<?php
/**
 * This file will create Custom Rest API End Points.
 */
namespace Israel;

if (! class_exists('WPRKReactSettingsRestRoute')) {
    class WPRKReactSettingsRestRoute
    {

        public function __construct()
        {
            add_action('rest_api_init', [ $this, 'createRestRoutes' ]);
        }
    
        public function createRestRoutes()
        {
            register_rest_route(
                'wprk/v1',
                '/settings',
                [
                  'methods' => 'GET',
                  'callback' => [ $this, 'getSettings' ],
                  'permission_callback' => [ $this, 'getSettingsPermission' ]
                ]
            );
        }
    
        public function getSettings()
        {
            global $wpdb;
    
            $table_name = $wpdb->prefix . 'rank_math_analysis';
    
            $results = $wpdb->get_results(
                "SELECT * FROM $table_name"
            );
    
            return rest_ensure_response(json_encode($results));
        }
    
        public function getSettingsPermission()
        {
            return true;
        }
    }
}
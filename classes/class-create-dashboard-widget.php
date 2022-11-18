<?php
/**
 * This file will create admin menu page.
 */
namespace Israel;

if (! class_exists('WPRKCreateDashboardWidget')) {
    class WPRKCreateDashboardWidget
    {

        public function __construct()
        {
            add_action('wp_dashboard_setup', [ $this, 'myDashboardWidget' ]);
        }
    
        public function myDashboardWidget()
        {
            wp_add_dashboard_widget(
                'rank_math_graph_dashboard_widget',
                'Rank Math Graph Dashboard Widget',
                array($this,'rankMathChartWidget')
            );
        }
    
        public function rankMathChartWidget()
        {
            echo '<div class="wrap"><div id="wprk-admin-app"></div></div>';
        }
    }
}
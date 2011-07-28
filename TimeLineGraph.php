<?php
/*
Plugin Name: Time Line Graph
Plugin URI: http://maps.afrigis.co.za
Description: Plugin is for nothing
Author: Rocon
Version: 0.1.0
Author URI: n/a
*/


// don't load directly
if (!function_exists('is_admin')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

// Pre-2.6 compatibility
if ( ! defined( 'WP_CONTENT_URL' ) )
      define( 'WP_CONTENT_URL', get_option( 'siteurl' ) . '/wp-content' );
if ( ! defined( 'WP_CONTENT_DIR' ) )
      define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content' );


define( 'TimeLineGraph_DIR', WP_PLUGIN_DIR . '/shiba-example-plugin' );
define( 'TimeLineGraph_URL', WP_PLUGIN_URL . '/shiba-example-plugin' );



$meta_box = array(
    'id' => 'my-meta-box',
    'title' => 'New TimeLineGraph',
    'page' => 'post',
    'context' => 'side',
    'priority' => 'high'
);

if (!class_exists("TimeLineGraph")) :
class TimeLineGraph {
	var $addpage;
        var $db;

	function TimeLineGraph() {
		add_action('admin_init', array(&$this,'init_admin') );
		add_action('init', array(&$this,'init') );
		add_action('admin_menu', array(&$this,'add_pages') );
                add_action('admin_print_scripts-post.php', array(&$this, 'new_postiing'));
                add_action('admin_print_scripts-post-new.php', array(&$this, 'new_postiing')) ;
		register_activation_hook( __FILE__, array(&$this,'activate') );
		register_deactivation_hook( __FILE__, array(&$this,'deactivate') );

                
	}


        function new_postiing()
        {
            global $meta_box;
            add_meta_box($meta_box['id'], $meta_box['title'], array(&$this,'metabox_contain'), $meta_box['page'], $meta_box['context'], $meta_box['priority']);
        }

        function metabox_contain(){
            include 'php/metabox.php';
        }

        function activate() {
            add_option("timeline_width", "550", "",'yes');
            add_option("timeline_height", "350", "",'yes');
	}

	function deactivate() {
            delete_option("timeline_width");
            delete_option("timeline_height");
	}

        function  admin_menus(){
            include 'php/admin_menus.php';
        }

        function init_admin() {

	}



        function init() {
		//load_plugin_textdomain( 'TimeLineGraph', TimeLineGraph_DIR . '/lang', basename( dirname( __FILE__ ) ) . '/lang' );
	}

	function add_pages() {
                add_options_page("Time Line Settings", "Time Line Settings", 1,"admin_menu",array(&$this,'admin_menus'));
		// Add a new submenu
//		$this->addpage = add_options_page(	__('Shiba Example', 'TimeLineGraph'), __('Shiba Example', 'TimeLineGraph'),
//											'administrator', 'TimeLineGraph',
//											array(&$this,'add_TimeLineGraph_page') );
//		add_action("admin_head-$this->addpage", array(&$this,'add_TimeLineGraph_admin_head'));
//		add_action("load-$this->addpage", array(&$this, 'on_load_TimeLineGraph_page'));
//		add_action("admin_print_styles-$this->addpage", array(&$this,'add_TimeLineGraph_admin_styles'));
//		add_action("admin_print_scripts-$this->addpage", array(&$this,'add_TimeLineGraph_admin_scripts'));
	}

	function add_TimeLineGraph_admin_head() {
	}


	function add_TimeLineGraph_admin_styles() {
	}

	function add_TimeLineGraph_admin_scripts() {
	}

	function on_load_TimeLineGraph_page() {
	}


	function add_TimeLineGraph_page() {
		//include('shiba-example-page.php');

	}

	function print_example($str, $print_info=TRUE) {
//		if (!$print_info) return;
//		__($str . "<br/><br/>\n", 'TimeLineGraph' );
	}

} // end class
endif;

global $TimeLineGraph;
if (class_exists("TimeLineGraph") && !$TimeLineGraph) {
    $TimeLineGraph = new TimeLineGraph();
}







?>

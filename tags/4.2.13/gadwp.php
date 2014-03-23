<?php
/*
 * Plugin Name: Google Analytics Dashboard for WP 
 * Plugin URI: http://deconf.com 
 * Description: Displays Google Analytics Reports and Real-Time Statistics in your Dashboard. Automatically inserts the tracking code in every page of your website.  
 * Author: Alin Marcu 
 * Version: 4.2.13 
 * Author URI: http://deconf.com
 */  


/*
 * Include Install
*/

include_once (dirname ( __FILE__ ) . '/install/install.php');
// $test = new GADASH_Install;
// $test->install();
register_activation_hook ( __FILE__, array (
		'GADASH_Install',
		'install' 
) );

/*
 * Include Uninstall
 */
include_once (dirname ( __FILE__ ) . '/install/uninstall.php');
register_uninstall_hook ( __FILE__, array (
		'GADASH_Uninstall',
		'uninstall' 
) );

// Plugin i18n
add_action ( 'plugins_loaded', 'ga_dash_load_i18n' );

function ga_dash_load_i18n() {
	load_plugin_textdomain ( 'ga-dash', false, basename(dirname ( __FILE__ )) . '/languages' );
}


if (is_admin()){
	add_action( 'plugins_loaded', 'gadash_admin_init');
} else {
	add_action( 'plugins_loaded', 'gadash_front_init');
}


function gadash_admin_init(){
	/*
	 * Include config
	 */
	include_once (dirname ( __FILE__ ) . '/config.php');
	global $GADASH_Config;
		
	/*
	 * Include backend widgets
	 */
	if (current_user_can ( $GADASH_Config->options['ga_dash_access_back'] )) {
		include_once (dirname ( __FILE__ ) . '/admin/dashboard_widgets.php');
	}
	/*
	 * Include frontend widgets
	*/
	include_once (dirname ( __FILE__ ) . '/front/widgets.php');	
}

function gadash_front_init(){
	/*
	 * Include config
	*/
	include_once (dirname ( __FILE__ ) . '/config.php');
	global $GADASH_Config;	
	
	/*
	 * Include frontend stats
	 */
	if (current_user_can ( $GADASH_Config->options['ga_dash_access_front'] ) AND ($GADASH_Config->options['ga_dash_frontend_stats'] OR $GADASH_Config->options['ga_dash_frontend_keywords'])) {
		include_once (dirname ( __FILE__ ) . '/front/frontend.php');
	}	
	/*
	 * Include tracking
	 */
	if (!current_user_can ( $GADASH_Config->options ['ga_track_exclude'] ) AND $GADASH_Config->options ['ga_dash_tracking']) {
		include_once (dirname ( __FILE__ ) . '/front/tracking.php');
	}	
	/*
	 * Include frontend widgets
	*/	
	include_once (dirname ( __FILE__ ) . '/front/widgets.php');
}

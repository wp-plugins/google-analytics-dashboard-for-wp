<?php
if (! class_exists ( 'GADASH_Config' )) {
	class GADASH_Config {
		public $options;
		public $country_codes;
		public $plugin_path, $plugin_url;
		
		public function __construct() {
			$this->getPluginPath ();
			
			// get plugin options
			$this->get_plugin_options ();

			// Plugin i18n			
			add_action ( 'plugins_loaded', array (
					$this,
					'ga_dash_load_i18n' 
			) );
		}

		public function set_plugin_options() {
			if (current_user_can ( 'manage_options' )){
				update_option ( 'gadash_options', json_encode ( $this->options ) );
			}	
		}
		
		public function getPluginPath() {
			/*
			 * Set Plugin Path
			 */
			$this->plugin_path = dirname ( __FILE__ );
			$this->plugin_url = plugins_url ( "", __FILE__ );
		}
		
		function ga_dash_load_i18n() {
			load_plugin_textdomain ( 'ga-dash', false, $this->plugin_path . '/languages' );
		}

		private function get_plugin_options() {
			/*
			 * Get plugin options
			 */
			if (!get_option ( 'gadash_options' )){
				GADASH_Install::install();
			}
			$this->options = ( array ) json_decode ( get_option ( 'gadash_options' ) );
			
			//Maintain Compatibility
			if (!isset($this->options['ga_enhanced_links'])){
				$this->options['ga_enhanced_links'] = 0;
			}
		}

	}
}

$GLOBALS ['GADASH_Config'] = new GADASH_Config ();

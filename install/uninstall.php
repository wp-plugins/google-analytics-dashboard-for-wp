<?php
Class GADASH_Uninstall{
	static function uninstall(){
		global $wpdb;
		$sqlquery = $wpdb->query ( "DELETE FROM $wpdb->options WHERE option_name LIKE '_transient_gadash%%'" );
		$sqlquery = $wpdb->query ( "DELETE FROM $wpdb->options WHERE option_name LIKE '_transient_timeout_gadash%%'" );		
		delete_option(gadash_options);
	}
}

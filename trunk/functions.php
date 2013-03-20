<?php	
	function ga_dash_store_token ($token){
		update_option('ga_dash_token', $token);
	}		
	
	function ga_dash_get_token (){

		if (get_option('ga_dash_token')){
			return get_option('ga_dash_token');
		}
		else{
			return;
		}
	
	}
	
	function ga_dash_reset_token (){
		update_option('ga_dash_token', "");
		update_option('ga_dash_tableid', "");
		update_option('ga_dash_tableid_jail', "");
		update_option('ga_dash_profile_list', "");
		update_option('ga_dash_access', ""); 		
	}
?>
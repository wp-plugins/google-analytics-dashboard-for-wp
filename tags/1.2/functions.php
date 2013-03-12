<?php	
	function ga_dash_store_token ($token){
		update_option('ga_dash_token', $token);
	}		
	
	function ga_dash_get_token (){

		if (get_option('ga_dash_token')){
			return get_option('ga_dash_token', $token);
		}
		else{
			return;
		}
	
	}
	
	function ga_dash_reset_token (){

		update_option('ga_dash_token', ""); 
	
	}
?>
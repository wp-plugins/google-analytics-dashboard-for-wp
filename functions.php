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
	
// Get Top Pages
	function ga_dash_top_pages($service, $projectId, $from, $to){
		$code="";
		$metrics = 'ga:pageviews'; 
		$dimensions = 'ga:pageTitle';
		try{
			$serial='gadash_qr4'.str_replace(array('ga:',',','-',date('Y')),"",$projectId.$from.$to);
			$transient = get_transient($serial);
			if ( empty( $transient ) ){
				$data = $service->data_ga->get('ga:'.$projectId, $from, $to, $metrics, array('dimensions' => $dimensions, 'sort' => '-ga:pageviews', 'max-results' => '5', 'filters' => 'ga:pagePath!=/'));
				set_transient( $serial, $data, get_option('ga_dash_cachetime') );
			}else{
				$data = $transient;		
			}			
		}  
			catch(exception $e) {
			echo "<br />ERROR LOG:<br /><br />".$e; 
		}	
		if (!$data['rows']){
			return;
		}
		$code .= '<ol>';
		foreach ($data['rows'] as $items){
			$code .= '<li><i>'.substr(esc_html($items[0]),0,70).'</i> - '.number_format($items[1]).' views</li>';
		}
		$code .= '</ol>';
		return $code;
	}
	
// Get Top referrers
	function ga_dash_top_referrers($service, $projectId, $from, $to){
		$code="";
		$metrics = 'ga:visits'; 
		$dimensions = 'ga:source,ga:medium';
		try{
			$serial='gadash_qr5'.str_replace(array('ga:',',','-',date('Y')),"",$projectId.$from.$to);
			$transient = get_transient($serial);
			if ( empty( $transient ) ){
				$data = $service->data_ga->get('ga:'.$projectId, $from, $to, $metrics, array('dimensions' => $dimensions, 'sort' => '-ga:visits', 'max-results' => '6', 'filters' => 'ga:medium==referral'));	
				set_transient( $serial, $data, get_option('ga_dash_cachetime') );
			}else{
				$data = $transient;		
			}			
		}  
			catch(exception $e) {
			echo "<br />ERROR LOG:<br /><br />".$e; 
		}	
		if (!$data['rows']){
			return;
		}
		$code .= '<ul>';
		foreach ($data['rows'] as $items){
			$code .= '<li><i>'.esc_html($items[0]).'</i> - '.number_format($items[2]).' visits</li>';
		}
		$code .= '</ul>';
		return $code;
	}

// Get Top searches
	function ga_dash_top_searches($service, $projectId, $from, $to){
		$code="";
		$metrics = 'ga:visits'; 
		$dimensions = 'ga:keyword';
		try{
			$serial='gadash_qr6'.str_replace(array('ga:',',','-',date('Y')),"",$projectId.$from.$to);
			$transient = get_transient($serial);
			if ( empty( $transient ) ){
				$data = $service->data_ga->get('ga:'.$projectId, $from, $to, $metrics, array('dimensions' => $dimensions, 'sort' => '-ga:visits', 'max-results' => '6', 'filters' => 'ga:keyword!=(not provided);ga:keyword!=(not set)'));
				set_transient( $serial, $data, get_option('ga_dash_cachetime') );
			}else{
				$data = $transient;		
			}			
		}  
			catch(exception $e) {
			echo "<br />ERROR LOG:<br /><br />".$e; 
		}	
		if (!$data['rows']){
			return;
		}
		$code .= '<ul>';
		foreach ($data['rows'] as $items){
			$code .= '<li><i>'.esc_html($items[0]).'</i> - '.number_format($items[1]).' visits</li>';
		}
		$code .= '</ul>';
		return $code;
	}
?>
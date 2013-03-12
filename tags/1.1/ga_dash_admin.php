<?php
if ( !current_user_can( 'manage_options' ) ) {
	return;
}
if (isset($_REQUEST['Reset'])){
	require_once 'functions.php';
	ga_dash_reset_token();
	?><div class="updated"><p><strong><?php _e('Token Reseted.' ); ?></strong></p></div>  
	<?php
}else if($_POST['ga_dash_hidden'] == 'Y') {  
        //Form data sent  
        $apikey = $_POST['ga_dash_apikey'];  
        update_option('ga_dash_apikey', sanitize_text_field($apikey));  
          
        $clientid = $_POST['ga_dash_clientid'];  
        update_option('ga_dash_clientid', sanitize_text_field($clientid));  
          
        $clientsecret = $_POST['ga_dash_clientsecret'];  
        update_option('ga_dash_clientsecret', sanitize_text_field($clientsecret));  
          
        $tableid = $_POST['ga_dash_tableid'];  
        update_option('ga_dash_tableid', sanitize_text_field($tableid));  
  
        //$height = $_POST['ga_dash_height'];  
        //update_option('ga_dash_height', $height);  
  
        //$width = $_POST['ga_dash_width'];  
        //update_option('ga_dash_width', $width);  
        ?>  
        <div class="updated"><p><strong><?php _e('Options saved.' ); ?></strong></p></div>  
<?php  
    }
	
$apikey = get_option('ga_dash_apikey');  
$clientid = get_option('ga_dash_clientid');  
$clientsecret = get_option('ga_dash_clientsecret');  
$tableid = get_option('ga_dash_tableid');  
$token = get_option('ga_dash_token') ? "<font color='green'>Authorized</font>" : "<font color='red'>Not Authorized</font> - <i>You will need to authorize the application from your Admin Dashboard</i>";
?>  

<div class="wrap">  
    <?php    echo "<h2>" . __( 'Google Analytics Dashboard Settings', 'ga_dash_trdom' ) . "</h2>"; ?>  
      
    <form name="ga_dash_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">  
        <input type="hidden" name="ga_dash_hidden" value="Y">  
        <?php    echo "<h3>" . __( 'Google Analytics API', 'ga_dash_trdom' ) . "</h3>"; ?>  
        <p><?php _e("<b>API Key: </b>" ); ?><input type="text" name="ga_dash_apikey" value="<?php echo $apikey; ?>" size="61"><?php _e("<i> ex: AIzaSyASK7dLaii4326AZVyZ6MCOIQOY6F30G_1</i>" ); ?></p>  
        <p><?php _e("<b>Client ID: </b>" ); ?><input type="text" name="ga_dash_clientid" value="<?php echo $clientid; ?>" size="60"><?php _e("<i> ex: 111342334706.apps.googleusercontent.com</i>" ); ?></p>  
        <p><?php _e("<b>Client Secret: </b>" ); ?><input type="text" name="ga_dash_clientsecret" value="<?php echo $clientsecret; ?>" size="55"><?php _e("<i> ex: c62POy23C_2qK5fd3fdsec2o</i>" ); ?></p>  
        <p><?php _e("<b>Table ID: </b>" ); ?><input type="text" name="ga_dash_tableid" value="<?php echo $tableid; ?>" size="61"><?php _e("<i> ex: 63623209</i>" ); ?></p>  
		<p><?php _e("<b>Application Status: </b>" ); echo $token; ?></p>  
      
        <p class="submit">  
        <input type="submit" name="Submit" class="button button-primary" value="<?php _e('Update Options', 'ga_dash_trdom' ) ?>" />
		<input type="submit" name="Reset" class="button button-primary" value="<?php _e('Reset Token', 'ga_dash_trdom' ) ?>" />		
        </p>  
    </form>  
</div> 
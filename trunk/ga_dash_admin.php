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

        $dashaccess = $_POST['ga_dash_access'];  
        update_option('ga_dash_access', $dashaccess); 

        ?>  
        <div class="updated"><p><strong><?php _e('Options saved.' ); ?></strong></p></div>  
<?php  
    }
	
$apikey = get_option('ga_dash_apikey');  
$clientid = get_option('ga_dash_clientid');  
$clientsecret = get_option('ga_dash_clientsecret');  
$dashaccess = get_option('ga_dash_access'); 
$token = get_option('ga_dash_token') ? "<font color='green'>Authorized</font>" : "<font color='red'>Not Authorized</font> - <i>You will need to authorize the application from your Admin Dashboard</i>";

?>  

<div class="wrap">  
    <?php    echo "<h2>" . __( 'Google Analytics Dashboard Settings', 'ga_dash_trdom' ) . "</h2>"; ?>  
        <form name="ga_dash_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">  
        <input type="hidden" name="ga_dash_hidden" value="Y">  
        <?php    echo "<h3>" . __( 'Google Analytics API', 'ga_dash_trdom' ); echo " (watch this <a href='http://www.deconf.com/en/projects/google-analytics-dashboard-for-wordpress/' target='_blank'>Step by step video tutorial</a>)"."</h3>"; ?>  
        <p><?php _e("<b>API Key: </b>" ); ?><input type="text" name="ga_dash_apikey" value="<?php echo $apikey; ?>" size="61"><?php _e("<i> ex: AIzaSyASK7dLaii4326AZVyZ6MCOIQOY6F30G_1</i>" ); ?></p>  
        <p><?php _e("<b>Client ID: </b>" ); ?><input type="text" name="ga_dash_clientid" value="<?php echo $clientid; ?>" size="60"><?php _e("<i> ex: 111342334706.apps.googleusercontent.com</i>" ); ?></p>  
        <p><?php _e("<b>Client Secret: </b>" ); ?><input type="text" name="ga_dash_clientsecret" value="<?php echo $clientsecret; ?>" size="55"><?php _e("<i> ex: c62POy23C_2qK5fd3fdsec2o</i>" ); ?></p>  
		<p><?php _e("<b>View Access Level: </b>" ); ?>
		<select id="ga_dash_access" name="ga_dash_access">
			<option value="manage_options" <?php if (($dashaccess=="manage_options") OR ($dashaccess=="")) echo "selected='yes'"?>>Administrators</option>
			<option value="edit_pages" <?php if ($dashaccess=="edit_pages") echo "selected='yes'"?>>Editors</option>
			<option value="publish_posts" <?php if ($dashaccess=="publish_posts") echo "selected='yes'"?>>Authors</option>
			<option value="edit_posts" <?php if ($dashaccess=="edit_posts") echo "selected='yes'"?>>Contributors</option>
		</select>
		<p><?php _e("<b>Application Status: </b>" ); echo $token; ?></p>  
      
        <p class="submit">  
        <input type="submit" name="Submit" class="button button-primary" value="<?php _e('Update Options', 'ga_dash_trdom' ) ?>" />
		<input type="submit" name="Reset" class="button button-primary" value="<?php _e('Reset Token', 'ga_dash_trdom' ) ?>" />		
        </p>  
    </form>  
</div> 
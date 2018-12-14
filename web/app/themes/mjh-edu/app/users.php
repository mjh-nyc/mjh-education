<?php
/**
 * Actions/Filter functions for code related to users
 */

/**
 * Insert wp base user data and fetch user_id so that acf-pro fields can then save to it
 *
 * @hook add_action acf/pre_save_post
 * @return int
 */
function users_generate_new_user_id( $post_id, $form ) {

	// Check that we are targeting the right form by acf_form ID.
	if ( !isset( $form['id'] ) || $form['id'] != 'new-user' ) {
		return $post_id;
	}

	// Create an empty array to add user field data into
	$user_fields = array("role"=>"subscriber",'user_pass'=>wp_generate_password());

	// Check for the fields we need in our postdata, and add them to the $user_fields array if they exist
	if ( !empty( $_POST['acf']['field_5bda425e64353'] ) ) {
		$user_fields['first_name'] = sanitize_text_field( $_POST['acf']['field_5bda425e64353'] );
	}

	if ( !empty( $_POST['acf']['field_5bda42791a28d'] ) ) {
		$user_fields['last_name'] = sanitize_text_field( $_POST['acf']['field_5bda42791a28d'] );
	}

	if ( !empty( $_POST['acf']['field_5bda42a5b3269']) ) {
		$user_fields['user_email'] = sanitize_email( $_POST['acf']['field_5bda42a5b3269'] );
		$user_fields['user_login'] = users_create_userlogin_by_email($user_fields['user_email']);
	}
	$user_id = wp_insert_user( $user_fields );

	if ( is_wp_error( $user_id ) ) {
		// If adding this user failed, deliver an error message.
		wp_die( $user_id->get_error_message() );
	} else {
		// Set the 'post_id' to the newly created user_id, including the 'user_' ACF uses to target a user
		$_POST['users-register']['uid']=$user_id;
		return 'user_' . $user_id;
	}
}
add_action( 'acf/pre_save_post', 'users_generate_new_user_id', 10, 2 );

/**
 * Create a user name (required by wordpress) on registration based on email address
 *
 * @return string
 */
function users_create_userlogin_by_email($email){
	// Explode the email and check, return complete string if nothing in first key
	$emailHash = explode("@", $email,2);
	if(!empty($emailHash[0])) {

		if (username_exists($emailHash[0])) {
			$user_login = false;
			$count =0;
			// If string exists, we append a number to the end and loop till string is unique
			while (!$user_login) {
				$count++;
				$check_username = $emailHash[0].$count;
				// If string does not exists, return this
				if (!username_exists($check_username)) {
					$user_login = $check_username;
				}
			}
			return $user_login;
		}else{
			return $emailHash[0];
		}
	}else{
		return $email;
	}
}

/**
 * Update wp base user data and update password
 *
 * @hook add_action acf/pre_save_post
 * @return int
 */
function users_update_user_data( $post_id, $form ) {
	// Check that we are targeting the right form by acf_form ID.
	$user_id = get_current_user_id();
	$user = get_user_by( 'ID', $user_id );
	if ( !isset( $form['id'] ) || $form['id'] != 'edit-user' || empty($user) ) {
		return $post_id;
	}

	// Create an empty array to add user field data into
	$user_fields = array('ID' => $user_id);

	// Check for the fields we need in our postdata, and add them to the $user_fields array if they exist
	if ( !empty( $_POST['acf']['field_5bda425e64353'] ) ) {
		$user_fields['first_name'] = sanitize_text_field( $_POST['acf']['field_5bda425e64353'] );
	}

	if ( !empty( $_POST['acf']['field_5bda42791a28d'] ) ) {
		$user_fields['last_name'] = sanitize_text_field( $_POST['acf']['field_5bda42791a28d'] );
	}

	if ( !empty( $_POST['acf']['field_5bda42a5b3269']) ) {
		$user_fields['user_email'] = sanitize_email( $_POST['acf']['field_5bda42a5b3269'] );
	}

	//Update wordpress user data
	wp_update_user($user_fields);

	//Update user password
	if ( !empty( $_POST['acf']['field_5bea1c105b2f5']) ) {
		wp_set_password( $_POST['acf']['field_5bea1c105b2f5'], $user_id );
		// Log-in again.
		wp_set_auth_cookie($user->ID);
		wp_set_current_user($user->ID);
		do_action('wp_login', $user->user_login, $user);
	}

	if ( is_wp_error( $user_id ) ) {
		// If adding this user failed, deliver an error message.
		wp_die( $user_id->get_error_message() );
	} else {
		// Set the 'post_id' to the newly created user_id, including the 'user_' ACF uses to target a user
		return $post_id;
	}
}
add_action( 'acf/pre_save_post', 'users_update_user_data', 10, 2 );

/**
 * Load first name value from wordpress field for profile edit
 *
 * @hook acf/load_value/<field-key>
 * @return string
 */
function users_acf_load_value_first_name( $value, $post_id, $field )
{
	if(is_user_logged_in() ){
		$current_user = wp_get_current_user();
		return $current_user->first_name;
	}
}
add_filter('acf/load_value/key=field_5bda425e64353', 'users_acf_load_value_first_name', 10, 3);

/**
 * Load last name value from wordpress field for profile edit
 *
 * @hook acf/load_value/<field-key>
 * @return string
 */
function users_acf_load_value_last_name( $value, $post_id, $field )
{
	if(is_user_logged_in() ) {
		$current_user = wp_get_current_user();
		return $current_user->last_name;
	}
}
add_filter('acf/load_value/key=field_5bda42791a28d', 'users_acf_load_value_last_name', 10, 3);

/**
 * Load email value from wordpress field for profile edit
 *
 * @hook acf/load_value/<field-key>
 * @return string
 */
function users_acf_load_value_email( $value, $post_id, $field )
{
	if(is_user_logged_in() ) {
		$current_user = wp_get_current_user();
		return $current_user->user_email;
	}
}
add_filter('acf/load_value/key=field_5bda42a5b3269', 'users_acf_load_value_email', 10, 3);

/**
 * Load username value from wordpress field for profile edit
 *
 * @hook acf/load_value/<field-key>
 * @return string

function users_acf_load_value_username( $value, $post_id, $field )
{
	if(is_user_logged_in() ) {
		$current_user = wp_get_current_user();
		return $current_user->user_login;
	}
}
add_filter('acf/load_value/key=field_5bdb7385658db', 'users_acf_load_value_username', 10, 3);
 */
/**
 * Disable field user name for user edit
 *
 * @hook acf/load_field/<field-key>
 * @return array

function users_acf_load_field_username( $field )
{
	if(is_user_logged_in() ) {
		$field['readonly'] = true;
	} else {
		$field['readonly'] = false;
	}
	return $field;
}
add_filter('acf/load_field/key=field_5bdb7385658db', 'users_acf_load_field_username', 10, 3);
 */
/**
 * Send verification email for new users
 *
 * @hook add_action user_register
 * @return null
 */
/*function users_registration_email( $user_id ) {
	if(!empty($user_id) && !empty($_POST['register']) ) {
		wp_new_user_notification( $user_id, null, 'user' );
	}
}
add_action( 'user_register', 'users_registration_email', 20, 1 );*/

/**
 * Custom validation of user registration form
 *
 * @hook acf/validate_save_post
 * @return null
 */
function users_validate_save_post() {
	if(!empty($_POST['_acf_post_id']) && $_POST['_acf_post_id']=='new_user') {
		// User Email
		if (!empty($_POST['acf']['field_5bda42a5b3269'])) {
			if (email_exists($_POST['acf']['field_5bda42a5b3269'])) {
				acf_add_validation_error('acf[field_5bda42a5b3269]', __('This email address is already registered, try a different email address or log in!', 'sage'));
			}
		}
		// User Login
		if (!empty($_POST['acf']['field_5bdb7385658db'])) {
			if (username_exists($_POST['acf']['field_5bdb7385658db'])) {
				acf_add_validation_error('acf[field_5bdb7385658db]', __('This username is already registered, please select a different username.', 'sage'));
			}
		}
	}
}
add_action('acf/validate_save_post', 'users_validate_save_post', 10, 0);

/**
 * Custom validation of user profile edit form
 *
 * @hook acf/validate_save_post
 * @return null
 */
function users_validate_edit_profile_save_post() {
	$user_id = get_current_user_id();
	$user = get_user_by( 'ID', $user_id );
	if(!empty($user) && !empty($_POST['_acf_post_id']) && $_POST['_acf_post_id']=='user_'.$user_id ) {
		// User Email Change
		if (!empty($_POST['acf']['field_5bda42a5b3269']) && ( $_POST['acf']['field_5bda42a5b3269'] != $user->user_email )) {
			if (email_exists($_POST['acf']['field_5bda42a5b3269'])) {
				acf_add_validation_error('acf[field_5bda42a5b3269]', __('This email address is already registered, try a different one or log in!', 'sage'));
			}
		}
		//Password Change
		if (!empty($_POST['acf']['field_5bea1be6be692'])) {
			if (!empty($_POST['acf']['field_5bea24624ccf8']) && !empty($_POST['acf']['field_5bea1c105b2f5']) && !empty($_POST['acf']['field_5bea1c37a09d5'])) {
				if ( wp_check_password( $_POST['acf']['field_5bea24624ccf8'], $user->data->user_pass, $user->ID) ){
					if($_POST['acf']['field_5bea1c105b2f5'] != $_POST['acf']['field_5bea1c37a09d5'] ){
						acf_add_validation_error( 'acf[field_5bea1c105b2f5]', __('Password confirmation failed, try again.','sage') );
					}
				}else{
					acf_add_validation_error( 'acf[field_5bea24624ccf8]', __('Current password entered does not match our records, please try again.','sage') );
				}
			} else {
				acf_add_validation_error('acf[field_5bea1be6be692]', __('Please fill out all password fields and try again.', 'sage'));
			}
		}
	}
}
add_action('acf/validate_save_post', 'users_validate_edit_profile_save_post', 10, 0);

/**
 * Delete user profile edit form duplicates of wordpress data
 *
 * @hook acf/save_post
 * @return null
 */
function users_acf_save_post_delete( $post_id ) {
	//Username
	//delete_field('field_5bdb7385658db',$post_id);
	//First Name
	delete_field('field_5bda425e64353',$post_id);
	//Last Name
	delete_field('field_5bda42791a28d',$post_id);
	//Email
	delete_field('field_5bda42a5b3269',$post_id);
	//Check change password
	delete_field('field_5bea1be6be692',$post_id);
	//Current password
	delete_field('field_5bea24624ccf8',$post_id);
	//New Password
	delete_field('field_5bea1c105b2f5',$post_id);
	// Confirm new password
	delete_field('field_5bea1c37a09d5',$post_id);

}
add_action('acf/save_post', 'users_acf_save_post_delete', 20);

/**
 * Redirection for user registration
 *
 * @hook init
 * @return null
 */
function users_redirect_register() {
	global $pagenow;
	if ( ( strtolower($pagenow) == 'wp-login.php') && ( (!empty($_GET['action']) && strtolower( $_GET['action']) == 'register') || (!empty($_GET['registration']) && strtolower($_GET['registration']) == 'disabled') ) ) {
		wp_redirect( home_url('/register'));
	}
}
add_action('init','users_redirect_register');

/**
 * Redirection if login fails
 *
 * @hook wp_login_failed
 * @return null
 */
function users_login_failed() {
	$login_page  = home_url('/login/');
	wp_redirect($login_page . '?login=failed');
	exit;
}
add_action('wp_login_failed', 'users_login_failed');

/**
 * Redirection on logout
 *
 * @hook wp_logout
 * @return null
 */
function users_logout_redirect() {
	$login_page  = home_url('/login/');
	wp_redirect($login_page . "?login=false");
	exit;
}
add_action('wp_logout','users_logout_redirect');

/**
 * User login form footer
 *
 * @hook wp_logout
 * @return null
 */
function users_login_form_bottom() {
	return '<div class="users-reset-link"><a href="'.get_home_url().'/wp/wp-login.php?action=lostpassword">'.__("I forgot my password","sage").'</a></div><div class="users-register-link"><hr>'.__("Not enrolled? Registration is free and takes only a minute.","sage").'<br><a href="'.get_home_url().'/register/" class="cta cta-blue cta-icon cta-arrow animsition-link" style="margin-top:10px;">'.__("Register","sage").'</a></div>';
}
add_filter('login_form_bottom','users_login_form_bottom');

/**
 * Change password text
 *
 * @hook gettext
 * @return null
 */
function users_change_password_reset_text_filter( $translated_text, $untranslated_text, $domain ) {
	switch( $untranslated_text ) {
		case 'Enter your new password below.':
			$translated_text = __( 'Randomly generated password provided. You can change this and enter your own password below.','sage' );
		break;
	}
	return $translated_text;
}
add_filter('gettext', 'users_change_password_reset_text_filter', 20, 3);

/**
 * Custom validation of user share form on my-account page
 *
 * @hook acf/validate_save_post
 * @return null
 */
function users_validate_share_email() {
	//Check we are validating a form with no post id associated and managed by af_form
	if(isset($_POST['_acf_post_id']) && $_POST['_acf_post_id']=='0' && !empty($_POST['af_form'])) {
		// Validate to make sure its only a valid email
		if (!empty($_POST['acf']['field_5bfc90948fdb0'])) {
			$email = $_POST['acf']['field_5bfc90948fdb0'];
			if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
				acf_add_validation_error('acf[field_5bfc90948fdb0]', __('This email address is invalid, please try again.', 'sage'));
			}
		}
	}
}
add_action('acf/validate_save_post', 'users_validate_share_email', 10, 0);


/* Custom Wordpress Password Email
********************************************************/
function mjh_retrieve_password_message( $message, $key ){
    $user_data = '';
    // If no value is posted, return false
    if( ! isset( $_POST['user_login'] )  ){
            return '';
    }
    // Fetch user information from user_login
    if ( strpos( $_POST['user_login'], '@' ) ) {
 
        $user_data = get_user_by( 'email', trim( $_POST['user_login'] ) );
    } else {
        $login = trim($_POST['user_login']);
        $user_data = get_user_by('login', $login);
    }
    if( ! $user_data  ){
        return '';
    }
    $user_login = $user_data->user_login;
    $user_email = $user_data->user_email;
    $user_first_name = $user_data->first_name;
    // Setting up message for retrieve password
    $message = __("Dear","sage")." ".$user_first_name.",\n\n";
    $message .= __("A password reset has been requested for your account at","sage").": ";
    $message .= network_home_url( '/' ) . "\r\n\r\n";
    $message .= __("If you did not request it, just ignore this email and nothing will happen.","sage")."\n\n"; 
    $message .= __("To reset your password, visit the following address:","sage")."\n";
    $message .= network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user_login), 'login');

    $message .= "\r\n\r\n\r\n";
    $message .= __("Museum of Jewish Heritage – A Living Memorial to the Holocaust","sage")."\n";
	$message .= __("Edmond J. Safra Plaza","sage")."\n";
	$message .= __("36 Battery Place","sage")."\n";
	$message .= __("New York, NY 10280","sage");
    
    return $message;
}
add_filter( 'retrieve_password_message', 'mjh_retrieve_password_message', 10, 2 );




/* Remove Default Wordpress Changed Password Email
********************************************************/
function mjh_mailtrap($phpmailer){
    //check if it is using the default welcome email subject line
    if( strpos($phpmailer->Subject, 'Password Changed') ){
        //remove all the recipients
        $phpmailer->ClearAllRecipients();
    }
}
add_action('phpmailer_init', 'mjh_mailtrap');

/* Custom Wordpress Welcome Email
********************************************************/
function mjh_registration_welcome_email( $user_id ) {
	global $wpdb, $wp_hasher;
	//$title = wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES );
    $user    = get_userdata( $user_id );
    $email   = $user->user_email;
    $first_name   = $user->first_name;
    // Generate something random for a key...
	$key = wp_generate_password(20, false);
	/** This action is documented in wp-login.php */
    do_action( 'retrieve_password_key', $user->user_login, $key );
	$hash_key = wp_hash_password($key);
	// Now insert the key, hashed, into the DB.
    if ( empty( $wp_hasher ) ) {
        require_once ABSPATH . WPINC . '/class-phpass.php';
        $wp_hasher = new PasswordHash( 8, true );
    }
    $hashed = time() . ':' . $wp_hasher->HashPassword( $key );
    $wpdb->update( $wpdb->users, array( 'user_activation_key' => $hashed ), array( 'user_login' => $user->user_login ) );
	//$wpdb->update($wpdb->users, array('user_activation_key' => time() . ':' . $hash_key), array('user_login' => $user->user_login));
	$regurl = wp_login_url()."?action=rp&key=".$key."&login=".$user->user_nicename;

	$subject = __("Welcome to New York’s Holocaust Curriculum Online Community","sage");
	$message = __("Dear","sage")." ".$first_name.",\n\n";
	$message .= __("Thank you for your interest in New York’s Holocaust Curriculum. We welcome you to our online community and hope that you find the lesson plans and resources helpful in teaching new generations about the Holocaust.","sage")."\n\n";
	$message .= __("Your username is the same as your email address, please use it to log in to the site.","sage")."\r\n\r\n";
	$message .= __("To set your password, please visit","sage")." ".$regurl."\r\n\r\n";
	$message .= __("If you have questions or encounter difficulties, please contact outreach@mjhnyc.org","sage")."\r\n\r\n";
	$message .= __("Museum of Jewish Heritage – A Living Memorial to the Holocaust","sage")."\n";
	$message .= __("Edmond J. Safra Plaza","sage")."\n";
	$message .= __("36 Battery Place","sage")."\n";
	$message .= __("New York, NY 10280","sage");

    wp_mail( $email, $subject, $message );

}
add_action('user_register', 'mjh_registration_welcome_email', 20, 1 );

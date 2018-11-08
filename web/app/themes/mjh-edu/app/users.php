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
	}
	if ( !empty( $_POST['acf']['field_5bdb7385658db']) ) {
		$user_fields['user_login'] = sanitize_user( $_POST['acf']['field_5bdb7385658db'] );
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
 * Send verification email for new users
 *
 * @hook add_action user_register
 * @return null
 */
function users_registration_email( $user_id ) {
	if(!empty($user_id) && !empty($_POST['register']) ) {
		wp_new_user_notification( $user_id, null, 'user' );
	}
}
add_action( 'user_register', 'users_registration_email', 20, 1 );

/**
 * Custom validation of user registration form
 *
 * @hook acf/validate_save_post
 * @return null
 */
function users_validate_save_post() {
	if(!empty($_POST['_acf_post_id']) && $_POST['_acf_post_id']=='new_user'){
		// User Email
		if(!empty($_POST['acf']['field_5bda42a5b3269'])){
			if(email_exists( $_POST['acf']['field_5bda42a5b3269'] ) ) {
				acf_add_validation_error( 'acf[field_5bda42a5b3269]', __('This Email Address is already registered with us, try again','sage') );
			}
		}
		// User Login
		if(!empty($_POST['acf']['field_5bdb7385658db'])){
			if(username_exists( $_POST['acf']['field_5bdb7385658db'] ) ){
				acf_add_validation_error( 'acf[field_5bdb7385658db]', __('This User Name is already registered with us, try again','sage') );
			}
		}
	}
}
add_action('acf/validate_save_post', 'users_validate_save_post', 10, 0);

/**
 * Redirection of the default login page
 *
 * @hook init
 * @return null
 */
function users_redirect_login_page() {
	$login_page  = home_url('/login/');
	$page_viewed = basename($_SERVER['REQUEST_URI']);

	if($page_viewed == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET') {
		wp_redirect($login_page);
		exit;
	}
}
add_action('init','users_redirect_login_page');

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
 * Redirection if login fields empty
 *
 * @hook authenticate
 * @return null
 */
/* Where to go if any of the fields were empty */
function users_verify_user_pass($user, $username, $password) {
	$login_page  = home_url('/login/');
	if($username == "" || $password == "") {
		wp_redirect($login_page . "?login=empty");
		exit;
	}
}
add_filter('authenticate', 'users_verify_user_pass', 1, 3);

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
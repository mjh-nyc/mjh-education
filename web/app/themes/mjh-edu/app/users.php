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
 */
function users_acf_load_value_username( $value, $post_id, $field )
{
	if(is_user_logged_in() ) {
		$current_user = wp_get_current_user();
		return $current_user->user_login;
	}
}
add_filter('acf/load_value/key=field_5bdb7385658db', 'users_acf_load_value_username', 10, 3);

/**
 * Disable field user name for user edit
 *
 * @hook acf/load_field/<field-key>
 * @return array
 */
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
	if(!empty($_POST['_acf_post_id']) && $_POST['_acf_post_id']=='new_user') {
		// User Email
		if (!empty($_POST['acf']['field_5bda42a5b3269'])) {
			if (email_exists($_POST['acf']['field_5bda42a5b3269'])) {
				acf_add_validation_error('acf[field_5bda42a5b3269]', __('This email address is already registered, try again.', 'sage'));
			}
		}
		// User Login
		if (!empty($_POST['acf']['field_5bdb7385658db'])) {
			if (username_exists($_POST['acf']['field_5bdb7385658db'])) {
				acf_add_validation_error('acf[field_5bdb7385658db]', __('This username is already registered, please try a different username.', 'sage'));
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
				acf_add_validation_error('acf[field_5bda42a5b3269]', __('This Email Address is already registered with us, try again', 'sage'));
			}
		}
		//Password Change
		if (!empty($_POST['acf']['field_5bea1be6be692'])) {
			if (!empty($_POST['acf']['field_5bea24624ccf8']) && !empty($_POST['acf']['field_5bea1c105b2f5']) && !empty($_POST['acf']['field_5bea1c37a09d5'])) {
				if ( wp_check_password( $_POST['acf']['field_5bea24624ccf8'], $user->data->user_pass, $user->ID) ){
					if($_POST['acf']['field_5bea1c105b2f5'] != $_POST['acf']['field_5bea1c37a09d5'] ){
						acf_add_validation_error( 'acf[field_5bea1c105b2f5]', __('New and confirm password does not match, try again','sage') );
					}
				}else{
					acf_add_validation_error( 'acf[field_5bea24624ccf8]', __('Current password does not match, try again','sage') );
				}
			} else {
				acf_add_validation_error('acf[field_5bea1be6be692]', __('Please fill out all password fields and try again', 'sage'));
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
	delete_field('field_5bdb7385658db',$post_id);
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
	return '<div class="users-register"><a href="'.get_home_url().'/register">'.__("Register","sage").'</a></div>';
}
add_filter('login_form_bottom','users_login_form_bottom');
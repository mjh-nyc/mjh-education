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
		$user_fields['user_login'] = $user_fields['user_email'] = sanitize_email( $_POST['acf']['field_5bda42a5b3269'] );
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
		if(!empty($_POST['acf']['field_5bda42a5b3269'])){
			if(email_exists( $_POST['acf']['field_5bda42a5b3269'] ) || username_exists( $_POST['acf']['field_5bda42a5b3269'] ) ){
				acf_add_validation_error( 'acf[field_5bda42a5b3269]', __('This email address is already registered with us, try again','sage') );
			}
		}

	}
}
add_action('acf/validate_save_post', 'users_validate_save_post', 10, 0);
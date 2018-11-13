<?php

namespace App\Controllers;

use Sober\Controller\Controller;
use WP_Query;

class TemplateProfile extends Controller
{
	/**
	 * Constructor
	 *
	 * @return none
	 */
	public function TemplateProfile()
	{
		// Logged in users should not see this page
		if(!is_user_logged_in() ){
			wp_redirect( home_url().'/login' );
			exit;
		}

		// Register the acf form group fields to be used for registration
		acf_register_form(array(
			'id'		=> 'edit-user',
			'post_id'	=> 'user_'.get_current_user_id(),
			'field_groups'=>array('group_5bda592161422','group_5bea1bcb1201a','group_5bd1f1e25075b'),
			'submit_value' => __("Submit", 'acf'),
			'updated_message' => ''
		));
	}
	/**
	 * Check if form is validated
	 *
	 * @return boolean
	 */
	public function updated(){
		if(!empty($_REQUEST['updated'])){
			return true;
		}else{
			return false;
		}
	}
}
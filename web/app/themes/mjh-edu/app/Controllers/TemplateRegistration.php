<?php

namespace App\Controllers;

use Sober\Controller\Controller;
use WP_Query;

class TemplateRegistration extends Controller
{
	/**
	 * Constructor
	 *
	 * @return none
	 */
	public function TemplateRegistration()
	{
		// Logged in users should not see this page
		App::verifyUserLoggedOut();

		// Register the acf form group fields to be used for registration
		acf_register_form(array(
			'id'		=> 'new-user',
			'post_id'	=> 'new_user',
			'field_groups'=>array('group_5bda592161422','group_5bd1f1e25075b'),
			'submit_value' => __("Register", 'acf'),
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
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
			'updated_message' => '',
			'return' => '?updated=true&id=%post_id%',
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

	/**
	 * Check if user registered date is less than a minute in future, called after registration
	 *
	 * @return boolean
	 */
	public function recentUserRegisterTime(){
		if(!empty($_REQUEST['id'])){
			//Remove `user_` and set id
			$id = (int)substr($_REQUEST['id'], 5);
			// Get dates and check recent registration
			$udata = get_userdata( $id );
			if(!empty($udata)) {
				$registered = strtotime($udata->user_registered);
				$minute_check = strtotime('- 1 minute');
				if ($registered > $minute_check) {
					return true;
				}
			}
		}
		return false;
	}

}
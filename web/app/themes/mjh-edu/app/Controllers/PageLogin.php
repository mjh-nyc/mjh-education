<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class PageLogin extends Controller
{
	/**
	 * Get redirect
	 *
	 * @return array
	 */
	public function redirect(){
		$redirect = get_home_url();
		if(!empty($_REQUEST['redirect_to'])){
			$redirect =urldecode($_REQUEST['redirect_to']);
		}
		return $redirect;
	}


	/**
	 * Get redirect
	 *
	 * @return string
	 */
	public function fail_message(){
		$fail_message = "";
		if ($_GET["login"] == "failed") {
			$fail_message = '<div class="alert alert-danger" role="alert">';
			$fail_message .=__("The email address and password combination you entered does not match our records for this account, please try again.","sage");
			$fail_message .='</div>';
		}
		return $fail_message;
	}
}

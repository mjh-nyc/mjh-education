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
}

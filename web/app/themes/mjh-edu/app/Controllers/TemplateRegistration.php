<?php

namespace App\Controllers;

use Sober\Controller\Controller;
use WP_Query;

class TemplateRegistration extends Controller
{
	var $testimonies;

	public function TemplateRegistration()
	{
		acf_register_form(array(
			'id'		=> 'new-user',
			'post_id'	=> 'new_user',
			'field_groups'=>array('group_5bd1f1e25075b'),
			'submit_value' => __("Submit", 'acf')
		));
	}

}
<?php

/**
 * Config file for form validation
 * http://www.codeigniter.com/user_guide/libraries/form_validation.html (Under section "Creating Sets of Rules")
 */

$config = array(

	// Example:
	'auth/login' => array(
		array(
			'field'		=> 'email',
			'label'		=> 'Email',
			'rules'		=> 'required|valid_email',
		),
		array(
			'field'		=> 'password',
			'label'		=> 'Password',
			'rules'		=> 'required',
		),
	),
	'auth/forgot_password' => array(
		array(
			'field'		=> 'email',
			'label'		=> 'Email',
			'rules'		=> 'required|valid_email',
		),
	),
		'contacta/comm' => array(
		array(
			'field'		=> 'name',
			'label'		=> 'Name',
			'rules'		=> 'required',
		),
		array(
			'field'		=> 'email',
			'label'		=> 'Email',
			'rules'		=> 'required|valid_email',
		),
		array(
			'field'		=> 'comments',
			'label'		=> 'Comment',
			'rules'		=> 'required',
		),
	),
);

/**
 * Google reCAPTCHA settings
 * https://www.google.com/recaptcha/
 */
$config['recaptcha'] = array(
	'site_key'		=> '',
	'secret_key'	=> '',
);

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| CI Bootstrap 3 Configuration
| -------------------------------------------------------------------------
| This file lets you define default values to be passed into views
| when calling MY_Controller's render() function.
|
| See example and detailed explanation from:
| 	/application/config/ci_bootstrap_example.php
*/

$config['ci_bootstrap'] = array(

	// Site name
	'site_name' => 'PT. Darma Food Indonesia',

	// Default page title prefix
	'page_title_prefix' => '',

	// Default page title
	'page_title' => '',

	// Default meta data
	'meta_data'	=> array(
		'author'		=> '',
		'description'	=> '',
		'keywords'		=> ''
	),

	// Default scripts to embed at page head or end
	'scripts' => array(
		'head'	=> array(
		),
		'foot'	=> array(
			'assets/dist/frontend/lib.min.js',
			'assets/dist/frontend/app.min.js'
		),
	),

	// Default stylesheets to embed at page head
	'stylesheets' => array(
		'screen' => array(
			'assets/dist/admin/adminlte.min.css',
			'assets/dist/frontend/lib.min.css',
			'assets/dist/frontend/app.min.css'
		)
	),

	// Default CSS class for <body> tag
	'body_class' => '',

	// Multilingual settings
	'languages' => array(
		// 'default'		=> 'en',
		// 'autoload'		=> array('general'),
		// 'available'		=> array(
		// 	'en' => array(
		// 		'label'	=> 'English',
		// 		'value'	=> 'english'
		// 	),
		// 	'zh' => array(
		// 		'label'	=> '繁體中文',
		// 		'value'	=> 'traditional-chinese'
		// 	),
		// 	'cn' => array(
		// 		'label'	=> '简体中文',
		// 		'value'	=> 'simplified-chinese'
		// 	),
		// 	'es' => array(
		// 		'label'	=> 'Español',
		// 		'value' => 'spanish'
		// 	),
		// 	'id' => array(
		// 		'label'	=> 'Indonesia',
		// 		'value'	=> 'indonesian'
		// 	),
		// )
	),

	// Google Analytics User ID
	'ga_id' => '',

	// Menu items
	'menu' => array(
		'home' => array(
      'name'    => 'Home',
      'url'   => '',
      'children'  => array(
				// 'About Us'		=> 'about_us',
				'Recruitment'			=> 'recruitment',
				'Contact'		=> 'contact',
			)
    ),
	),

	// Login page
	'login_url' => 'auth/login',

	// Restricted pages
	'page_auth' => array(
		'account'					=> array('members'),
	),

	// Email config
	'email' => array(
		'from_email'		=> '',
		'from_name'			=> '',
		'subject_prefix'	=> '',

		// Mailgun HTTP API
		'mailgun_api'		=> array(
			'domain'			=> '',
			'private_api_key'	=> ''
		),
	),

	// Debug tools
	'debug' => array(
		'view_data'	=> FALSE,
		'profiler'	=> FALSE
	),
);

/*
| -------------------------------------------------------------------------
| Override values from /application/config/config.php
| -------------------------------------------------------------------------
*/
$config['sess_cookie_name'] = 'ci_session_frontend';

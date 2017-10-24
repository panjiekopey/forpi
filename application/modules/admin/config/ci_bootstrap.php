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
	//'site_name' => 'Bank BRI',

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
			'assets/dist/admin/adminlte.min.js',
			'assets/dist/admin/lib.min.js',
			'assets/dist/admin/app.min.js'
		),
		'foot'	=> array(
		),
	),

	// Default stylesheets to embed at page head
	'stylesheets' => array(
		'screen' => array(
			'assets/dist/admin/adminlte.min.css',
			'assets/dist/admin/lib.min.css',
			'assets/dist/admin/app.min.css'
		)
	),

	// Default CSS class for <body> tag
	'body_class' => '',

	// Multilingual settings
	'languages' => array(
	),

	// Menu items
	'menu' => array(
		/*'nasabah' => array(
			'name'		=> 'Nasabah',
			'url'		=> 'nasabah',
			'icon'		=> 'fa fa-users',
    ),
		'rekening' => array(
			'name'		=> 'Rekening',
			'url'		=> 'rekening',
			'icon'		=> 'fa fa-list',
    ),*/

		'home' => array(
			'name'		=> 'Home',
			'url'		=> '',
			'icon'		=> 'fa fa-home',
		),
		'user' => array(
			'name'		=> 'Users',
			'url'		=> 'user',
			'icon'		=> 'fa fa-users',
			'children'  => array(
				'List'			=> 'user',
				'Create'		=> 'user/create',
				'User Groups'	=> 'user/group',
			)
		),
		/*'pelanggan' => array(
			'name'		=> 'Pelanggan',
			'url'		=> 'pelanggan',
			'icon'		=> 'fa fa-users',
		),*/
		'karyawan' => array(
			'name'		=> 'Karyawan',
			'url'		=> 'karyawan/lists',
			'icon'		=> 'fa fa-users',
    ),
    'departemen' => array(
        'name' => 'Depatremen',
        'url' => 'departemen',
        'icon' => 'fa fa-list',
    ),
    'jabatan' => array(
        'name' => 'Jabatan',
        'url' => 'jabatan',
        'icon' => 'fa fa-list',
    ),
			'absensi' => array(
			'name'		=> 'Absensi',
			'url'		=> 'absensi/view',
			'icon'		=> 'fa fa-calendar',
		),
			'lembur' => array(
			'name'		=> 'Lembur',
			'url'		=> 'lembur/view',
			'icon'		=> 'fa fa-moon-o',
		),
		/*'pemesanan' => array(
			'name'		=> 'Pemesanan',
			'url'		=> 'pemesanan/view',
			'icon'		=> 'fa fa-bars',
			'children'  => array(
				//'Buat Pesanan Baru'			=> 'pemesanan/index/add',
				'Pesanan Berjalan'			=> 'pemesanan/view',
				//'Tambah Pesanan'			=> 'pemesanan/index/add',
				'Pesanan Selesai'		=> 'pemesanan/vpl',
				)
		),
		'produksi' => array(
			'name'		=> 'Produksi',
			'url'		=> 'produksi/view',
			'icon'		=> 'fa fa-gears',
			'children'  => array(
				'Produksi Berjalan'			=> 'produksi/view',
				'Laporan Produksi'		=> 'produksi/lproduksi',
				)
		),*/
		'gaji' => array(
			'name'		=> 'Gaji',
			'url'		=> 'gaji',
			'icon'		=> 'fa fa-money',
		),
		'panel' => array(
			'name'		=> 'Admin Panel',
			'url'		=> 'panel',
			'icon'		=> 'fa fa-user-secret',
			'children'  => array(
				'Admin Users'			=> 'panel/admin_user',
				'Create Admin User'		=> 'panel/admin_user_create',
				'Admin User Groups'		=> 'panel/admin_user_group',
			)
		),
		'user' => array(
			'name'		=> 'User',
			'url'		=> 'user',
			'icon'		=> 'fa fa-users',
			'children'  => array(
				'Users'			=> 'user',
				//'User Groups'		=> 'user/group',
			)
		),
		'util' => array(
			'name'		=> 'Utilities',
			'url'		=> 'util',
			'icon'		=> 'fa fa-cogs',
			'children'  => array(
				'Database Versions'		=> 'util/list_db',
			)
		),
		// 'help' => array(
		// 	'name'		=> 'Bantuan',
		// 	'url'		=> 'help',
		// 	'icon'		=> 'fa fa-question',
		// ),
		'setting' => array(
			'name'		=> 'Setting',
			'url'		=> 'setting/editc/edit/1',
			'icon'		=> 'fa fa-gears',
		),
		// 	'logout' => array(
		// 	'name'		=> 'Sign Out',
		// 	'url'		=> 'panel/logout',
		// 	'icon'		=> 'fa fa-sign-out',
		// )
	),

	// Login page
	'login_url' => 'admin/login',

	// Restricted pages
	'page_auth' => array(
		'user/create'				=> array('webmaster', 'admin'),
		'user/group'				=> array('webmaster', 'admin'),
		'panel'						=> array('webmaster'),
		'panel/admin_user'			=> array('webmaster'),
		'panel/admin_user_create'	=> array('webmaster'),
		'panel/admin_user_group'	=> array('webmaster'),
		'util'						=> array('webmaster'),
		'util/list_db'				=> array('webmaster'),
		'util/backup_db'			=> array('webmaster'),
		'util/restore_db'			=> array('webmaster'),
		'util/remove_db'			=> array('webmaster'),
		'karyawan'			=> array('webmaster','admin'),
		'karyawan/lists'			=> array('webmaster', 'admin'),
		'absensi'			=> array('webmaster', 'admin'),
		'absensi/view'			=> array('webmaster', 'admin'),
		'lembur/view'			=> array('webmaster', 'admin'),
		'gaji'			=> array('webmaster'),
	),

	// AdminLTE settings
	'adminlte' => array(
		'body_class' => array(
			'webmaster'	=> 'skin-blue-light',
			'admin'		=> 'skin-purple',
			'manager'	=> 'skin-black',
			'staff'		=> 'skin-blue',
		)
	),

	// Useful links to display at bottom of sidemenu
	'useful_links' => array(
		/*
		array(
			'auth'		=> array('webmaster', 'admin', 'manager', 'staff'),
			'name'		=> 'Frontend Website',
			'url'		=> '',
			'target'	=> '_blank',
			'color'		=> 'text-aqua'
		),
		array(
			'auth'		=> array('webmaster', 'admin'),
			'name'		=> 'API Site',
			'url'		=> 'api',
			'target'	=> '_blank',
			'color'		=> 'text-orange'
		),

		array(
			'auth'		=> array('webmaster', 'admin', 'manager', 'staff'),
			'name'		=> 'CI_BOOTSTRAP_3',
			'url'		=> CI_BOOTSTRAP_REPO,
			'target'	=> '_blank',
			'color'		=> 'text-green'
		),*/
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
$config['sess_cookie_name'] = 'ci_session_admin';

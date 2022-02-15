<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['login'] = 'Login';
$route['login/process'] = 'Login/process';
$route['logout'] = 'Login/logout';

// Admin
$route['admin/dashboard'] 		= 'Dashboard';
$route['admin/category-items'] 	= 'Admin/Category';
$route['admin/items'] 			= 'Admin/Items';
$route['admin/santri'] 			= 'Admin/Santri';
$route['admin/parrents'] 		= 'Admin/Parrents';
$route['admin/attendances']		= 'Admin/Attendances';
$route['admin/report-attendances']		= 'Admin/Attendances/report';
$route['admin/sub-item/(:any)'] = 'Admin/Subitem/index/$1';

// Kasir
$route['kasir/dashboard'] 		= 'Dashboard';
$route['kasir/category-items'] 	= 'Admin/Category';
$route['kasir/items'] 			= 'Admin/Items';
$route['kasir/sub-item/(:any)'] = 'Admin/Subitem/index/$1';
$route['kasir/transaction']		= 'Kasir/Transaction';
$route['kasir/transaction/list']	= 'Kasir/Transaction/list_transaksi';

// Category
$route['category-items/store'] 	= 'Admin/Category/store';
$route['category-items/create'] = 'Admin/Category/create';
$route['category-items/update'] = 'Admin/Category/update';
$route['category-items/delete'] = 'Admin/Category/delete';

// Items
$route['items/store'] = 'Admin/Items/store';
$route['items/create'] = 'Admin/Items/create';
$route['items/update'] = 'Admin/Items/update';
$route['items/delete'] = 'Admin/Items/delete';

// Sub Items
$route['sub-item/store'] = 'Admin/Subitem/store';
$route['sub-item/create'] = 'Admin/Subitem/create';
$route['sub-item/update'] = 'Admin/Subitem/update';
$route['sub-item/delete'] = 'Admin/Subitem/delete';
$route['sub-item/getAll'] = 'Admin/Subitem/getAll';

// Santri
$route['santri/get']	= 'Admin/Santri/get';
$route['santri/store']	= 'Admin/Santri/store';
$route['santri/create'] = 'Admin/Santri/create';
$route['santri/update'] = 'Admin/Santri/update';
$route['santri/delete'] = 'Admin/Santri/delete';

// Parrent
$route['parrents/get']	= 'Admin/Parrents/get';
$route['parrents/store']	= 'Admin/Parrents/store';
$route['parrents/create'] = 'Admin/Parrents/create';
$route['parrents/update'] = 'Admin/Parrents/update';
$route['parrents/delete'] = 'Admin/Parrents/delete';

// Attendances
$route['attendances/store'] = 'Admin/Attendances/store';
$route['report-attendances/get'] = 'Admin/Attendances/getreport';

// Transaction
$route['transaction/create'] = 'Kasir/Transaction/create';
$route['transaction/store'] = 'Kasir/Transaction/store';

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

/*Costum Routes*/
$route['home'] = 'home/home_page';
$route['login'] = 'user/login';
$route['logout'] = 'user/logout';
$route['lock_user'] = 'user/lock_user';
$route['admin'] = 'admin/dashboard';
$route['admin/dashboard/dashboard/(.*)'] = 'admin/dashboard/$1';
$route['admin/upload_file'] = 'admin/dashboard/upload_file';
$route['admin/html_request'] = 'admin/dashboard/html_request';
$route['admin/data_content'] = 'admin/dashboard/data_content';
$route['admin/pusat_unggahan'] = 'admin/dashboard/pusat_unggahan';
$route['admin/action/(:any)'] = 'admin/dashboard/action/$1';
$route['admin/configuration/action/(:any)'] = 'admin/dashboard/action/$1';
$route['admin/action/(:any)'] = 'admin/dashboard/action/$1';
$route['admin/pengolahan_database'] = 'admin/dashboard/pengolahan_database';
$route['admin/backup_database'] = 'admin/dashboard/backup_database';
$route['admin/list_table_db'] = 'admin/dashboard/list_table_db';
$route['admin/backup_db_file'] = 'admin/dashboard/backup_db_file';
$route['admin/menu_list'] = 'admin/dashboard/menu_list';
$route['admin/pengaturan'] = 'admin/dashboard/pengaturan';
$route['admin/feedback'] = 'admin/dashboard/feedback';
$route['admin/about'] = 'admin/dashboard/about';

$route['profil_pt'] = 'home/profil_pt';
$route['pusat_unduhan'] = 'home/pusat_unduhan';
$route['feedback'] = 'home/feedback';
$route['about'] = 'home/about';

$route['error_403'] = 'page_error/error_403';
$route['default_controller'] = 'home';
$route['404_override'] = 'page_error';
$route['translate_uri_dashes'] = FALSE;

<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
| 	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['scaffolding_trigger'] = 'scaffolding';
|
| This route lets you set a "secret" word that will trigger the
| scaffolding feature for added security. Note: Scaffolding must be
| enabled in the controller in which you intend to use it.   The reserved 
| routes must come before any wildcard or regular expression routes.
|
*/

$route['default_controller'] = "main";
$route['scaffolding_trigger'] = "";

$route['task_add'] = "main/task_add";
$route['task_edit/(:any)'] = "main/task_edit/$1";
$route['task/(:any)'] = "main/task/$1";
$route['task_del/(:any)'] = "main/task_del/$1";
$route['task_close/(:any)'] = "main/task_close/$1";
$route['task_open/(:any)'] = "main/task_open/$1";
$route['user/(:any)'] = "main/user/$1";
$route['task'] = "main";
$route['user_list'] = "main/user_list";
$route['user_add'] = "main/user_add";
$route['user_del/(:num)'] = "main/user_del/$1";
$route['user_edit/(:num)'] = "main/user_edit/$1";
$route['stat'] = "main/stat";
$route['logout'] = "main/logout";

/* End of file routes.php */
/* Location: ./system/application/config/routes.php */
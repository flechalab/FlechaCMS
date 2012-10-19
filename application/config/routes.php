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
| enabled in the controller in which you intend to use it.
|
| The reserved routes must come before any wildcard or regular expression routes.
|
*/

$route['default_controller']                 = "site";
$route['scaffolding_trigger']                = "";

// main
$route['admin']                              = "admin/admin";
// ajax
$route['admin/(:any)/ajax/(:any)']           = "admin/$1/ajax/$2";

// form to edit divs
$route['admin/pages/(:num)/divs']            = "admin/divs";
$route['admin/pages/(:num)/divs/(:any)/del'] = "admin/divs/del/$2/$1";
$route['admin/pages/(:num)/divs/(:any)']     = "admin/divs/setUp/$2/$1";

// login options
$route['admin/login']                        = "admin/admin/login";
$route['admin/logon']                        = "admin/admin/logon";
$route['admin/logout']                       = "admin/admin/logout";

// del pages
$route['admin/(:any)/del/(:num)']            = "admin/$1/del/$2";
$route['admin/(:any)/(:num)']                = "admin/$1/setUp/$2";
$route['admin/(:any)']                       = "admin/$1";
$route['(:any)']                             = "site/$1";

/*
// pages
$route['site/admin/pages']              = "admin/pages";
$route['site/admin/pages/new']          = "admin/pages/set/new";
$route['site/admin/pages/(:num)']       = "admin/pages/set/$1";
$route['site/admin/pages/set/new']      = "admin/pages/set/new";
$route['site/admin/pages/set/(:num)']   = "admin/pages/set/$1";
$route['site/admin/pages/del/(:num)']   = "admin/pages/del/$1";

//divs
$route['site/admin/pages/(:num)/divs']             = "admin/divs";
$route['site/admin/pages/(:num)/divs/new']         = "admin/divs/set/new";
$route['site/admin/pages/(:num)/divs/(:num)']      = "admin/divs/set/$2";
$route['site/admin/pages/(:num)/divs/del/(:num)']  = "admin/divs/del/$2/$1";

// users
$route['site/admin/users']              = "admin/users";
$route['site/admin/users/new']          = "admin/users/set/new";
$route['site/admin/users/(:num)']       = "admin/users/set/$1";
$route['site/admin/users/set/new']      = "admin/users/set/new";
$route['site/admin/users/set/(:num)']   = "admin/users/set/$1";
$route['site/admin/users/del/(:num)']   = "admin/users/del/$1";

// config
$route['site/admin/config']              = "admin/config";
$route['site/admin/config/new']          = "admin/config/set/new";
$route['site/admin/config/(:any)']       = "admin/config/set/$1";
$route['site/admin/config/set/new']      = "admin/config/set/new";
$route['site/admin/config/set/(:num)']   = "admin/config/set/$1";
*/

/* End of file routes.php */
/* Location: ./system/application/config/routes.php */
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


$route['default_controller'] = 'home';
$route['404_override'] = 'Error/NotFound';
$route['translate_uri_dashes'] = FALSE;

//Contact Page
$route['contact'] = "Contact/index";

// Internal Routes
$route['page/(:any)'] = "Internal/getInternal/$1";
// Internal Routes End

// Commercial Routes
$route['category/(:any)'] = "Commerce/getCategory/$1";
$route['product/(:any)'] = "Commerce/getProduct/$1";
$route['brand/(:any)'] = "Commerce/getBrand/$1";

// Industrial Routes
$route['industrial/subcat/(:any)'] = "Industrial/getIndSubCategory/$1";
$route['industrial/company/(:any)'] = "Industrial/getIndustrial/$1";

// Blog Routes
$route['blog'] = "Blog/getBlog";
$route['blog/category/(:any)'] = "Blog/getBlogCategory/$1";
$route['blog/post/(:any)'] = "Blog/getPost/$1";

// Cart routes
$route['addToCart'] = "Cart/addToCart";
$route['addOneProd'] = "Cart/addOneProd";
$route['minusOneProd'] = "Cart/minusOneProd";
$route['deleteCartProd'] = "Cart/deleteCartProd";
$route['myCart'] = "Cart/getCart";
$route['cartProceed'] = "Cart/cartProceed";
$route['confirmData'] = "Cart/confirmData";
$route['confirmBuy'] = "Cart/confirmBuy";
$route['checkPromoCodeNfo'] = "cart/checkPromoCodeNfo";

// User Lists
$route['getListData'] = "Cart/getListData";
$route['deleteList'] = "Cart/deleteList";
$route['addListToCart'] = "Cart/addListToCart";
$route['newList'] = "Cart/newList";
$route['listFeedback'] = "Cart/listFeedback";
$route['getMyLists'] = "Cart/getMyLists";
$route['addProdList'] = "Cart/addProdList";

// Forum Routes
$route['foro'] = "Forum/getForum";
$route['foro/category/(:any)'] = "Forum/getForumCategory/$1";
$route['foro/topic/(:any)'] = "Forum/getForumTopic/$1";

// RRHH Routes
$route['rrhh'] = "Rrhh/viewRrhhHome";
$route['rrhh/candidate'] = "Rrhh/uploadCV";
$route['rrhh/directory'] = "Rrhh/viewDirectory";
$route['rrhh/directory/(:any)'] = "Rrhh/getCategory/$1";
$route['rrhh/directory/candidate/(:any)'] = "Rrhh/getCandidate/$1";
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
$route['default_controller']   = 'Book_ctrl/show_books';
$route['404_override']         = '';
$route['book']                 = 'Book_ctrl/show_books';
$route['book/search']          = 'Book_ctrl/show_books';
$route['book/signup']          = 'Account_ctrl/signup';
$route['book/signup_user']     = 'Account_ctrl/signup_user';
$route['book/login']           = 'Account_ctrl/index';
$route['book/login_user']      = 'Account_ctrl/login_user';
$route['book/add_book']        = 'Book_ctrl/add_book_page';
$route['book/add_book_item']   = 'Book_ctrl/add_book_item';
$route['book/logout']          = 'Account_ctrl/logout';
$route['book/show_books']      = 'Book_ctrl/show_books';
$route['book/search/(:any)']   = 'Book_ctrl/search_book/$1';
$route['book/srch_sugg']       = 'Book_ctrl/srch_sugg';
$route['book/edit/(\d+)/(\d+)']      = 'Book_ctrl/edit/$1/$1';
$route['book/edit_book/(\d+)/(\d+)'] = 'Book_ctrl/edit_book/$1/$1';
$route['book/delete/(\d+)/(\d+)']    = 'Book_ctrl/delete_book/$1/$1';
$route['translate_uri_dashes'] = FALSE;

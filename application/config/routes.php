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
$route['default_controller'] = 'index';
$route['404_override'] = 'error_404';
$route['translate_uri_dashes'] = TRUE;


/*
| -------------------------------------------------------------------------
| BACKEND MODULES ROUTES
| -------------------------------------------------------------------------
*/
// Default URL
$route['(\w{2})/backend'] = 'backend/auth/login';
$route['backend'] = 'backend/auth/login';

$route['(\w{2})/backend/(\w+)/(\w+)'] = 'backend/$2/$3';
$route['(\w{2})/backend/(\w+)/(\w+)/(.+)'] = 'backend/$2/$3/$4';
$route['backend/(\w+)/(\w+)'] = 'backend/$1/$2';
$route['backend/(\w+)/(\w+)/(.+)'] = 'backend/$1/$2/$3';


/*
| -------------------------------------------------------------------------
| API MODULES ROUTES
| -------------------------------------------------------------------------
*/
$route['(\w{2})/api/(\w+)/(\w+)'] = 'api/$2/$3';
$route['(\w{2})/api/(\w+)/(\w+)/(.+)'] = 'api/$2/$3/$4';
$route['(\w{2})/api/(\w+)/(\w+)/(\w+)/(.+)'] = 'api/$2/$3/$4/$5';
$route['api/(\w+)/(\w+)'] = 'api/$1/$2';
$route['api/(\w+)/(\w+)/(.+)'] = 'api/$1/$2/$3';
$route['api/(\w+)/(\w+)/(\w+)/(.+)'] = 'api/$1/$2/$3/$4';

/*
| -------------------------------------------------------------------------
| FRONTEND MODULES ROUTES
| -------------------------------------------------------------------------
*/
// Default URL
$route['(\w{2})'] = 'index';
$route['(\w{2})/home'] = 'index';

// Static URL for Home
$route['(\w{2})/home'] = 'frontend/home/home';
$route['home'] = 'frontend/home/home';

// Static URL for News
$route['(\w{2})/news'] = 'frontend/news/news';
$route['(\w{2})/news/(.+)'] = 'frontend/news/news/$2';
$route['(\w{2})/news/(.+)/(.+)'] = 'frontend/news/news/$2/$3';
$route['news'] = 'frontend/news/news';
$route['news/(.+)'] = 'frontend/news/news/$1';
$route['news/(.+)/(.+)'] = 'frontend/news/news/$1/$2';

// Static URL for Product
$route['(\w{2})/product'] = 'frontend/product/precast';
$route['(\w{2})/product/precast'] = 'frontend/product/precast';
$route['(\w{2})/product/precast/(.+)'] = 'frontend/product/precast/$2';
$route['(\w{2})/product/precast/(.+)/(.+)'] = 'frontend/product/precast/$2/$3';
$route['(\w{2})/product/prefab'] = 'frontend/product/prefab';
$route['(\w{2})/product/prefab/(.+)'] = 'frontend/product/prefab/$2';
$route['(\w{2})/product/prefab/(.+)/(.+)'] = 'frontend/product/prefab/$2/$3';
$route['product'] = 'frontend/product/precast';
$route['product/precast/(.+)'] = 'frontend/product/precast/$1';
$route['product/precast/(.+)/(.+)'] = 'frontend/product/precast/$1/$2';
$route['product/prefab/(.+)'] = 'frontend/product/prefab/$1';
$route['product/prefab/(.+)/(.+)'] = 'frontend/product/prefab/$1/$2';

// Static URL for Project
$route['(\w{2})/project'] = 'frontend/project/finish';
$route['(\w{2})/project/finish'] = 'frontend/project/finish';
$route['(\w{2})/project/finish/(.+)'] = 'frontend/project/finish/$2';
$route['(\w{2})/project/finish/(.+)/(.+)'] = 'frontend/project/finish/$2/$3';
$route['(\w{2})/project/current'] = 'frontend/project/current';
$route['(\w{2})/project/current/(.+)'] = 'frontend/project/current/$2';
$route['(\w{2})/project/current/(.+)/(.+)'] = 'frontend/project/current/$2/$3';
$route['project'] = 'frontend/project/finish';
$route['project/finish/(.+)'] = 'frontend/project/finish/$1';
$route['project/finish/(.+)/(.+)'] = 'frontend/project/finish/$1/$2';
$route['project/current/(.+)'] = 'frontend/project/current/$1';
$route['project/current/(.+)/(.+)'] = 'frontend/project/current/$1/$2';


// Static URL for About Us
$route['(\w{2})/about-us'] = 'frontend/about_us/about_us';
$route['(\w{2})/about-us/(.+)'] = 'frontend/about_us/about_us/$2';
$route['about-us'] = 'frontend/about_us/about_us';
$route['about-us/(.+)'] = 'frontend/about_us/about_us/$1';

// Static URL for Contact Us
$route['(\w{2})/contact-us'] = 'frontend/contact_us/contact_us';
$route['(\w{2})/contact-us/(.+)'] = 'frontend/contact_us/contact_us/$2';
$route['contact-us'] = 'frontend/contact_us/contact_us';
$route['contact-us/(.+)'] = 'frontend/contact_us/contact_us/$1';

// Static URL for Sitemap
$route['(\w{2})/sitemap'] = 'frontend/information/sitemap';
$route['(\w{2})/sitemap/(.+)'] = 'frontend/information/sitemap/$2';
$route['sitemap'] = 'frontend/information/sitemap';
$route['sitemap/(.+)'] = 'frontend/information/sitemap/$1';

// Dynamic URL
$route['(\w{2})/(.+)/(.+)'] = 'frontend/$2/$3';
$route['(\w{2})/(.+)/(.+)/(.+)'] = 'frontend/$2/$3/$4';
$route['(.+)/(.+)'] = 'frontend/$1/$2';
$route['(.+)/(.+)/(.+)'] = 'frontend/$1/$2/$3';
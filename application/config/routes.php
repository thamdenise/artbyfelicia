<?php
// test 005
defined('BASEPATH') or exit('No direct script access allowed');

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
|	https://codeigniter.com/userguide3/general/routing.html
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

//------------------common routes (no need auth for both admin and user)-----------------------
$route['default_controller'] = 'HomeController';
$route['courses'] = 'CoursesController/index';
$route['gallery'] = 'GalleryController/index';

//admin

$route['admin'] = 'admin/AdminController';
$route['admin/logout'] = 'admin/AdminController/logout';
$route['admin/blogs'] = 'admin/BlogPostController/index';
$route['admin/add-blog'] = 'admin/BlogPostController/addBlogPost';
$route['admin/delete-blog/(:any)/(:any)'] = 'admin/BlogPostController/deleteBlog/$1/$2';
$route['admin/edit-blog/(:any)'] = 'admin/BlogPostController/editBlogPost/$1';

$route['admin/gallery'] = 'admin/GalleryController/index';
$route['admin/add-image'] = 'admin/GalleryController/addImage';
$route['admin/edit-image/(:any)'] = 'admin/GalleryController/editImage/$1';
$route['admin/gallery-reorder'] = 'admin/GalleryController/reorderImages';
$route['admin/delete-image/(:any)'] = 'admin/GalleryController/deleteImage/$1';

$route['admin/courses'] = 'admin/CoursesController/index';
$route['admin/add-course'] = 'admin/CoursesController/addCourse';
$route['admin/delete-course/(:any)/(:any)'] = 'admin/CoursesController/deleteCourse/$1/$2';
$route['admin/edit-course/(:any)'] = 'admin/CoursesController/editCourse/$1';
$route['admin/courses-reorder'] = 'admin/CoursesController/reorderCourses';

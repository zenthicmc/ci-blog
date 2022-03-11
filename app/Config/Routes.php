<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Pages::index');
$routes->get('/search', 'Pages::search');
$routes->get('/view/(:any)', 'Pages::view/$1');
$routes->post('/contact/save', 'Pages::contactSave');

// auth routes
$routes->get('/auth/login', 'Auth::login');
$routes->post('/auth/login/check', 'Auth::loginCheck');

$routes->get('/auth/register', 'Auth::register');
$routes->post('/auth/register/check', 'Auth::registerCheck');


$routes->group('',['filter'=>'AuthFilter'], function($routes)
{
    // dashboard routes
    $routes->get('/dash', 'Dashboard::index');
    $routes->get('/dash/logout', 'Auth::logout');

    // articles routes
    $routes->get('/dash/articles', 'Articles::index');
    $routes->get('/dash/articles/new', 'Articles::new');
    $routes->post('/dash/articles/new/save', 'Articles::save');
    $routes->put('/dash/articles/edit/(:num)', 'Articles::edit/$1');
    $routes->put('/dash/articles/edit/save/(:num)', 'Articles::update/$1');
    $routes->delete('/dash/articles/delete/(:num)', 'Articles::delete/$1');

    // profile routes
    $routes->get('/dash/profile', 'Profile::index');
    $routes->post('/dash/profile/usersave', 'Profile::userSave');
    $routes->post('/dash/profile/passsave', 'Profile::passSave');
    $routes->post('/dash/profile/imagesave', 'Profile::imageSave');

    $routes->group('',['filter'=>'RoleFilter'], function($routes) {
        // admin routes
        $routes->get('/dash/admin/users', 'Admin::users');
        $routes->get('/dash/admin/users/new', 'Admin::newUsers');
        $routes->post('/dash/admin/users/new/save', 'Admin::saveUsers');
        $routes->put('/dash/admin/users/edit/(:num)', 'Admin::editUsers/$1');
        $routes->post('/dash/admin/users/edit/save/(:num)', 'Admin::saveEditUsers/$1');
        $routes->get('/dash/admin/articles', 'Admin::articles');
        $routes->get('/dash/admin/articles/new', 'Admin::newArticles');
        $routes->post('/dash/admin/articles/new/save', 'Admin::saveArticles');
        $routes->put('/dash/admin/articles/edit/(:num)', 'Admin::editArticles/$1');
        $routes->post('/dash/admin/articles/edit/save/(:num)', 'Admin::saveEditArticles/$1');
        $routes->get('/dash/admin/category', 'Admin::category');
        $routes->get('/dash/admin/category/new', 'Admin::newCategory');
        $routes->post('/dash/admin/category/new/save', 'Admin::saveCategory');
        $routes->put('/dash/admin/category/edit/(:num)', 'Admin::editCategory/$1');
        $routes->post('/dash/admin/category/edit/save/(:num)', 'Admin::saveEditCategory/$1');
        $routes->get('/dash/admin/contact', 'Admin::contact');
        $routes->put('/dash/admin/contact/view/(:num)', 'Admin::viewContact/$1');
        $routes->delete('/dash/admin/(:any)/delete/(:num)', 'Admin::delete/$1/$2');
    });
});


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

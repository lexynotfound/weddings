<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

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
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/admin', 'Admin::index',['filter' => 'role:admin']);
$routes->get('/custom/(:num)', 'Costume::showCustomPage/$1');
$routes->get('/custom/(:num)', 'Costume::showCustomPage/$1');

$routes->group('errors', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/error-page', 'Error::index');
});

$routes->group('home', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'Home::index');
    $routes->get('searchRiwayat', 'Home::searchRiwayat');
    $routes->get('searchBuku', 'Home::searchBuku');
    $routes->get('detail/(:num)', 'Home::detail/$1');
    $routes->get('detail/custom/(:num)', 'Home::custom/$1');
    $routes->get('error-page', 'Home::errorpage');
});

$routes->group('reservation', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'Reservation::index');
    $routes->post('store', 'Reservation::store');
});

$routes->group('admin', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/admin','Admin::index', ['filter' => 'role:admin']);
    $routes->get('tambahUserView', 'Admin::tambahUserView', ['filter' => 'role:admin']);
    $routes->get('detail/(:num)', 'Admin::detail/$1', ['filter' => 'role:admin']);
    $routes->get('detail_card/(:num)', 'Admin::detail/$1', ['filter' => 'role:admin']);
    $routes->get('download/(:num)', 'Admin::download/$1', ['filter' => 'role:admin']);
    $routes->post('tambahUser', 'Admin::tambahUser', ['filter' => 'role:admin']);
    $routes->get('edit/(:num)', 'Admin::edit/$1', ['filter' => 'role:admin']);
    $routes->get('editProfileViews', 'Admin::editProfileViews', ['filter' => 'role:admin']);
    $routes->post('editProfile', 'Admin::editProfile', ['filter' => 'role:admin']); // New delete route
    $routes->post('edit/(:num)', 'Admin::updateUser/$1', ['filter' => 'role:admin']); // New delete route
    $routes->get('delete/(:num)', 'Admin::delete/$1');
    $routes->get('data', 'Admin::data', ['filter' => 'role:admin']);
    $routes->get('register', 'Admin::register');
    $routes->get('profile', 'Admin::profile/$1');
    $routes->get('generatePDF/(:num)', 'Admin::generatePDF/$1', ['filter' => 'role:admin']);
});

$routes->group('produk', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'Product::index', ['filter' => 'role:admin']);
    $routes->get('create', 'Product::create', ['filter' => 'role:admin']);
    $routes->get('daftar_produk', 'Product::daftar', ['filter' => 'role:admin']);
    $routes->post('store', 'Product::store', ['filter' => 'role:admin']);
    $routes->get('detail/(:num)', 'Product::detail/$1');
    $routes->get('edit/(:num)', 'Product::edit/$1', ['filter' => 'role:admin']);
    $routes->post('update/(:num)', 'Product::update/$1');
    $routes->get('delete/(:num)', 'Product::delete/$1', ['filter' => 'role:admin']);
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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

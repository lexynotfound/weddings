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
    $routes->get('searc', 'Home::search');
    $routes->get('detail/(:num)', 'Home::detail/$1');
    $routes->post('save_review/(:num)', 'Home::save_review/$1');
    $routes->get('detail/custom/(:num)', 'Home::custom/$1');
    $routes->get('search', 'Home::search', ['as' => 'search']);
    $routes->post('save/(:num)', 'Home::save/$1');
    $routes->get('error-page', 'Home::errorpage');
});

$routes->group('category', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'Category::index');
    $routes->get('error-page', 'Home::errorpage');
});

$routes->group('best', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'Best::index');
    $routes->get('error-page', 'Home::errorpage');
});

$routes->group('reservation', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('index/(:num)', 'Reservation::index/$1');
    $routes->get('reservation/(:segment)', 'Reservation::reservation/$1');
    $routes->get('data','Reservation::data', ['filter' => 'role:admin']);
    $routes->post('buy/(:num)', 'Reservation::buy/$1');
    $routes->post('store', 'Reservation::store');
    $routes->get('error-page', 'Reservation::errorpage');
});

$routes->group('payment', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('full/(:num)', 'Payment::index/$1');
    $routes->get('dp/(:num)', 'Payment::dp/$1');
    $routes->post('buy/(:num)', 'Payment::buy/$1');
    $routes->post('paid/(:num)', 'Payment::paid/$1');
    $routes->get('error-page', 'Reservation::errorpage');
    $routes->get('invoice/(:segment)', 'Payment::invoice/$1');
    $routes->get('transaction', 'Payment::transaction', ['filter' => 'role:admin']);
});

$routes->group('invoice', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('full/(:num)', 'Invoice::index/$1');
    $routes->get('dp/(:num)', 'Invoice::dp/$1');
    $routes->post('buy/(:num)', 'Payment::buy/$1');
    $routes->get('error-page', 'Reservation::errorpage');
    $routes->get('invoice/(:any)', 'Payment::invoice/$1');
});

$routes->group('user', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'User::index');
    $routes->get('verify_email/(:segment)', 'User::verify_email/$1');
    $routes->post('update_profile', 'User::update_profile');
    // Rute untuk update nama
    $routes->post('update_name', 'User::update_name');

    // Rute untuk update email
    $routes->post('update_email', 'User::update_email');

    // Rute untuk update telepon
    $routes->post('update_telepon', 'User::update_telepon');

    // Rute untuk update foto
    $routes->post('update_foto', 'User::update_foto');

    // Rute untuk update lokasi
    $routes->post('update_lokasi', 'User::update_lokasi');

    // Rute untuk update jenis kelamin
    $routes->post('update_gender', 'User::update_gender');
    $routes->get('setting', 'User::setting');
});

$routes->group('review', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'Reviews::index');
    $routes->post('save_review/(:num)', 'Reviews::save_review/$1');
});

$routes->group('replies', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'Replies::index');
    $routes->post('save/(:num)', 'Replies::save/$1');
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
    $routes->get('index', 'Admin::showCalendar', ['filter' => 'role:admin']);
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
    $routes->post('update/(:num)','Product::update/$1', ['filter' => 'role:admin']);
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

<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('auth');
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
// $routes->get('/', 'Home::index');
$routes->group('/auth', static function ($routes) {
    $routes->get('/', 'Auth::index');
    $routes->post('login', 'Auth::login');
    $routes->get('logout', 'Auth::logout');
});

$routes->group('/admin', ['filter' => 'authFilter'], static function ($routes) {
    $routes->get('beranda', 'Admin\Beranda::index');
    $routes->get('kegiatan', 'Admin\kegiatan::index');
    $routes->group('komunitas', ['filter' => 'suFilter'], static function ($routes) {
        $routes->get('/', 'Admin\Komunitas::index');
        $routes->post('/', 'Admin\Komunitas::save');
        $routes->get('edit/(:num)', 'Admin\Komunitas::editPage/$1');
        $routes->put('edit/(:num)', 'Admin\Komunitas::update/$1');
        $routes->delete('(:num)', 'Admin\Komunitas::delete/$1');
    });

    $routes->group('jenisKerasulan', ['filter' => 'suFilter'], static function ($routes) {
        $routes->get('/', 'Admin\JenisKerasulan::index');
        $routes->get('edit/(:num)', 'Admin\JenisKerasulan::editPage/$1');
        $routes->put('edit/(:num)', 'Admin\JenisKerasulan::update/$1');
    });

    $routes->group('tahapPembinaan', ['filter' => 'suFilter'], static function ($routes) {
        $routes->get('/', 'Admin\TahapPembinaan::index');
        $routes->get('edit/(:num)', 'Admin\TahapPembinaan::editPage/$1');
        $routes->put('edit/(:num)', 'Admin\TahapPembinaan::update/$1');
    });

    $routes->group('anggota', static function ($routes) {
        $routes->get('(:num)', 'Admin\Anggota::index/$1');
        $routes->post('(:num)', 'Admin\Anggota::index/$1');
        $routes->get('edit/(:num)', 'Admin\TahapPembinaan::editPage/$1');
        $routes->put('edit/(:num)', 'Admin\TahapPembinaan::update/$1');
        $routes->delete('(:num)', 'Admin\Anggota::delete/$1');
    });
});

// group anggota

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

<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();

// Gunakan baris ini untuk mengaktifkan Auto Routing (Improved)
$routes->setAutoRoute(true);

// Jika kamu pakai versi 4.3 ke atas, autoRoutesImproved diatur lewat Config\Routing.php,
// bukan di sini.










/**
 * @var RouteCollection $routes
 */
$routes->get('Admin', 'Admin::index');
//Admin













if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
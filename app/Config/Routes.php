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
$routes->get('/', 'Home::index');

//Admin
$routes->get('Admin', 'Admin::index');
//Login
$routes->get('Auth', 'Auth::index');
//Login User
$routes->get('Auth/LoginUser', 'Auth::LoginUser');
//Login Anggota
$routes->get('Auth/LoginAnggota', 'Auth::LoginAnggota');














if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
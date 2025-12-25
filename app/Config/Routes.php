<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
//login admin
$routes->get('login', 'Auth::index');
$routes->get('login_user', 'Auth::LoginUser');
$routes->post('cek_login_user', 'Auth::CekLoginUser');
$routes->get('log_out_admin', 'Auth::LogOut');


$routes->group('admin', ['filter' => 'filteruser'], function ($routes) {

    $routes->get('', 'Admin::index');

    //kategori
    $routes->get('kategori', 'Kategori::index');
    $routes->get('kategori/input', 'Kategori::input');
    $routes->post('kategori/insertdata', 'Kategori::InsertData');
    $routes->get('kategori/edit/(:num)', 'Kategori::edit/$1');
    $routes->post('kategori/updatedata/(:num)', 'Kategori::UpdateData/$1');
    $routes->get('kategori/delete/(:num)', 'Kategori::DeleteData/$1');

     //rak
    $routes->get('rak', 'Rak::index');
    $routes->get('rak/input', 'Rak::input');
    $routes->post('rak/insertdata', 'Rak::InsertData');
    $routes->get('rak/edit/(:num)', 'Rak::edit/$1');
    $routes->post('rak/updatedata/(:num)', 'Rak::UpdateData/$1');
    $routes->get('rak/delete/(:num)', 'Rak::DeleteData/$1');

});

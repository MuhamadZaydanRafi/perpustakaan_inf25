<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
//login admin
$routes->get('login', 'Auth::index');
$routes->get('login_user', 'Auth::LoginUser');
$routes->get('login_anggota', 'Auth::LoginAnggota');
$routes->get('anggota/daftar', 'Anggota::Daftar');
$routes->get('debug-password', 'DebugPassword::index');
$routes->get('debug-hash', 'DebugPassword::hashTest');
$routes->get('rehash-password', 'ReHashPassword::index');
$routes->post('cek_login_user', 'Auth::CekLoginUser');
$routes->get('log_out_admin', 'Auth::LogOut');
$routes->get('daftar_anggota', 'Anggota::Daftar');
$routes->post('anggota/daftaranggota', 'Anggota::DaftarAnggota');
$routes->post('cek_login_anggota', 'Auth::CekLoginAnggota');


$routes->group('admin', ['filter' => 'filteruser'], function ($routes) {

    $routes->get('', 'Admin::index');

    //user
    $routes->get('user', 'User::index');
    $routes->get('user/input/', 'User::input');
    $routes->post('user/insertdata', 'User::InsertData');
    $routes->get('user/edit/(:num)', 'User::edit/$1');
    $routes->post('user/update/(:num)', 'User::UpdateData/$1');
    $routes->get('user/delete/(:num)', 'User::DeleteData/$1');
    $routes->get('user/detail/(:num)', 'User::DetailData/$1');

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

    //penerbit
    $routes->get('penerbit', 'Penerbit::index');
    $routes->get('penerbit/input', 'Penerbit::input');
    $routes->post('penerbit/insertdata', 'Penerbit::InsertData');
    $routes->get('penerbit/edit/(:num)', 'Penerbit::edit/$1');
    $routes->post('penerbit/updatedata/(:num)', 'Penerbit::UpdateData/$1');
    $routes->get('penerbit/delete/(:num)', 'Penerbit::DeleteData/$1');

    //penulis
    $routes->get('penulis', 'Penulis::index');
    $routes->get('penulis/input', 'Penulis::input');
    $routes->post('penulis/insertdata', 'Penulis::InsertData');
    $routes->get('penulis/edit/(:num)', 'Penulis::edit/$1');
    $routes->post('penulis/updatedata/(:num)', 'Penulis::UpdateData/$1');
    $routes->get('penulis/delete/(:num)', 'Penulis::DeleteData/$1');

    //kelas
    $routes->get('kelas', 'Kelas::index');
    $routes->get('kelas/input', 'Kelas::input');
    $routes->post('kelas/insertdata', 'Kelas::InsertData');
    $routes->get('kelas/edit/(:num)', 'Kelas::edit/$1');
    $routes->post('kelas/updatedata/(:num)', 'Kelas::UpdateData/$1');
    $routes->get('kelas/delete/(:num)', 'Kelas::DeleteData/$1');

    //anggota
    $routes->get('anggota', 'Anggota::indexAdmin');
    $routes->get('anggota/input', 'Anggota::input');
    $routes->post('anggota/insertdata', 'Anggota::InsertData');
    $routes->get('anggota/verifikasi/(:num)', 'Anggota::verify/$1');
    $routes->get('anggota/detail/(:num)', 'Anggota::detail/$1');
    $routes->get('anggota/edit/(:num)', 'Anggota::editAnggota/$1');
    $routes->post('anggota/updatedata/(:num)', 'Anggota::updateDataAnggota/$1');
    $routes->get('anggota/delete/(:num)', 'Anggota::DeleteData/$1');

    //pengaturan
    $routes->get('pengaturan', 'Pengaturan::web');
    $routes->post('pengaturan/updateweb', 'Pengaturan::UpdateWeb');


});

$routes->group('anggota', ['filter' => 'filteranggota'], function ($routes) {

    $routes->get('dashboard', 'Anggota::index');
    $routes->get('edit_profil/(:num)', 'Anggota::edit/$1');
    $routes->post('updateprofil/(:num)', 'Anggota::updateData/$1');

});

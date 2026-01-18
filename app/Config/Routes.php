<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/sejarah', 'Home::sejarah');
$routes->get('/visimisi', 'Home::visimisi');
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
//buku dan e book
$routes->get('galerybuku', 'Home::galerybuku');
$routes->get('galeryebook', 'Home::galeryebook');
$routes->get('detailbuku/(:num)', 'Home::detailbuku/$1');
$routes->get('detailebook/(:num)', 'Home::detailebook/$1');

$routes->group('admin', ['filter' => 'filteruser'], function ($routes) {

    $routes->get('', 'Admin::index');

    //user - hanya admin
    $routes->group('user', ['filter' => 'filteradmin'], function ($routes) {
        $routes->get('', 'User::index');
        $routes->get('input/', 'User::input');
        $routes->post('insertdata', 'User::InsertData');
        $routes->get('edit/(:num)', 'User::edit/$1');
        $routes->post('update/(:num)', 'User::UpdateData/$1');
        $routes->get('delete/(:num)', 'User::DeleteData/$1');
        $routes->get('detail/(:num)', 'User::DetailData/$1');
    });

    //buku
    $routes->get('buku', 'Buku::index');
    $routes->get('buku/input', 'Buku::input');
    $routes->post('buku/insertdata', 'Buku::InsertData');
    $routes->get('buku/edit/(:num)', 'Buku::edit/$1');
    $routes->post('buku/updatedata/(:num)', 'Buku::UpdateData/$1');
    $routes->get('buku/delete/(:num)', 'Buku::DeleteData/$1');
    $routes->get('buku/detail/(:num)', 'Buku::detail/$1');

    //ebook
    $routes->get('ebook', 'Ebook::index');
    $routes->get('ebook/input', 'Ebook::input');
    $routes->post('ebook/insertdata', 'Ebook::InsertData');
    $routes->get('ebook/edit/(:num)', 'Ebook::edit/$1');
    $routes->post('ebook/updatedata/(:num)', 'Ebook::UpdateData/$1');
    $routes->get('ebook/delete/(:num)', 'Ebook::DeleteData/$1');
    $routes->get('ebook/detail/(:num)', 'Ebook::detail/$1');
    $routes->get('ebook/download/(:num)', 'Ebook::download/$1');

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

    //peminjaman
    $routes->get('peminjaman', 'Admin\Peminjaman::index');
    $routes->get('peminjaman/detail/(:num)', 'Admin\Peminjaman::detail/$1');
    $routes->get('peminjaman/setuju/(:num)', 'Admin\Peminjaman::setuju/$1');
    $routes->get('peminjaman/tolak/(:num)', 'Admin\Peminjaman::tolak/$1');
    $routes->get('peminjaman/diterima', 'Admin\Peminjaman::diterima');
    $routes->get('peminjaman/ditolak', 'Admin\Peminjaman::ditolak');
    $routes->get('peminjaman/dikembalikan', 'Admin\Peminjaman::dikembalikan');

    //pengaturan - hanya admin
    $routes->group('pengaturan', ['filter' => 'filteradmin'], function ($routes) {
        $routes->get('', 'Pengaturan::web');
        $routes->post('updateweb', 'Pengaturan::UpdateWeb');
    });

    //pengaturan slider - hanya admin
    $routes->group('slider', ['filter' => 'filteradmin'], function ($routes) {
        $routes->get('', 'Pengaturan::slider');
        $routes->get('input', 'Pengaturan::InputSlider');
        $routes->post('insertslider', 'Pengaturan::InsertSlider');
        $routes->get('delete/(:num)', 'Pengaturan::DeleteSlider/$1');
    });

    //feedback
    $routes->get('feedback', 'Feedback::index');
    $routes->get('feedback/input', 'Feedback::input');
    $routes->post('feedback/insertdata', 'Feedback::InsertData');
    $routes->get('feedback/delete/(:num)', 'Feedback::delete/$1');

});

$routes->group('anggota', ['filter' => 'filteranggota'], function ($routes) {

    $routes->get('dashboard', 'Anggota::index');
    $routes->get('edit_profil/(:num)', 'Anggota::edit/$1');
    $routes->post('updateprofil/(:num)', 'Anggota::updateData/$1');
    
    // Koleksi buku dan ebook
    $routes->get('buku', 'Anggota\Buku::index');
    $routes->get('buku/detail/(:num)', 'Anggota\Buku::detail/$1');
    $routes->get('ebook', 'Anggota\Ebook::index');
    $routes->get('ebook/detail/(:num)', 'Anggota\Ebook::detail/$1');
    $routes->get('ebook/download/(:num)', 'Anggota\Ebook::download/$1');

    //peminjaman
    $routes->get('peminjaman/pengajuan', 'Anggota\Peminjaman::pengajuan');
    $routes->post('peminjaman/insertdata', 'Anggota\Peminjaman::insertdata');
    $routes->get('peminjaman/edit/(:num)', 'Anggota\Peminjaman::edit/$1');
    $routes->post('peminjaman/updatedata/(:num)', 'Anggota\Peminjaman::updatedata/$1');
    $routes->get('peminjaman/deletedata/(:num)', 'Anggota\Peminjaman::deletedata/$1');
    $routes->get('peminjaman/diterima', 'Anggota\Peminjaman::diterima');
    $routes->get('peminjaman/ditolak', 'Anggota\Peminjaman::ditolak');
    $routes->get('peminjaman/history', 'Anggota\Peminjaman::history');

});

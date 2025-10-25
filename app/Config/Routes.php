<?php

namespace Config;


$routes = Services::routes();



if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}






$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
public bool $autoRoute = true;









/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
//Admin
$routes->get('Admin', 'Admin::index');
//Login
$routes->get('Login', 'Login::index');
<<<<<<< HEAD

=======
>>>>>>> f07e00cacef258184197f08fae743d635eb0e408













if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
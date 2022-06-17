<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes(true);

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

$routes->get('/', 'Home::index');
$routes->get('auth', 'AuthController::index');

// Rotas que podem ser acessada somente com o usuário deslogado
$routes->group('', ['filter' => 'AuthCheckLogged'], function ($routes){
    $routes->get('auth/register', 'AuthController::register');
    $routes->post('auth/register', 'AuthController::register');
    $routes->get('auth/login', 'AuthController::index');
    $routes->post('auth/login', 'AuthController::index');
    $routes->get('auth/recovery-password/(:any)', 'AuthController::recoveryKey');
    $routes->post('auth/recovery-password/(:any)', 'AuthController::recoveryKey');       
    $routes->get('auth/recovery-password', 'AuthController::recovery');
    $routes->post('auth/recovery-password', 'AuthController::recovery');
});
// Rotas que podem ser acessada somente com o usuário logado
$routes->group('', ['filter' => 'AuthCheck'], function ($routes){
    $routes->get('auth/logout', 'AuthController::logout');
    $routes->get('dashboard', 'DashboardController::index');
    $routes->get('dashboard/change-password', 'DashboardController::changePassword');
    $routes->post('dashboard/change-password', 'DashboardController::changePassword');
    $routes->get('dashboard/change-photo', 'DashboardController::changePhoto');
    $routes->post('dashboard/change-photo', 'DashboardController::changePhoto');
    $routes->get('dashboard/change-data', 'DashboardController::changeData');
    $routes->post('dashboard/change-data', 'DashboardController::changeData');    
    $routes->get('dashboard/change-settings', 'DashboardController::changeSettings');
    $routes->post('dashboard/change-settings', 'DashboardController::changeSettings'); 
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

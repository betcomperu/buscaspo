<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('login');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */
//--------------------------------------------------------------------


$routes->group('',  function (RouteCollection $routes) {
    $routes->get('/', 'Login::index',['filter' => 'admin']);
    $routes->get('login', 'Login::index');
    $routes->post('login/logearse', 'Login::logearse');
    $routes->get('login/salir', 'Login::salir');
    
});


$routes->group('',  ['filter'=>'logeo'], function (RouteCollection $routes) {
  
    $routes->get('/panel', 'Admin\Home::index');
    $routes->get('/panel/usuario', 'Admin\Usuario::index');
    $routes->get('/panel/socio', 'Admin\Socio::index');
    $routes->get('/panel/nuevo', 'Admin\Socio::ingresar');
    $routes->get('/panel/eliminados', 'Admin\Socio::eliminados');
    $routes->add('/panel/especialidades', 'Admin\Especialidad::index');
   
 //   $routes->add('/panel/especialidades', 'Admin\Especialidad::index');

});

<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->group("jugadorStatus", function($routes) { 
    $routes->get("/", "JugadorStatus::index"); 
    $routes->get("show", "JugadorStatus::index"); 
    $routes->get("edit/(:num)", "JugadorStatus::singleJugadorStatus/$1"); 
    $routes->get("delete/(:num)", "JugadorStatus::delete/$1"); 
    $routes->post("add", "JugadorStatus::create"); 
    $routes->post("update", "JugadorStatus::update"); 

});
$routes->group("jugadorRol", function($routes) { 
    $routes->get("/", "JugadorRolController::index"); 
    $routes->get("show", "JugadorRolController::index"); 
    $routes->get("edit/(:num)", "JugadorRolController::singleJugadorRol/$1"); 
    $routes->get("delete/(:num)", "JugadorRolController::delete/$1"); 
    $routes->post("add", "JugadorRolController::create"); 
    $routes->post("update", "JugadorRolController::update"); 
});



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

$routes->group("jugador", ['filter' => 'authGuard'], function($routes) { 
    $routes->get("/", "JugadorController::index"); 
    $routes->get("show", "JugadorController::index"); 
    $routes->get("edit/(:num)", "JugadorController::singleJugador/$1"); 
    $routes->get("delete/(:num)", "JugadorController::delete/$1"); 
    $routes->post("add", "JugadorController::create"); 
    $routes->post("update", "JugadorController::update"); 
   
});

$routes->group("profile", function($routes) { 
    $routes->get("/", "ProfileController::index"); 
    $routes->get("show", "ProfileController::index"); 
    $routes->get("edit/(:num)", "ProfileController::singleProfile/$1"); 
    $routes->get("delete/(:num)", "ProfileController::delete/$1"); 
    $routes->post("add", "ProfileController::create"); 
    $routes->post("update", "ProfileController::update"); 
});

$routes->group("power", function($routes) { 
    $routes->get("/", "PowerController::index"); 
    $routes->get("show", "PowerController::index"); 
    $routes->get("edit/(:num)", "PowerController::singlePower/$1"); 
    $routes->get("delete/(:num)", "PowerController::delete/$1"); 
    $routes->post("add", "PowerController::create"); 
    $routes->post("update", "PowerController::update"); 

});

$routes->group("race", function($routes) { 
    $routes->get("/", "RaceController::index"); 
    $routes->get("show", "RaceController::index"); 
    $routes->get("edit/(:num)", "RaceController::singleRace/$1"); 
    $routes->get("delete/(:num)", "RaceController::delete/$1"); 
    $routes->post("add", "RaceController::create"); 
    $routes->post("update", "RaceController::update"); 

});

$routes->group("spells", function($routes) { 
    $routes->get("/", "SpellsController::index"); 
    $routes->get("show", "SpellsController::index"); 
    $routes->get("edit/(:num)", "SpellsController::singleSpells/$1"); 
    $routes->get("delete/(:num)", "SpellsController::delete/$1"); 
    $routes->post("add", "SpellsController::create"); 
    $routes->post("update", "SpellsController::update"); 

});


$routes->group("warriortype", function($routes) { 
    $routes->get("/", "WarriorTypeController::index"); 
    $routes->get("show", "WarriorTypeController::index"); 
    $routes->get("edit/(:num)", "WarriorTypeController::singleWarriorType/$1"); 
    $routes->get("delete/(:num)", "WarriorTypeController::delete/$1"); 
    $routes->post("add", "WarriorTypeController::create"); 
    $routes->post("update", "WarriorTypeController::update"); 

});

$routes->group("warrior", function($routes) { 
    $routes->get("/", "WarriorController::index"); 
    $routes->get("show", "WarriorController::index"); 
    $routes->get("edit/(:num)", "WarriorController::singleWarrior/$1"); 
    $routes->get("delete/(:num)", "WarriorController::delete/$1"); 
    $routes->post("add", "WarriorController::create"); 
    $routes->post("update", "WarriorController::update"); 

   
});

$routes->group("warriorpower", function($routes) { 
    $routes->get("/", "WarriorPowerController::index"); 
    $routes->get("show", "WarriorPowerController::index"); 
    $routes->get("edit/(:num)", "WarriorPowerController::singleWarriorPower/$1"); 
    $routes->get("delete/(:num)", "WarriorPowerController::delete/$1"); 
    $routes->post("add", "WarriorPowerController::create"); 
    $routes->post("update", "WarriorPowerController::update"); 

   
});


$routes->group("warriorspells",['filter' => 'authGuard'], function($routes) { 
    $routes->get("/", "WarriorSpellsController::index"); 
    $routes->get("show", "WarriorSpellsController::index"); 
    $routes->get("edit/(:num)", "WarriorSpellsController::singleWarriorSpells/$1"); 
    $routes->get("delete/(:num)", "WarriorSpellsController::delete/$1"); 
    $routes->post("add", "WarriorSpellsController::create"); 
    $routes->post("update", "WarriorSpellsController::update"); 

   
});


$routes->group('auth', function($routes) {
    $routes->get('login', 'JugadorController::loginView'); // Esta ruta carga la vista del login
    $routes->post('login', 'JugadorController::login'); // Esta procesa el login
    $routes->get('verificarSesion', 'JugadorController::verificarSesion');
    $routes->get('register', 'JugadorController::registerView');
    $routes->post('store', 'JugadorController::store');
    $routes->get('profile', 'ProfileController::profileView');
    $routes->post('store2', 'ProfileController::store');
    $routes->get('logout', 'AuthController::logout');
});

$routes->group('juego', function($routes) {
    $routes->get('/', 'ProfileController::juegoView'); 
  
});
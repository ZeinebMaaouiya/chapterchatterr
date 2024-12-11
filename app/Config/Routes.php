<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
// $routes->get('/register', 'AuthController::index');
$routes->get('/register', 'AuthController::showRegisterForm');
$routes->post('/register', 'AuthController::saveRegistration');

$routes->get('/login', 'AuthController::showLoginForm');
$routes->post('/login', 'AuthController::login');

$routes->get('/logout', 'AuthController::logout');

$routes->get('/dashboard', 'DashboardController::index', ['filter' => 'auth']);

$routes->get('/forgot-password', 'AuthController::showForgotPasswordForm');
$routes->post('/forgot-password', 'AuthController::sendResetLink');
$routes->get('/reset-password/(:any)', 'AuthController::showResetPasswordForm/$1');
$routes->post('/reset-password', 'AuthController::resetPassword');


$routes->get('/send-test-email', 'EmailController::sendTestEmail');

// $routes->get('/book', 'BookController::index');

// Authors Routes
$routes->get('/author', 'AuthorController::index');
$routes->get('/author/create', 'AuthorController::create');
$routes->post('/author/store', 'AuthorController::store');
$routes->get('/author/edit/(:num)', 'AuthorController::edit/$1');
$routes->post('/author/update/(:num)', 'AuthorController::update/$1');
$routes->get('/author/delete/(:num)', 'AuthorController::delete/$1');


// Categories Routes
$routes->get('/category', 'CategoryController::index');
$routes->get('/category/create', 'CategoryController::create');
$routes->post('/category/store', 'CategoryController::store');
$routes->get('/category/edit/(:num)', 'CategoryController::edit/$1');
$routes->post('/category/update/(:num)', 'CategoryController::update/$1');
$routes->get('/category/delete/(:num)', 'CategoryController::delete/$1');

// Books Routes
$routes->get('/book', 'BookController::index');
$routes->get('/book/create', 'BookController::create');
$routes->post('/book/store', 'BookController::store');
$routes->get('/book/edit/(:num)', 'BookController::edit/$1');
$routes->post('/book/update/(:num)', 'BookController::update/$1');
$routes->get('/book/delete/(:num)', 'BookController::delete/$1');

$routes->get('/book/show/(:num)', 'BookController::shows/$1'); // Route for viewing a single book

// $routes->post('/bookrating/save', 'BookRatingController::save');
// $routes->get('/bookrating/getRating/(:num)', 'BookRatingController::getRating/$1');

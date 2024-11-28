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



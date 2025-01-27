<?php

use App\Controllers\AdminController;
use App\Controllers\AuthController;
use App\Controllers\ClientController;
use App\Controllers\DashboardController;
use App\Middleware\AuthMiddleware;

// Login

$router->get('/admin/login', [AuthController::class, 'loginForm']);
$router->post('/admin/login', [AuthController::class, 'login']);

// Home

$router->get('/admin/dashboard', [DashboardController::class, 'index'], [AuthMiddleware::class, 'handle']);

// Clientes

$router->get('/admin/clients', [ClientController::class, 'index'], [AuthMiddleware::class, 'handle']);

$router->get('/admin/clients/create', [ClientController::class, 'create'], [AuthMiddleware::class, 'handle']);
$router->post('/admin/clients/store', [ClientController::class, 'store'], [AuthMiddleware::class, 'handle']);

$router->get('/admin/clients/edit/{id}', [ClientController::class, 'edit'], [AuthMiddleware::class, 'handle']);
$router->patch('/admin/clients/edit/{id}', [ClientController::class, 'update'], [AuthMiddleware::class, 'handle']);

$router->get('/admin/clients/{id}', [ClientController::class, 'show'], [AuthMiddleware::class, 'handle']);

$router->delete('/admin/clients/{id}', [ClientController::class, 'destroy'], [AuthMiddleware::class, 'handle']);

// Admins

$router->get('/admin/users', [AdminController::class, 'index'], [AuthMiddleware::class, 'handle']);

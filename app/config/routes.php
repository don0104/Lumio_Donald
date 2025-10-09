<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
/**
 * ------------------------------------------------------------------
 * LavaLust - an opensource lightweight PHP MVC Framework
 * ------------------------------------------------------------------
 *
 * MIT License
 *
 * Copyright (c) 2020 Ronald M. Marasigan
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package LavaLust
 * @author Ronald M. Marasigan <ronald.marasigan@yahoo.com>
 * @since Version 1
 * @link https://github.com/ronmarasigan/LavaLust
 * @license https://opensource.org/licenses/MIT MIT License
 */

/*
| -------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------
| Here is where you can register web routes for your application.
|
|
*/

// Default route - redirect to auth login
$router->get('/', 'AuthController::index');

// Authentication routes (moved to AuthController)
$router->match('/auth/login', 'AuthController::login', ['GET', 'POST']);
$router->match('/auth/register', 'AuthController::register', ['GET', 'POST']);
$router->get('/auth/logout', 'AuthController::logout');

// Backward-compatible aliases
$router->match('/user/login', 'AuthController::login', ['GET', 'POST']);
$router->match('/user/register', 'AuthController::register', ['GET', 'POST']);
$router->get('/user/logout', 'AuthController::logout');
$router->get('/user/dashboard', 'UserController::dashboard');
$router->get('/user/admin_dashboard', 'UserController::admin_dashboard');

// Dashboard shortcuts
$router->get('/dashboard', 'UserController::dashboard');
$router->get('/admin', 'UserController::admin_dashboard');

// User management routes (existing)
$router->get('/user/all', 'UserController::all');
$router->get('/user/search_ajax', 'UserController::search_ajax');
$router->match('/user/create', 'UserController::create', ['GET', 'POST']);
$router->match('/user/update/{id}', 'UserController::update', ['GET', 'POST']);
$router->get('/user/delete/{id}', 'UserController::delete');

// Auth users routes (separate view)
$router->get('/auth_users/all', 'AuthUserController::all');
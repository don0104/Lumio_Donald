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

// Debug route to test if the application is working
$router->get('/debug', 'AuthController::debug');

// Simple test route
$router->get('/test', function() {
    echo "<h1>Test Page</h1>";
    echo "<p>Application is working!</p>";
    echo "<p>Time: " . date('Y-m-d H:i:s') . "</p>";
    echo "<h3>Controller-based routes:</h3>";
    echo "<p><a href='" . base_url() . "'>Go to Home</a></p>";
    echo "<p><a href='" . base_url('user/register') . "'>Go to Register (Controller)</a></p>";
    echo "<p><a href='" . base_url('user/login') . "'>Go to Login (Controller)</a></p>";
    echo "<h3>Simple function-based routes:</h3>";
    echo "<p><a href='" . base_url('auth/register-simple') . "'>Go to Register (Simple)</a></p>";
    echo "<p><a href='" . base_url('auth/login-simple') . "'>Go to Login (Simple)</a></p>";
    echo "<h3>Test routes:</h3>";
    echo "<p><a href='" . base_url('register-test') . "'>Register Test</a></p>";
    echo "<p><a href='" . base_url('login-test') . "'>Login Test</a></p>";
    echo "<p><a href='" . base_url('auth/test') . "'>Auth Test</a></p>";
    exit;
});

// Simple register test route
$router->get('/register-test', function() {
    echo "<h1>Register Test Page</h1>";
    echo "<p>Register route is working!</p>";
    echo "<p><a href='" . base_url() . "'>Go to Home</a></p>";
    exit;
});

// Simple login test route
$router->get('/login-test', function() {
    echo "<h1>Login Test Page</h1>";
    echo "<p>Login route is working!</p>";
    echo "<p><a href='" . base_url() . "'>Go to Home</a></p>";
    exit;
});

// Test if auth routes work
$router->get('/auth/test', function() {
    echo "<h1>Auth Test Page</h1>";
    echo "<p>Auth routes are working!</p>";
    echo "<p><a href='" . base_url() . "'>Go to Home</a></p>";
    exit;
});

// Simple function-based login route
$router->match('/auth/login-simple', function() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        echo "<h1>Login Form Submitted</h1>";
        echo "<p>Username: " . ($_POST['username'] ?? 'Not provided') . "</p>";
        echo "<p>Password: " . (isset($_POST['password']) ? 'Provided' : 'Not provided') . "</p>";
        echo "<p><a href='" . base_url() . "'>Go to Home</a></p>";
        exit;
    } else {
        echo "<h1>Simple Login Page</h1>";
        echo "<form method='POST'>";
        echo "<p><input type='text' name='username' placeholder='Username' required></p>";
        echo "<p><input type='password' name='password' placeholder='Password' required></p>";
        echo "<p><button type='submit'>Login</button></p>";
        echo "</form>";
        echo "<p><a href='" . base_url() . "'>Go to Home</a></p>";
        exit;
    }
}, ['GET', 'POST']);

// Simple function-based register route
$router->match('/auth/register-simple', function() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        echo "<h1>Register Form Submitted</h1>";
        echo "<p>Username: " . ($_POST['username'] ?? 'Not provided') . "</p>";
        echo "<p>Email: " . ($_POST['email'] ?? 'Not provided') . "</p>";
        echo "<p>First Name: " . ($_POST['first_name'] ?? 'Not provided') . "</p>";
        echo "<p>Last Name: " . ($_POST['last_name'] ?? 'Not provided') . "</p>";
        echo "<p><a href='" . base_url() . "'>Go to Home</a></p>";
        exit;
    } else {
        echo "<h1>Simple Register Page</h1>";
        echo "<form method='POST'>";
        echo "<p><input type='text' name='username' placeholder='Username' required></p>";
        echo "<p><input type='email' name='email' placeholder='Email' required></p>";
        echo "<p><input type='text' name='first_name' placeholder='First Name' required></p>";
        echo "<p><input type='text' name='last_name' placeholder='Last Name' required></p>";
        echo "<p><input type='password' name='password' placeholder='Password' required></p>";
        echo "<p><input type='password' name='confirm_password' placeholder='Confirm Password' required></p>";
        echo "<p><button type='submit'>Register</button></p>";
        echo "</form>";
        echo "<p><a href='" . base_url() . "'>Go to Home</a></p>";
        exit;
    }
}, ['GET', 'POST']);

// Navigation routes for logged-in users
$router->get('/dashboard', 'UserController::dashboard');
$router->get('/users', 'UserController::all');
$router->get('/admin', 'UserController::admin_dashboard');


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
$router->get('/user/view/{id}', 'UserController::view');
$router->get('/user/edit/{id}', 'UserController::edit');
$router->get('/user/search_ajax', 'UserController::search_ajax');
$router->match('/user/create', 'UserController::create', ['GET', 'POST']);
$router->match('/user/update/{id}', 'UserController::update', ['GET', 'POST']);
$router->get('/user/delete/{id}', 'UserController::delete');

// Auth users routes (separate view)
$router->get('/auth_users/all', 'AuthUserController::all');
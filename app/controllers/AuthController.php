<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthController extends Controller {
    public function __construct()
    {
        parent::__construct();
        $this->call->model('AuthModel');
    }

    private function is_logged_in()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
    }

    public function index()
    {
        // Debug: Check if method is being called
        if (isset($_GET['debug'])) {
            echo "<h1>Index Method Called</h1>";
            echo "<p>Session status: " . (session_status() === PHP_SESSION_ACTIVE ? 'Active' : 'Not Active') . "</p>";
            echo "<p>Logged in: " . ($this->is_logged_in() ? 'Yes' : 'No') . "</p>";
            exit;
        }

        // Instead of redirecting, directly show the login page
        $this->call->view('user/login');
    }

    public function debug()
    {
        echo "<h1>Debug Page</h1>";
        echo "<p>Application is working!</p>";
        echo "<p>Session status: " . (session_status() === PHP_SESSION_ACTIVE ? 'Active' : 'Not Active') . "</p>";
        echo "<p>Logged in: " . ($this->is_logged_in() ? 'Yes' : 'No') . "</p>";
        echo "<p>Base URL: " . base_url() . "</p>";
        echo "<p><a href='" . base_url('auth/login') . "'>Go to Login</a></p>";
        exit;
    }

    public function login()
    {
        // Debug: Check if method is being called
        if (isset($_GET['debug'])) {
            echo "<h1>Login Method Called</h1>";
            echo "<p>Method: " . $this->io->method() . "</p>";
            echo "<p>Session status: " . (session_status() === PHP_SESSION_ACTIVE ? 'Active' : 'Not Active') . "</p>";
            echo "<p>Logged in: " . ($this->is_logged_in() ? 'Yes' : 'No') . "</p>";
            exit;
        }

        $data = [];
        if ($this->is_logged_in()) {
            $data['message'] = 'You are already logged in.';
        }

        if ($this->io->method() == 'post') {
            $username = $this->io->post('username');
            $password = $this->io->post('password');
            $remember = isset($_POST['remember']) && $_POST['remember'] == '1';

            if (empty($username) || empty($password)) {
                $data['error'] = 'Username and password are required';
                $this->call->view('user/login', $data);
                return;
            }

            $result = $this->AuthModel->login($username, $password);

            if ($result['success']) {
                $this->session->set_userdata([
                    'user_id' => $result['user']['id'],
                    'username' => $result['user']['username'],
                    'email' => $result['user']['email'],
                    'role' => $result['user']['role'],
                    'first_name' => $result['user']['first_name'] ?? '',
                    'last_name' => $result['user']['last_name'] ?? '',
                    'created_at' => $result['user']['created_at'] ?? date('Y-m-d H:i:s'),
                    'last_login' => $result['user']['last_login'] ?? null,
                    'logged_in' => true
                ]);

                if (!isset($_SESSION)) {
                    session_start();
                }
                $_SESSION['user_id'] = $result['user']['id'];
                $_SESSION['username'] = $result['user']['username'];
                $_SESSION['email'] = $result['user']['email'];
                $_SESSION['role'] = $result['user']['role'];
                $_SESSION['first_name'] = $result['user']['first_name'] ?? '';
                $_SESSION['last_name'] = $result['user']['last_name'] ?? '';
                $_SESSION['created_at'] = $result['user']['created_at'] ?? date('Y-m-d H:i:s');
                $_SESSION['last_login'] = $result['user']['last_login'] ?? null;
                $_SESSION['logged_in'] = true;

                if ($remember) {
                    $this->set_remember_cookie($result['user']['id']);
                }

                // Show success message with navigation links
                $data['success'] = 'Login successful! You are now logged in.';
                $data['user_role'] = $result['user']['role'];
                $data['show_navigation'] = true;
                $this->call->view('user/login', $data);
                return;
            } else {
                $data['error'] = $result['message'];
                $data['username'] = $username;
                $this->call->view('user/login', $data);
            }
        } else {
            $this->check_remember_cookie();
            $this->call->view('user/login', $data);
        }
    }

    public function register()
    {
        // Debug: Check if method is being called
        if (isset($_GET['debug'])) {
            echo "<h1>Register Method Called</h1>";
            echo "<p>Method: " . $this->io->method() . "</p>";
            echo "<p>Session status: " . (session_status() === PHP_SESSION_ACTIVE ? 'Active' : 'Not Active') . "</p>";
            exit;
        }

        $data = [];
        if ($this->is_logged_in()) {
            $role = isset($_SESSION['role']) ? strtolower($_SESSION['role']) : 'user';
            if ($role !== 'admin') {
                $data['message'] = 'You are already logged in.';
            }
        }

        if ($this->io->method() == 'post') {
            $form_data = [
                'username' => $this->io->post('username'),
                'email' => $this->io->post('email'),
                'password' => $this->io->post('password'),
                'first_name' => $this->io->post('first_name'),
                'last_name' => $this->io->post('last_name')
            ];
            $confirm_password = $this->io->post('confirm_password');

            $errors = $this->validate_registration($form_data, $confirm_password);
            if (!empty($errors)) {
                $data['errors'] = $errors;
                $data['form_data'] = $form_data;
                $this->call->view('user/register', $data);
                return;
            }

            // Enforce role: only admins (or first admin) may create admin users
            $requestedRole = strtolower($this->io->post('role') ?? 'user');
            $allowAdmin = false;

            $sessionRole = isset($_SESSION['role']) ? strtolower($_SESSION['role']) : 'user';
            if ($sessionRole === 'admin') {
                $allowAdmin = true;
            }

            try {
                if (!$this->AuthModel->any_admin_exists()) {
                    $allowAdmin = true; // allow first admin bootstrap
                }
            } catch (Exception $e) {
                // ignore and default to current allowAdmin
            }

            $form_data['role'] = ($allowAdmin && $requestedRole === 'admin') ? 'admin' : 'user';

            $result = $this->AuthModel->register($form_data);

            if ($result['success']) {
                $data['success'] = $result['message'];
                $data['show_navigation'] = true;
                $this->call->view('user/register', $data);
            } else {
                $data['error'] = $result['message'];
                $data['form_data'] = $form_data;
                $this->call->view('user/register', $data);
            }
        } else {
            $this->call->view('user/register', $data);
        }
    }

    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        unset($_SESSION['logged_in']);
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        unset($_SESSION['email']);
        unset($_SESSION['role']);
        unset($_SESSION['first_name']);
        unset($_SESSION['last_name']);
        unset($_SESSION['created_at']);
        unset($_SESSION['last_login']);

        $_SESSION = array();

        $this->clear_remember_cookie();

        if (isset($this->session)) {
            $this->session->sess_destroy();
        }

        session_destroy();

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        $login_url = base_url('auth/login');
        echo "<script>window.location.href = '$login_url';</script>";
        echo "<meta http-equiv='refresh' content='0;url=$login_url'>";
        echo "<p>Redirecting to login...</p>";
        echo "<p><a href='$login_url'>Click here if not redirected</a></p>";
        exit();
    }

    private function validate_registration($data, $confirm_password)
    {
        $errors = [];
        if (empty($data['username'])) {
            $errors[] = 'Username is required';
        } elseif (strlen($data['username']) < 3) {
            $errors[] = 'Username must be at least 3 characters long';
        }
        if (empty($data['email'])) {
            $errors[] = 'Email is required';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Invalid email format';
        }
        if (empty($data['password'])) {
            $errors[] = 'Password is required';
        } elseif (strlen($data['password']) < 6) {
            $errors[] = 'Password must be at least 6 characters long';
        }
        if ($data['password'] !== $confirm_password) {
            $errors[] = 'Passwords do not match';
        }
        if (empty($data['first_name'])) {
            $errors[] = 'First name is required';
        }
        if (empty($data['last_name'])) {
            $errors[] = 'Last name is required';
        }
        return $errors;
    }

    private function set_remember_cookie($user_id)
    {
        $token = bin2hex(random_bytes(32));
        $expires = time() + (30 * 24 * 60 * 60);
        setcookie('remember_token', $token, $expires, '/', '', false, true);
    }

    private function check_remember_cookie()
    {
        if (isset($_COOKIE['remember_token']) && !$this->is_logged_in()) {
            // token verification would go here in a real app
        }
    }

    private function clear_remember_cookie()
    {
        if (isset($_COOKIE['remember_token'])) {
            setcookie('remember_token', '', time() - 3600, '/', '', false, true);
        }
    }
}



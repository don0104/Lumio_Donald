<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class UserController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->model('UserModel'); // Load the model
        $this->call->model('AuthModel'); // Load auth users model for separate listing
    }

    /**
     * Check if user is logged in
     */
    private function is_logged_in()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
    }

    // list - everyone
    public function index()
    {
        // Show a simple message instead of redirecting
        echo "<h1>User Controller Index</h1>";
        echo "<p>Logged in: " . ($this->is_logged_in() ? 'Yes' : 'No') . "</p>";
        if ($this->is_logged_in()) {
            $role = isset($_SESSION['role']) ? strtolower($_SESSION['role']) : 'user';
            echo "<p>Role: " . $role . "</p>";
        }
        echo "<p><a href='" . base_url() . "'>Go to Home</a></p>";
        exit;
    }

    // view individual user - everyone
    public function view($id)
    {
        if (!$this->is_logged_in()) {
            redirect('auth/login');
        }

        $data['user'] = $this->get_current_user();
        $data['view_user'] = $this->UserModel->find($id);
        $data['is_admin'] = $this->has_permission('admin');

        // Debug: Check if user was found
        if (!$data['view_user']) {
            echo "User not found with ID: " . $id;
            exit;
        }

        $this->call->view('user/user_detail', $data);
    }

    /**
     * User dashboard
     */
    public function dashboard()
    {
        if (!$this->is_logged_in()) {
            redirect('auth/login');
        }

        $data['user'] = $this->get_current_user();
        $this->call->view('user/dashboard', $data);
    }

    /**
     * Admin dashboard
     */
    public function admin_dashboard()
    {
        if (!$this->is_logged_in() || !$this->has_permission('admin')) {
            redirect('auth/login');
        }

        // Get user statistics from users table
        $users_data = $this->UserModel->page('', 5, 1);
        $data['recent_users'] = $users_data['records'];
        $data['total_users'] = $users_data['total_rows'];
        $data['user'] = $this->get_current_user();

        // Count administrators from users table
        $admin_count = $this->UserModel->db->table('users')
            ->where('role', 'admin')
            ->select_count('*', 'count')
            ->get()['count'];
        $data['admin_count'] = $admin_count;

        // Get all users from users table for the admin management section
        try {
            $usersAll = $this->UserModel->page('', null, null);
            $data['users_all'] = $usersAll['records'];
            $data['users_total_rows'] = $usersAll['total_rows'];
            
        } catch (Exception $e) {
            $data['users_all'] = [];
            $data['users_total_rows'] = 0;
        }

        // Get recent activity data
        $data['recent_activity'] = $this->get_recent_activity();

        $this->call->view('user/admin_dashboard', $data);
    }

    // create - admin only
    public function create()
    {
        if (!$this->is_logged_in() || !$this->has_permission('admin')) {
            redirect('auth/login');
        }

        if($this->io->method() == 'post') {
            $data = [
                'username' => $this->io->post('username'),
                'email'    => $this->io->post('email')
            ];
            $this->UserModel->insert($data);
            redirect('user/all'); // balik sa list after insert
        } else {
            $this->call->view('user/create');
        }
    }

    public function store()
    {
        if (!$this->is_logged_in() || !$this->has_permission('admin')) {
            redirect('auth/login');
        }

        if($this->io->method() == 'post') {
            $data = [
                'username' => $this->io->post('username'),
                'email'    => $this->io->post('email')
            ];
            $this->UserModel->insert($data);
            redirect('user/all'); // balik sa list after insert
        } else {
            $this->call->view('user/create');
        }
    }

    // edit - admin only
    public function edit($id)
    {
        if (!$this->is_logged_in() || !$this->has_permission('admin')) {
            redirect('auth/login');
        }

        $data['user'] = $this->UserModel->find($id);
        
        // Debug: Check if user was found
        if (!$data['user']) {
            echo "User not found with ID: " . $id;
            exit;
        }
        
        $this->call->view('user/edit', $data);
    }

    public function update($id)
    {
        if (!$this->is_logged_in() || !$this->has_permission('admin')) {
            redirect('auth/login');
        }

        $data['user'] = $this->UserModel->find($id);

        if ($this->io->method() == 'post') {
            $updateData = [
                'username' => $this->io->post('username'),
                'email' => $this->io->post('email'),
                'first_name' => $this->io->post('first_name'),
                'last_name' => $this->io->post('last_name'),
                'role' => $this->io->post('role')
            ];

            // Only update password if provided
            $password = $this->io->post('password');
            if (!empty($password)) {
                $updateData['password'] = password_hash($password, PASSWORD_DEFAULT);
            }

            $this->UserModel->update($id, $updateData);
            redirect('user/view/'.$id); // redirect to user detail page
        } else {
            $this->call->view('user/edit', $data);
        }
    }

    public function delete($id)
    {
        if (!$this->is_logged_in() || !$this->has_permission('admin')) {
            redirect('auth/login');
        }

        $this->UserModel->delete($id);
        redirect('user/admin_dashboard'); // redirect to admin dashboard after delete
    }

    public function all() 
    {
        // Allow all logged-in users to view the list
        if (!$this->is_logged_in()) {
            redirect('auth/login');
        }

        $page = 1;
        if(isset($_GET['page']) && ! empty($_GET['page'])) {
            $page = $this->io->get('page');
        }

        $q = '';
        if(isset($_GET['q']) && ! empty($_GET['q'])) {
            $q = trim($this->io->get('q'));
        }

        $records_per_page = 10;

        $all = $this->UserModel->page($q, $records_per_page, $page);
        $data['all'] = $all['records'];
        $total_rows = $all['total_rows'];

        // Also fetch users separately (no pagination for now)
        try {
            $usersAll = $this->UserModel->page($q, null, null);
            $data['users_all'] = $usersAll['records'];
            $data['users_total_rows'] = $usersAll['total_rows'];
        } catch (Exception $e) {
            $data['users_all'] = [];
            $data['users_total_rows'] = 0;
        }

        // Pass current user info to view for role-based UI
        $data['current_user'] = $this->get_current_user();
        $data['is_admin'] = $this->has_permission('admin');

        $this->pagination->set_options([
            'first_link'     => '⏮ First',
            'last_link'      => 'Last ⏭',
            'next_link'      => 'Next →',
            'prev_link'      => '← Prev',
            'page_delimiter' => '&page='
        ]);
        $this->pagination->set_theme('bootstrap'); // or 'tailwind', or 'custom'
        $this->pagination->initialize($total_rows, $records_per_page, $page, 'user/all?q='.$q);
        $data['page'] = $this->pagination->paginate();
        $this->call->view('user/view', $data);
    }

    // AJAX endpoint for real-time search
    public function search_ajax()
    {
        try {
            $q = '';
            if(isset($_GET['q']) && ! empty($_GET['q'])) {
                $q = trim($this->io->get('q'));
            }

            $page = 1;
            if(isset($_GET['page']) && ! empty($_GET['page'])) {
                $page = $this->io->get('page');
            }

            $records_per_page = 10;
            $all = $this->UserModel->page($q, $records_per_page, $page);
            
            // Return JSON response
            header('Content-Type: application/json');
            echo json_encode([
                'success' => true,
                'data' => $all['records'],
                'total_rows' => $all['total_rows'],
                'current_page' => $page,
                'records_per_page' => $records_per_page
            ]);
        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo json_encode([
                'success' => false,
                'error' => $e->getMessage(),
                'data' => []
            ]);
        }
        exit;
    }

    /**
     * Get recent activity data
     */
    private function get_recent_activity()
    {
        $activities = [];
        
        try {
            // Get recent user registrations (from users table)
            $recent_registrations = $this->UserModel->db->table('users')
                ->order_by('created_at', 'DESC')
                ->limit(3)
                ->get();
            
            foreach ($recent_registrations as $user) {
                $activities[] = [
                    'type' => 'registration',
                    'message' => 'New user registered: ' . $user['username'],
                    'time' => $user['created_at'],
                    'icon' => 'user-plus',
                    'color' => 'success'
                ];
            }
            
            // Get recent user updates (simulate - you can add an activity log table later)
            $recent_updates = $this->UserModel->db->table('users')
                ->order_by('updated_at', 'DESC')
                ->limit(2)
                ->get();
            
            foreach ($recent_updates as $user) {
                if ($user['updated_at'] && $user['updated_at'] !== $user['created_at']) {
                    $activities[] = [
                        'type' => 'update',
                        'message' => 'User updated: ' . $user['username'],
                        'time' => $user['updated_at'],
                        'icon' => 'edit',
                        'color' => 'warning'
                    ];
                }
            }
            
            // Add system activities
            $activities[] = [
                'type' => 'system',
                'message' => 'Admin dashboard accessed',
                'time' => date('Y-m-d H:i:s'),
                'icon' => 'dashboard',
                'color' => 'info'
            ];
            
            // Sort by time (most recent first)
            usort($activities, function($a, $b) {
                return strtotime($b['time']) - strtotime($a['time']);
            });
            
            // Return only the 5 most recent activities
            return array_slice($activities, 0, 5);
            
        } catch (Exception $e) {
            // Return default activities if database query fails
            return [
                [
                    'type' => 'system',
                    'message' => 'System initialized',
                    'time' => date('Y-m-d H:i:s'),
                    'icon' => 'check-circle',
                    'color' => 'success'
                ]
            ];
        }
    }
    private function get_current_user()
    {
        if (!$this->is_logged_in()) {
            return null;
        }

        if (!isset($_SESSION)) {
            session_start();
        }
        
        return [
            'id' => $_SESSION['user_id'] ?? null,
            'username' => $_SESSION['username'] ?? null,
            'email' => $_SESSION['email'] ?? null,
            'role' => $_SESSION['role'] ?? null,
            'first_name' => $_SESSION['first_name'] ?? null,
            'last_name' => $_SESSION['last_name'] ?? null,
            'created_at' => $_SESSION['created_at'] ?? null,
            'last_login' => $_SESSION['last_login'] ?? null
        ];
    }

    /**
     * Check user permission
     */
    private function has_permission($required_role = 'user')
    {
        if (!$this->is_logged_in()) {
            return false;
        }

        $user_id = $_SESSION['user_id'] ?? null;
        // Check permission against auth_users (source of truth for roles)
        return $this->AuthModel->has_permission($user_id, $required_role);
    }

    // validation moved to AuthController

    // cookie helpers moved to AuthController

    // cookie helpers moved to AuthController

    // cookie helpers moved to AuthController
}

<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UserController extends Controller {
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

    public function index()
    {
        // Redirect to login if not authenticated, otherwise to dashboard
        if (!$this->is_logged_in()) {
            redirect('user/login');
        } else {
            redirect('user/dashboard');
        }
    }

    // moved to AuthController::login

    // moved to AuthController::register

    // moved to AuthController::logout

    /**
     * User dashboard
     */
    public function dashboard()
    {
        if (!$this->is_logged_in()) {
            redirect('user/login');
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
            redirect('user/login');
        }

        // Get user statistics
        $users_data = $this->UserModel->page('', 5, 1);
        $data['recent_users'] = $users_data['records'];
        $data['total_users'] = $users_data['total_rows'];
        $data['user'] = $this->get_current_user();
        
        $this->call->view('user/admin_dashboard', $data);
    }

    public function create()
    {
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

    public function update($id)
    {
        $data['user'] = $this->UserModel->find($id);

        if ($this->io->method() == 'post') {
            $updateData = [
                'username' => $this->io->post('username'),
                'email'    => $this->io->post('email')
            ];
            $this->UserModel->update($id, $updateData);
            redirect('user/all'); // balik sa list
        } else {
            $this->call->view('user/update', $data);
        }
    }

    public function delete($id)
    {
        $this->UserModel->delete($id);
        redirect('user/all'); // balik sa list after delete
    }

    public function all() 
    {
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

        // Also fetch auth_users separately (no pagination for now)
        try {
            $authAll = $this->AuthModel->page($q, null, null);
            $data['auth_all'] = $authAll['records'];
            $data['auth_total_rows'] = $authAll['total_rows'];
        } catch (Exception $e) {
            $data['auth_all'] = [];
            $data['auth_total_rows'] = 0;
        }
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

    // Helper methods

    /**
     * Get current user data
     */
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

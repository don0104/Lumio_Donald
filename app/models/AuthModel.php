<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthModel extends Model {
    protected $table = 'auth_users';
    protected $primary_key = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    public function register($data)
    {
        try {
            if ($this->user_exists($data['username'], $data['email'])) {
                return ['success' => false, 'message' => 'Username or email already exists'];
            }
            // sanitize role
            $role = isset($data['role']) ? strtolower($data['role']) : 'user';
            if (!in_array($role, ['user', 'admin'], true)) {
                $role = 'user';
            }
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['role'] = $role;
            $data['is_active'] = 1;
            $user_id = $this->db->table($this->table)->insert($data);
            if ($user_id) {
                return ['success' => true, 'message' => 'User registered successfully', 'user_id' => $user_id];
            }
            return ['success' => false, 'message' => 'Registration failed - could not insert user'];
        } catch (Exception $e) {
            return ['success' => false, 'message' => 'Registration error: ' . $e->getMessage()];
        }
    }

    public function any_admin_exists()
    {
        $count = $this->db->table($this->table)
            ->where('role', 'admin')
            ->select_count('*', 'count')
            ->get();
        return ($count && isset($count['count']) && (int)$count['count'] > 0);
    }

    public function has_permission($user_id, $required_role = 'user')
    {
        $user = $this->db->table($this->table)->where('id', $user_id)->get();
        if (!$user || !isset($user['role'])) {
            return false;
        }
        $role_hierarchy = ['user' => 1, 'moderator' => 2, 'admin' => 3];
        $user_level = $role_hierarchy[strtolower($user['role'])] ?? 0;
        $required_level = $role_hierarchy[strtolower($required_role)] ?? 0;
        return $user_level >= $required_level;
    }

    public function page($q, $records_per_page = null, $page = null) {
        $query = $this->db->table($this->table);
        if (!empty($q)) {
            $query->like('id', '%'.$q.'%')
                ->or_like('username', '%'.$q.'%')
                ->or_like('email', '%'.$q.'%');
        }
        $countQuery = clone $query;
        $data['total_rows'] = $countQuery->select_count('*', 'count')->get()['count'];
        if (is_null($page)) {
            $data['records'] = $query->get_all();
        } else {
            $data['records'] = $query->pagination($records_per_page, $page)->get_all();
        }
        return $data;
    }

    public function login($username, $password)
    {
        $user = $this->db->table($this->table)
                    ->where('username', $username)
                    ->or_where('email', $username)
                    ->get();
        if (!$user) {
            return ['success' => false, 'message' => 'Invalid credentials'];
        }
        if (!$user['is_active']) {
            return ['success' => false, 'message' => 'Account is deactivated'];
        }
        if ($user['locked_until'] && strtotime($user['locked_until']) > time()) {
            return ['success' => false, 'message' => 'Account is temporarily locked'];
        }
        if (!password_verify($password, $user['password'])) {
            $this->increment_failed_attempts($user['id']);
            return ['success' => false, 'message' => 'Invalid credentials'];
        }
        $this->reset_failed_attempts($user['id']);
        $this->update_last_login($user['id']);
        unset($user['password']);
        return ['success' => true, 'message' => 'Login successful', 'user' => $user];
    }

    public function user_exists($username, $email)
    {
        $count = $this->db->table($this->table)
                    ->where('username', $username)
                    ->or_where('email', $email)
                    ->select_count('*', 'count')
                    ->get();
        return $count['count'] > 0;
    }

    private function increment_failed_attempts($user_id)
    {
        $user = $this->db->table($this->table)->where('id', $user_id)->get();
        $attempts = $user['failed_login_attempts'] + 1;
        $update_data = ['failed_login_attempts' => $attempts];
        if ($attempts >= 5) {
            $update_data['locked_until'] = date('Y-m-d H:i:s', time() + (30 * 60));
        }
        $this->db->table($this->table)->where('id', $user_id)->update($update_data);
    }

    private function reset_failed_attempts($user_id)
    {
        $this->db->table($this->table)
             ->where('id', $user_id)
             ->update([
                 'failed_login_attempts' => 0,
                 'locked_until' => null
             ]);
    }

    private function update_last_login($user_id)
    {
        $this->db->table($this->table)
             ->where('id', $user_id)
             ->update(['last_login' => date('Y-m-d H:i:s')]);
    }
}



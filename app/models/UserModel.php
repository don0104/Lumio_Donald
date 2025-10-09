<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Model: UserModel
 * 
 * Automatically generated via CLI.
 */
class UserModel extends Model {
    protected $table = 'users';
    protected $primary_key = 'id';

    public function __construct()
    {
        parent::__construct();
    }
    
  
    public function page($q, $records_per_page = null, $page = null) {
        $query = $this->db->table('users');
        
        // If there's a search query, add LIKE conditions
        if (!empty($q)) {
            $query->like('id', '%'.$q.'%')
                ->or_like('username', '%'.$q.'%')
                ->or_like('email', '%'.$q.'%');
        }

        // Clone before pagination for count
        $countQuery = clone $query;

        $data['total_rows'] = $countQuery->select_count('*', 'count')
                                        ->get()['count'];

        // If page is null, return all records without pagination
        if (is_null($page)) {
            $data['records'] = $query->get_all();
        } else {
            $data['records'] = $query->pagination($records_per_page, $page)
                                    ->get_all();
        }

        return $data;
    }

    // moved auth-centric helpers to AuthModel
    /**
     * Check user permission
     */
    public function has_permission($user_id, $required_role = 'user')
    {
        $user = $this->find($user_id);
        
        if (!$user) {
            return false;
        }
        
        $role_hierarchy = ['user' => 1, 'moderator' => 2, 'admin' => 3];
        
        $user_level = $role_hierarchy[$user['role']] ?? 0;
        $required_level = $role_hierarchy[$required_role] ?? 0;
        
        return $user_level >= $required_level;
    }
    
    /**
     * Increment failed login attempts
     */
    // moved to AuthModel


   
}
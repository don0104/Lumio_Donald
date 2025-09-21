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
    
  
    public function page($q = null, $records_per_page = null, $page = null) {
        if (is_null($page)) {
            return $this->db->table('users')->get_all();
        } else {
            $query = $this->db->table('users');
            
            // Build LIKE conditions for search
            if (!empty($q)) {
                $query->like('id', '%'.$q.'%')
                      ->or_like('username', '%'.$q.'%')
                      ->or_like('email', '%'.$q.'%')
                      ->or_like('created_at', '%'.$q.'%')
                      ->or_like('updated_at', '%'.$q.'%');
            }

            // Clone before pagination for count
            $countQuery = clone $query;

            $data['total_rows'] = $countQuery->select_count('*', 'count')
                                            ->get()['count'];

            $data['records'] = $query->pagination($records_per_page, $page)
                                    ->get_all();

            return $data;
        }
    }


   
}
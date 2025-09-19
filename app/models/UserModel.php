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
    $query = $this->db->table('users');

    // Kung may search term
    if (!empty($q)) {
        $query->like('id', $q)
              ->or_like('first_name', $q)
              ->or_like('last_name', $q)
              ->or_like('birthdate', $q)
              ->or_like('email', $q)
              ->or_like('added', $q);
    }

    if (is_null($page)) {
        return $query->get_all();
    } else {
        // Count total
        $countQuery = $this->db->table('users');
        if (!empty($q)) {
            $countQuery->like('id', $q)
                       ->or_like('first_name', $q)
                       ->or_like('last_name', $q)
                       ->or_like('birthdate', $q)
                       ->or_like('email', $q)
                       ->or_like('added', $q);
        }

        $data['total_rows'] = $countQuery->count_all_results();

        // Get paginated records
        $data['records'] = $query->pagination($records_per_page, $page)->get_all();

        return $data;
    }
}


   
}
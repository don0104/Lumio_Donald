<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UserController extends Controller {
    public function __construct()
    {
        parent::__construct();
        $this->call->model('UserModel'); // Load the model
    }

    public function index()
    {
        // Redirect to all method for pagination
        redirect('user/all');
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
        $page = $this->io->get('page') ?? 1;
        $q    = trim($this->io->get('q') ?? '');
        $records_per_page = 10;

        // FIX: gamitin UserModel imbes na author_model
        $all = $this->UserModel->page($q, $records_per_page, $page);

        $data['all'] = $all['records'];
        $total_rows  = $all['total_rows'];

        $this->pagination->set_options([
            'first_link'     => '⏮ First',
            'last_link'      => 'Last ⏭',
            'next_link'      => 'Next →',
            'prev_link'      => '← Prev',
            'page_delimiter' => '&page='
        ]);
        $this->pagination->set_theme('custom');
        $this->pagination->initialize($total_rows, $records_per_page, $page, site_url('user/all').'?q='.$q);

        $data['page'] = $this->pagination->paginate();
        $data['total_rows'] = $total_rows;

        $this->call->view('user/view', $data);
    }
}

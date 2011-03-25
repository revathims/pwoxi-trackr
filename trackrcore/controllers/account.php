<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Account extends CI_Controller {

    function __construct() {
        global $data;
        parent::__construct();
        $data = $this->init->initi();
        $data['uid'] = $this->init->_get_session_uid();
        $data['cid'] = $this->init->_get_cid();
        $this->load->model('Account_model');
        // check user login and rediret if not login to login page.
        $this->init->_is_not_logged_in_redirect('/login');
        $this->output->enable_profiler(TRUE);
    }

    function index() {
        global $data;

        $data['formtype'] = 'edit';
        $data['some_error'] = FALSE;
        // date helper loaded.
        $this->load->helper('date');
        
        $data['user_info'] = $this->Account_model->get_user_information($data['uid'], $data['cid']);
        
        // form processing
        if (($this->input->post('action') == 'edit')) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|max_length[150]|min_length[3]');
            $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|max_length[150]|min_length[3]');
            $this->form_validation->set_rules('job_title', 'Job Title', 'trim|required|max_length[150]|min_length[3]');
            // if form validation faild
            if ($this->form_validation->run() == FALSE) {
                // do nothing but CI will generate validation errors.
            } else {
                $query = $this->Account_model->update_profile($data['uid'], $data['cid']);
                if ($query) {
                    redirect('account/');
                }
            }
        }

        $data['main_content'] = 'account/form.view.php';
        $this->load->view('template.view.php', $data);
    }

}

/* End of file projects.php */
/* Location: ./application/controllers/projects.php */
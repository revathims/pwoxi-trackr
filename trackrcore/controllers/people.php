<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class People extends CI_Controller {

    function __construct() {
        global $data;
        parent::__construct();
        $data = $this->init->initi();
        $data['uid'] = $this->init->_get_session_uid();
        $data['cid'] = $this->init->_get_cid();
        $this->load->model('People_model');
        // check user login and rediret if not login to login page.
        $this->init->_is_not_logged_in_redirect('/login');
        $this->output->enable_profiler(TRUE);
    }

    function index() {
        global $data;
        $data['people'] = $this->People_model->get_all_people($data['cid']);
        $data['main_content'] = 'people/people.view.php';
        $this->load->view('template.view.php', $data);
    }

    function add() {
        global $data;

        $data['formtype'] = 'add';
        $data['some_error'] = FALSE;

        // form processing
        if (($this->input->post('action') == 'add')) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|max_length[150]|min_length[3]');
            $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|max_length[150]|min_length[3]');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback__email_check');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            $this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|matches[password]');
            // if form validation faild
            if ($this->form_validation->run() == FALSE) {
                // do nothing but CI will generate validation errors.
            } else {
                $query = $this->People_model->add_people($data['cid']);
                if ($query) {
                    redirect('people/');
                }
            }
        }

        $data['main_content'] = 'people/form.view.php';
        $this->load->view('template.view.php', $data);
    }

    // check if email already exisits
    function _email_check() {
        $email = $this->input->post('email');
        $query = $this->People_model->check_email($email);

        // If request is AJAX
        if (IS_AJAX) {
            if ($query == TRUE) {
                echo '<p class="ui-state-error ui-corner-all">Email <strong>' . $email . '</strong> already registered with us.</p>';
            }
        }
        // If request is NOT AJAX
        else {
            if ($query) {
                $this->form_validation->set_message('_email_check', '%s ' . $email . ' already registered with us.');
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

}

/* End of file projects.php */
/* Location: ./application/controllers/projects.php */
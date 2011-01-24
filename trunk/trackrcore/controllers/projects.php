<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Projects extends CI_Controller {

    function __construct() {
        global $data;
        parent::__construct();
        $data = $this->init->initi();
        $data['uid'] = $this->init->_get_session_uid();
        $data['cid'] = $this->init->_get_cid();
        $this->load->model('Projects_model');
        // check user login and rediret if not login to login page.
        $this->init->_is_not_logged_in_redirect('/login');
        $this->output->enable_profiler(TRUE);
    }

    function index() {
        global $data;
        $data['projects'] = $this->Projects_model->get_all_projects($data['cid']);
        $data['main_content'] = 'projects/projects.view.php';
        $this->load->view('template.view.php', $data);
    }

    function add() {
        global $data;

        $data['formtype'] = 'add';
        $data['some_error'] = FALSE;

        // form processing
        if (($this->input->post('action') == 'add')) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('project_name', 'Name', 'trim|required|max_length[150]|min_length[3]');
            $this->form_validation->set_rules('label', 'Label', 'trim|required|max_length[10]|min_length[2]');
            $this->form_validation->set_rules('project_description', 'Description', 'trim|required|max_length[255]|min_length[10]');
            // if form validation faild
            if ($this->form_validation->run() == FALSE) {
                // do nothing but CI will generate validation errors.
            } else {
                $query = $this->Projects_model->add_project($data['cid'], $data['uid']);
                if ($query) {
                    redirect('projects/');
                }
            }
        }

        $data['main_content'] = 'projects/form.view.php';
        $this->load->view('template.view.php', $data);
    }

}

/* End of file projects.php */
/* Location: ./application/controllers/projects.php */
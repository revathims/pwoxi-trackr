<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        global $data;
        parent::__construct();
        $data = $this->init->initi();
        $this->load->model('Login_model');
        $this->output->enable_profiler(TRUE);
    }

    // login page - form
    function index() {
        global $data;
        // @todo need to check if user is already login into the system.
        $this->init->_is_logged_in_redirect('/home');
        $data['incorrect_login'] = FALSE;
        // @todo check here if cookie is enabled on browser or not
        // check if login form is submitted then process the form
        if (($this->input->post('email')) && ($this->input->post('password'))) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            // if form validation passed
            if ($this->form_validation->run() == FALSE) {
                
            } else {
                $query = $this->Login_model->validate_login();
                if ($query) {
                    $get_uid_by_email = $this->Login_model->get_uid_by_email($this->input->post('email'));
                    $login_session_data = array('email' => $this->input->post('email'),
                        'uid' => $get_uid_by_email->uid,
                        'is_logged_in' => '1');
                    $this->session->set_userdata($login_session_data);
                    $update_timestamp = $this->Login_model->set_last_login_timestamp_by_uid($get_uid_by_email->uid);
                    // redirect if login is sucessfull.
                    redirect('home/');
                }
                // if query retruned NULL
                else {
                     $data['incorrect_login'] = TRUE;
                }
            }
        }


        $data['main_content'] = 'login/login.view.php';
        $this->load->view('template_fullbody.view.php', $data);
    }

    // logout process - controlled from routes.
    function logout() {
        global $data;
        $uid = $this->init->_get_session_email();
        $update_timestamp = $this->Login_model->set_last_login_timestamp_by_uid($uid);
        $logout_session_data = array('email' => '', 'uid' => '', 'is_logged_in' => '0');
        $this->session->unset_userdata($logout_session_data);
        $this->session->sess_destroy();
        // redirect if logout is sucessfull.
        redirect('/login');
    }

}
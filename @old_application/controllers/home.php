<?php

class Home extends Controller {

    function Home() {
        parent::Controller();
        global $data;
        $data = $this->init->initi();
        //$this->_is_logged_in();
        //$this->output->enable_profiler(TRUE);
    }

    // home
    function index() {
        global $data;
        // load view
        $data['main_content'] = 'home/home';
        $this->load->view('template', $data);
    }

    // check for user login
    function _is_logged_in() {
        $is_logged_in = $this->session->userdata('is_logged_in');
        if (!isset($is_logged_in) || $is_logged_in != TRUE) {
            redirect('users/');
        }
    }

}

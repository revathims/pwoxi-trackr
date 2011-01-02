<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct() {
        global $data;
        parent::__construct();
        $data = $this->init->initi();
        // check user login and rediret if not login to login page.
        $this->init->_is_not_logged_in_redirect('/login');
        $this->output->enable_profiler(TRUE);
    }

    function index() {
        global $data;
        $data['main_content'] = 'home/home.view.php';
        $this->load->view('template.view.php', $data);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
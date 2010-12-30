<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->output->enable_profiler(TRUE);
    }

    function index() {
        $this->load->view('home/home.view.php');
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
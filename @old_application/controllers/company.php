<?php

class Company extends Controller {

    function Company() {
        parent::Controller();
        global $data, $uid;
        $data = $this->init->initi();
        // redirect if user is not login
        $this->init->_is_not_logged_in_redirect('/users/login');
        // check for main contact for company
        // @todo check for main company contact and redirect according to it.
        // loading company model
        $this->load->model('company_model');
        // getting uid from session
        $uid = $this->init->_get_session_uid();
        $this->output->enable_profiler(TRUE);
    }

    // home
    function index() {
        global $data, $uid;
        $data['company_detail'] = $company_detail = $this->company_model->get_company_detail($uid);
        $data['activity_stream'] = $activity_stream = $this->company_model->get_activity_stream($company_detail['cid']);
        $data['main_content'] = 'company/dashboard';
        $this->load->view('template', $data);
    }

    // all people in company
    function people() {
        global $data, $uid;
        $data['company_detail'] = $company_detail = $this->company_model->get_company_detail($uid);
        // all people in this company
        $data['all_people'] = $all_people = $this->company_model->get_all_people($company_detail['cid']);
        debug($all_people);
        $data['main_content'] = 'company/people';
        $this->load->view('template', $data);
    }

    // all projects in company
    function projects() {
        global $data, $uid;
        $data['company_detail'] = $company_detail = $this->company_model->get_company_detail($uid);
        // all people in this company
        $data['all_projects'] = $all_projects = $this->company_model->get_all_projects($company_detail['cid']);
        $data['all_clients_count'] = $all_clients_count = $this->company_model->get_all_clients_count($company_detail['cid']);
        $data['main_content'] = 'company/projects';
        $this->load->view('template', $data);
    }

    // all clients in company
    function clients() {
        global $data, $uid;
        $data['company_detail'] = $company_detail = $this->company_model->get_company_detail($uid);
        // all cleints in this company
        $data['all_clients'] = $all_clients = $this->company_model->get_all_clients($company_detail['cid']);
        $data['main_content'] = 'company/clients';
        $this->load->view('template', $data);
    }

    // add client to company
    function addclient() {
        global $data, $uid;
        $data['company_detail'] = $company_detail = $this->company_model->get_company_detail($uid);
        $data['some_error'] = FALSE;
        $data['main_content'] = 'company/addclient';
        $this->load->view('template', $data);
    }

    // add client - validation
    function addclient_validate() {
        global $data, $uid;
        $this->load->model('clients_model');
        $data['company_detail'] = $company_detail = $this->company_model->get_company_detail($uid);
        $this->load->library('form_validation');

        // field name, error message, validation rules
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|alpha');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|alpha');
        $this->form_validation->set_rules('email', 'Email', 'trim|max_length[150]|valid_email|required');
        $this->form_validation->set_rules('company_name', 'Company Name', 'required|trim|max_length[150]');
        $this->form_validation->set_rules('contact_type', 'Contact Type', 'trim|max_length[45]');
        $this->form_validation->set_rules('phone', 'Last Name', 'trim|max_length[20]');
        $this->form_validation->set_rules('fax', 'Fax', 'trim|max_length[20]');
        $this->form_validation->set_rules('address', 'Address', 'trim|max_length[250]|prep_for_form');
        $this->form_validation->set_rules('url', 'URL', 'trim|max_length[255]|prep_url');
        
        if ($this->form_validation->run() == FALSE) {
            $data['some_error'] = FALSE;
            $data['main_content'] = 'company/addclient';
            $this->load->view('template', $data);
        } else {
            $query = $this->clients_model->add_client($company_detail['cid']);

            if ($query) {
                redirect('company/clients');
            } else {
                $data['main_content'] = 'company/addclient';
                $data['some_error'] = TRUE;
                $this->load->view('template', $data);
            }
        }
    }

    // settings
    function branding() {
        global $data, $uid;
        // load view
        $data['main_content'] = 'company/branding';
        $data['errors'] = '';
        $data['message'] = '';
        $data['company_detail'] = $this->company_model->get_company_detail($uid);
        $this->load->view('template', $data);
    }

    // upload logo
    function logo_upload() {
        global $data, $uid;
        $data['company_detail'] = $company_detail = $this->company_model->get_company_detail($uid);
        $data['errors'] = '';
        $data['message'] = '';

        $config['upload_path'] = './assets/company-images/';
        $config['allowed_types'] = 'gif|jpeg|jpg|png';
        $config['max_size'] = '100';
        $config['max_width'] = '200';
        $config['max_height'] = '600';
        // @todo need to fix file_name parameter for 1.7.2.patch1 from CI core.
        $config['file_name'] = 'clogo-' . $company_detail['cid'];
        $config['overwrite'] = TRUE;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('upload_logo') == FALSE) {
            $data['errors'] = $this->upload->display_errors('<p class="ui-state-error ui-corner-all">', '</p>');
        } else {
            $data['upload_data'] = $upload_data = $this->upload->data();

            // update the company for the logo filename.
            $logo_upload = $this->company_model->set_logo_by_cid($company_detail['cid'], $upload_data['file_name']);
            // settings success message
            $data['message'] = 'Your logo is uploaded successfully, but it could take time to appear on site.';
        }

        // load view
        $data['main_content'] = 'company/branding';
        $this->load->view('template', $data);
    }

    // delete logo via ajax
    function delete_logo() {
        global $data, $uid;
        if (IS_AJAX) { // if request is AJAX
            $cid = $this->input->post('cid', TRUE);
            if (!$cid) {
                echo '<p class="ui-state-error ui-corner-all">Opss! Something is wrong.</p>';
            } else {
                $company_detail = $this->company_model->get_company_detail($uid);
                echo '<p class="ui-state-highlight ui-corner-all">Your logo is now removed successfully, but it could take time to effect on site.</p>';
                // set logo field blank
                $logo_upload = $this->company_model->set_logo_by_cid($company_detail['cid'], '');

                // @todo check for linux/unix file system if works or not
                // delete file from filesystem
                // unlink('/'.config_item('company_images_path').$company_detail['logo']);
            }
        }
        // securing AJAX request.
        else {
            set_status_header(404);
            show_404('page');
        }
    }

    // company information - update on db
    function settings_update() {
        global $data, $uid;
        $data['company_detail'] = $company_detail = $this->company_model->get_company_detail($uid);

        $data['errors'] = '';
        $data['message'] = '';

        $this->load->library('form_validation');
        // field name, error message, validation rules
        $this->form_validation->set_rules('company_name', 'Company Name', 'trim|max_length[150]');
        $this->form_validation->set_rules('phone', 'Last Name', 'trim|max_length[20]');
        $this->form_validation->set_rules('fax', 'Fax', 'trim|max_length[20]');
        $this->form_validation->set_rules('url', 'URL', 'trim|max_length[255]|prep_url');
        $this->form_validation->set_rules('address', 'Address', 'trim|max_length[250]|prep_for_form');

        if ($this->form_validation->run() == FALSE) {
            $data['errors'] = '';
        } else {
            $query = $this->company_model->set_company_data_by_cid($company_detail['cid']);
            if ($query) {
                $data['message'] = 'Company information is updated successfully, but it could take time to effect on site.';
            } else {
                $data['errors'] = '<p class="ui-state-error ui-corner-all">Opps! There was some problem while updating company information, please try again.</p>';
            }
        }

        $data['main_content'] = 'company/branding';
        $this->load->view('template', $data);
    }

}
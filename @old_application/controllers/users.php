<?php

class Users extends Controller {

    function Users() {
        parent::Controller();
        global $data, $uid;
        $data = $this->init->initi();
        // loading model by default
        $this->load->model('users_model');
        // getting uid from session
        $uid = $this->init->_get_session_uid();
        //$this->output->enable_profiler(TRUE);
    }

    // home
    function index() {
        global $data, $uid;
        // redirect if user is not login
        $this->init->_is_not_logged_in_redirect('/users/login');
        $data['incorrect_login'] = FALSE;
        $data['main_content'] = 'users/dashboard';
        $this->load->view('template', $data);
    }

    // profile
    function profile() {
        global $data, $uid;
        // redirect if user is not login
        $this->init->_is_not_logged_in_redirect('/users/login');
        $data['user_detail'] = $user_detail = $this->users_model->get_user_detail($uid);
        $data['incorrect_login'] = FALSE;
        $data['errors'] = '';
        $data['message'] = '';
        $data['main_content'] = 'users/profile';
        $this->load->view('template', $data);
    }

    // change password
    function changepassword() {
        global $data, $uid;
        // redirect if user is not login
        $this->init->_is_not_logged_in_redirect('/users/login');
        $data['user_detail'] = $user_detail = $this->users_model->get_user_detail($uid);
        $data['errors'] = '';
        $data['message'] = '';

        // form submission processing - POST method.
        if ($this->input->post('action') == 'changepassword') {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('current_password', 'Current Password', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]');
            $this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|required|matches[password]');
            if ($this->form_validation->run() == FALSE) {
                // validation array will pass to view automatically.
            }
            // if validation is passed
            else {
                // check for current password.
                $login_username = $this->init->_get_session_username();
                $current_password = $this->input->post('current_password');
                $current_password_validation = $this->users_model->validate_manual($login_username, $current_password);
                if ($current_password_validation) {
                    // change password
                    $this->users_model->set_password_by_uid($uid);
                    // sending out password change email notification.

                    $data['message'] = 'Your password is now changed successfully, but you need to sign in again to make it work properly.';
                } else {
                    $data['errors'] = '<p class="ui-state-error ui-corner-all">Your entered current password did not match records in our system, please try again.</p>';
                }
            }
        }

        $data['main_content'] = 'users/changepassword';
        $this->load->view('template', $data);
    }

    // upload picture
    function picture_upload() {
        global $data, $uid;
        // redirect if user is not login
        $this->init->_is_not_logged_in_redirect('/users/login');
        $data['user_detail'] = $user_detail = $this->users_model->get_user_detail($uid);
        $data['errors'] = '';
        $data['message'] = '';

        $config['upload_path'] = config_item('profile_images_path');
        $config['allowed_types'] = 'gif|jpeg|jpg|png';
        $config['max_size'] = '100';
        $config['max_width'] = '100';
        $config['max_height'] = '600';
        // @todo need to fix file_name parameter for 1.7.2.patch1 from CI core.
        $config['file_name'] = 'ppic-' . $user_detail['uid'];
        $config['overwrite'] = TRUE;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('upload_picture') == FALSE) {
            $data['errors'] = $this->upload->display_errors('<p class="ui-state-error ui-corner-all">', '</p>');
        } else {
            $data['upload_data'] = $upload_data = $this->upload->data();

            // update the company for the logo filename.
            $logo_upload = $this->users_model->set_picture_by_uid($uid, $upload_data['file_name']);
            // settings success message
            $data['message'] = 'Your picture is uploaded successfully, but it could take time to appear on site.';
        }

        // load view
        $data['main_content'] = 'users/profile';
        $this->load->view('template', $data);
    }

    // delete logo via ajax
    function delete_picture() {
        global $data, $uid;
        // redirect if user is not login
        $this->init->_is_not_logged_in_redirect('/users/login');
        if (IS_AJAX) { // if request is AJAX
            $uid_posted = $this->input->post('uid', TRUE);
            if (!$uid_posted) {
                echo '<p class="ui-state-error ui-corner-all">Opss! Something is wrong.</p>';
            } else {
                $user_detail = $this->users_model->get_user_detail($uid);
                echo '<p class="ui-state-highlight ui-corner-all">Your picture is now removed successfully, but it could take time to effect on site.</p>';
                // set logo field blank
                $logo_upload = $this->users_model->set_picture_by_uid($uid_posted, '');

                // @todo check for linux/unix file system if works or not
                // delete file from filesystem
                //unlink('/'.config_item('profile_images_path').$user_detail['profile_pic']);
            }
        }
        // securing AJAX request.
        else {
            set_status_header(404);
            show_404('page');
        }
    }

    // profile information - update on db
    function profile_update() {
        global $data, $uid;
        // redirect if user is not login
        $this->init->_is_not_logged_in_redirect('/users/login');
        $data['user_detail'] = $user_detail = $this->users_model->get_user_detail($uid);
        $data['errors'] = '';
        $data['message'] = '';

        $this->load->library('form_validation');
        // field name, error message, validation rules
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|max_length[45]');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|max_length[45]');
        $this->form_validation->set_rules('job_title', 'Job Title', 'trim|max_length[100]');
        $this->form_validation->set_rules('email', 'Email', 'trim|max_length[150]|valid_email|required');

        if ($this->form_validation->run() == FALSE) {
            $data['errors'] = '';
        } else {
            $query = $this->users_model->set_user_data_by_uid($uid);
            if ($query) {
                $data['message'] = 'Profile information is updated successfully, but it could take time to effect on site.';
            } else {
                $data['errors'] = '<p class="ui-state-error ui-corner-all">Opps! There was some problem while updating your profile information, please try again.</p>';
            }
        }

        $data['main_content'] = 'users/profile';
        $this->load->view('template', $data);
    }

    // login
    function login() {
        global $data;
        $data['incorrect_login'] = FALSE;
        $data['main_content'] = 'users/login_form';
        $this->load->view('template', $data);
    }

    // reset password
    function reset() {
        global $data;

        $data['message'] = '';
        $data['errors'] = '';

        // form processing - if request is POST
        if ($this->input->post('action') == 'resetpassword') {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            // if validation is passed
            if ($this->form_validation->run() != FALSE) {

                // checking if exists
                $check_email = $this->users_model->check_email($this->input->post('email'));
                if ($check_email) {
                    // @todo add email stuff here.
                    $data['message'] = 'Email message containing help on how to reset your password is on the way.';
                }
                // if email does not exisits.
                else {
                    $data['errors'] = 'The email used did not match our records. Please try again.';
                }
            }
        }

        $data['main_content'] = 'users/reset_password';
        $this->load->view('template', $data);
    }

    // login validation and login process
    function validate() {
        global $data;
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data['incorrect_login'] = FALSE;
            $data['main_content'] = 'users/login_form';
            $this->load->view('template', $data);
        } else {
            $query = $this->users_model->validate();

            // if the user's credentials validated...
            if ($query) {
                //getting uid by username
                $login_user = $this->users_model->get_uid_by_username($this->input->post('username'));
                log_message('info', 'UID By Username: ' . $login_user->uid);
                log_message('info', 'Main Contact By Username: ' . $login_user->main_contact);
                // update user's timestamp.
                $update_timestamp = $this->users_model->set_last_login_timestamp_by_uid($login_user->uid);
                $login_session_data = array('username' => $this->input->post('username'),
                    'uid' => $login_user->uid,
                    'main_contact' => $login_user->main_contact,
                    'is_logged_in' => TRUE);
                $this->session->set_userdata($login_session_data);
                redirect('home/');
            }
            // incorrect username or password
            else {
                $data['main_content'] = 'users/login_form';
                $data['incorrect_login'] = TRUE;
                $this->load->view('template', $data);
            }
        }
    }

    // sign up page
    function signup() {
        global $data;
        $data['some_error'] = FALSE;
        $data['main_content'] = 'users/signup_form';
        $this->load->view('template', $data);
    }

    // signup validation process
    function validatesignup() {
        global $data;
        $this->load->library('form_validation');

        // field name, error message, validation rules
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|alpha');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|alpha');
        $this->form_validation->set_rules('company_name', 'Company Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_email_check');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]|alpha_numeric|callback_username_check');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|required|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            $data['some_error'] = FALSE;
            $data['main_content'] = 'users/signup_form';
            $this->load->view('template', $data);
        } else {
            $query = $this->users_model->create_user();

            if ($query) {
                redirect('users/success');
            } else {
                $data['main_content'] = 'users/signup_form';
                $data['some_error'] = TRUE;
                $this->load->view('template', $data);
            }
        }
    }

// add people
    function addpeople() {
        global $data, $uid;
        // redirect if user is not login
        $this->init->_is_not_logged_in_redirect('/users/login');
        $data['errors'] = '';
        $data['message'] = '';
        $this->load->model('company_model');
        // load view
        $data['company_detail'] = $this->company_model->get_company_detail($uid);
        $data['main_content'] = 'users/addpeople';
        $this->load->view('template', $data);
    }

    // add people validation process
    function addpeople_validate() {
        global $data, $uid;
        // redirect if user is not login
        $this->init->_is_not_logged_in_redirect('/users/login');
        $this->load->model('company_model');
        $data['company_detail'] = $company_detail = $this->company_model->get_company_detail($uid);
        $data['errors'] = '';
        $data['message'] = '';
        $this->load->library('form_validation');

        // field name, error message, validation rules
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|alpha');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|alpha');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_email_check');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]|alpha_numeric|callback_username_check');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|required|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            // pass validation messages on view.
        } else {
            $query = $this->users_model->add_company_user($company_detail['cid']);
            if ($query) {
                $data['message'] = 'New person is now added successfully, but it could take time to effect on site.';
            } else {
                $data['errors'] = '<p class="ui-state-error ui-corner-all">Opps! There was some problem while adding new person, please try again.</p>';
            }
        }
        $data['main_content'] = 'users/addpeople';
        $this->load->view('template', $data);
    }

    // check username if username already exists
    function username_check() {
        $username = $this->input->post('username');
        $query = $this->users_model->check_username($username);
        // if request is AJAX
        if (IS_AJAX) {
            if ($query == TRUE) {
                echo '<p class="ui-state-error ui-corner-all">Username <strong>' . $username . '</strong> already is taken by someone else.</p>';
            }
        }
        // if request is NOT AJAX
        else {
            if ($query == TRUE) {
                $this->form_validation->set_message('username_check', '%s <strong>' . $username . '</strong> already is taken by someone else.');
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

    // check if email already exisits
    function email_check() {
        $email = $this->input->post('email');
        $query = $this->users_model->check_email($email);

        // If request is AJAX
        if (IS_AJAX) {
            if ($query == TRUE) {
                echo '<p class="ui-state-error ui-corner-all">Email <strong>' . $email . '</strong> already registered with us.</p>';
            }
        }
        // If request is NOT AJAX
        else {
            if ($query) {
                $this->form_validation->set_message('email_check', '%s <strong>' . $email . '</strong> already registered with us.');
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

    // signup sucess message
    function success() {
        global $data, $uid;
        $data['main_content'] = 'users/signup_successful';
        $this->load->view('template', $data);
    }

    // sign out
    function signout() {
        global $data, $uid;
        // update user's timestamp.
        $update_timestamp = $this->users_model->set_last_login_timestamp_by_uid($uid);
        $this->session->sess_destroy();
        redirect('users/');
    }

}


<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Init Class
 *
 * Common Init library.
 *
 * @author		Arfeen Arif
 * @version		1.0.0
 */
class Init {

    function Init() {
        $CI = & get_instance();
    }

    /* Init function */

    function initi() {
        $CI = & get_instance();
        $data['site_name'] = $CI->config->item('site_name');
        $data['base_url'] = $CI->config->item('base_url');
        $data['site_email'] = $CI->config->item('site_email');
        $data['site_version'] = $CI->config->item('site_version');
        $data['site_beta'] = $CI->config->item('site_beta');
        $datestring = "%l %F %j, %Y";
        $time = time();
        $data['today'] = mdate($datestring, $time);
        log_message('info', $data['site_name'] . ' ' . $data['site_version'] . ' Initialized');
        return $data;
    }

    // get uid from session
    function _get_session_uid() {
        $CI = & get_instance();
        $uid = $CI->session->userdata('uid');
        return $uid;
    }
				
				// get username from session
    function _get_session_username() {
        $CI = & get_instance();
        $uid = $CI->session->userdata('username');
        return $uid;
    }

// checking for already login
    function _is_logged_in_redirect($redirect_url) {
        $CI = & get_instance();
        $is_logged_in = $CI->session->userdata('is_logged_in');
        if (isset($is_logged_in) || $is_logged_in == TRUE) {
            // @todo CI is initialized twice due the redirect, need to verify and fix it.
            redirect($redirect_url);
        }
    }

    // checking if user is not login
    function _is_not_logged_in_redirect($redirect_url) {
        $CI = & get_instance();
        $is_logged_in = $CI->session->userdata('is_logged_in');
        if (!isset($is_logged_in) || $is_logged_in != TRUE) {
            // @todo CI is initialized twice due the redirect, need to verify and fix it.
            redirect($redirect_url);
        }
    }

     /**
     * Insert new log entry for user action.
     * @access	public
     * @param int $uid User ID
     * @param str $type Action Type
     * @param int $id Action ID
     * @return mixed
     */
       function add_log($uid, $type, $id) {
        // setting up array for user insert
        $data = array(
            'cid' => $cid,
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'company_name' => $this->input->post('company_name'),
            'email' => $this->input->post('email'),
            'phone' => $this->input->post('phone'),
            'fax' => $this->input->post('fax'),
            'url' => $this->input->post('url'),
            'address' => $this->input->post('address'),
            'contact_type' => '0', // FALSE
            'datecreated' => time()
        );

        // insert into db - users
        $insert_cleint = $this->db->insert('clients', $new_client_insert_data);
        // getting last instered uid from DB
        $clientid = $this->db->insert_id();
        // @todo add email notification and avtivty stream db insert.

        log_message('info', 'Last Cleint ID: ' . $clientid);
        return $insert_cleint;
    }


    /* End of function */
}
?>

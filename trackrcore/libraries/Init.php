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

    /**
     * General site data retrival
     * @access public
     * @return mixed
     */
    function initi() {
        $CI = & get_instance();
        $data['site_name'] = $CI->config->item('site_name');
        $data['base_url'] = $CI->config->item('base_url');
        $data['site_email'] = $CI->config->item('site_email');
        $data['site_version'] = $CI->config->item('site_version');
        $data['site_beta'] = $CI->config->item('site_beta');
        log_message('info', $data['site_name'] . ' ' . $data['site_version'] . ' Initialized');
        return $data;
    }

    // get uid from session
    function _get_session_uid() {
        $CI = & get_instance();
        $uid = $CI->session->userdata('uid');
        return $uid;
    }

    // get cid from user's session
    function _get_cid() {
        $CI = & get_instance();
        $uid = $CI->session->userdata('uid');
        $CI->db->select('companies.cid');
        $CI->db->from('companies');
        $CI->db->where('uid', $uid);
        $CI->db->join('users', 'companies.cid = users.cid', 'inner');
        $query = $CI->db->get();
        if ($query->num_rows == 1) {
            $row = $query->row();
            return $row->cid;
        } else {
            return NULL;
        }
    }

    // get username from session
    function _get_session_email() {
        $CI = & get_instance();
        $uid = $CI->session->userdata('email');
        return $uid;
    }

// checking for already login
    function _is_logged_in_redirect($redirect_url) {
        $CI = & get_instance();
        $is_logged_in = $CI->session->userdata('is_logged_in');
        if ($is_logged_in == '1') {
            // @todo CI is initialized twice due the redirect, need to verify and fix it.
            redirect($redirect_url);
        }
    }

    // checking if user is not login
    function _is_not_logged_in_redirect($redirect_url) {
        $CI = & get_instance();
        $is_logged_in = $CI->session->userdata('is_logged_in');
        if ($is_logged_in == '0') {
            // @todo CI is initialized twice due the redirect, need to verify and fix it.
            redirect($redirect_url);
        }
    }

    /* End of function */
}

?>

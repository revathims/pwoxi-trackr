<?php

class Login_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * Determines if the user submitted form for password and username is validated in the DB or not.
     * @access	public
     * @return bool
     */
    function validate_login() {
        $this->db->where('email', $this->input->post('email'));
        $this->db->where('password', md5($this->input->post('password')));
        $query = $this->db->get('users');
        if ($query->num_rows == 1) {
            return TRUE;
        }
    }

    /**
     * Determines if the password and username is validated in the DB or not.
     * @access	public
     * @param string $email Email
     * @param string $password Password
     * @return bool
     */
    function validate_login_manual($email, $password) {
        $this->db->where('email', $email);
        $this->db->where('password', md5($password));
        $query = $this->db->get('users');

        if ($query->num_rows == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Update user's last login timestamp
     * @access	public
     * @param int $uid Login user id from the session.
     * @return bool
     */
    function set_last_login_timestamp_by_uid($uid) {
        $data = array(
            'last_login_on' => time()
        );
        $this->db->where('uid', $uid);
        $update = $this->db->update('users', $data);
        return $update;
    }

    /**
     * Get UID by Email
     * @access	public
     * @param int $uid Login user id from the session.
     * @return bool
     */
    function get_uid_by_email($email) {
        $this->db->select('uid');
        $this->db->where('email', $email);
        $query = $this->db->get('users');
        if ($query->num_rows == 1) {
            $row = $query->row();
            return $row;
        } else {
            return FALSE;
        }
    }

}
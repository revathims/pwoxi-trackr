<?php

class Users_model extends Model {

    /**
     * Determines if the user submitted form for password and username is validated in the DB or not.
     * @access	public
     * @return bool
     */
    function validate() {
        $this->db->where('username', $this->input->post('username'));
        $this->db->where('password', md5($this->input->post('password')));
        $query = $this->db->get('users');

        if ($query->num_rows == 1) {
            return TRUE;
        }
    }

    /**
     * Determines if the password and username is validated in the DB or not.
     * @access	public
     * @param string $username Username
     * @param string $password Password
     * @return bool
     */
    function validate_manual($username, $password) {
        $this->db->where('username', $username);
        $this->db->where('password', md5($password));
        $query = $this->db->get('users');

        if ($query->num_rows == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Get all the data for user table  from the database by user id
     * @access	public
     * @param int $uid Login user id from the session.
     * @return mixed
     */
    function get_user_detail($uid) {
        $select_array = array('uid', 'cid', 'first_name', 'last_name', 'job_title', 'email', 'username', 'main_contact', 'profile_pic');
        $this->db->select($select_array);
        $this->db->from('users');
        $this->db->where('uid', $uid);
        $query = $this->db->get();
        if ($query->num_rows == 1) {
            return $query->row_array();
        }
    }

    /**
     * Set profile picture filename into database by user id
     * @access	public
     * @param int $uid Login user id from the session.
     * @param string $profile_pic  Picture filename
     * @return bool
     */
    function set_picture_by_uid($uid, $profile_pic) {
        $data = array(
            'profile_pic' => $profile_pic
        );
        $this->db->where('uid', $uid);
        $this->db->update('users', $data);
    }

    /**
     * Update user's last login timestamp
     * @access	public
     * @param int $uid Login user id from the session.
     * @return bool
     */
    function set_last_login_timestamp_by_uid($uid) {
        $data = array(
            'lastlogin' => time()
        );
        $this->db->where('uid', $uid);
        $update = $this->db->update('users', $data);
        return $update;
    }

    /**
     * Set profile user data into database by user id
     * @access	public
     * @param int $uid Login user id from the session.
     * @return bool
     */
    function set_user_data_by_uid($uid) {
        $data = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'job_title' => $this->input->post('job_title'),
            'email' => $this->input->post('email'),
        );
        $this->db->where('uid', $uid);
        $update_profile = $this->db->update('users', $data);
        log_message('info', 'User Information Updated');
        return $update_profile;
    }

    /**
     * Update password into database by user id
     * @access	public
     * @param int $uid Login user id from the session.
     * @return bool
     */
    function set_password_by_uid($uid) {
        $data = array(
            'password' => md5($this->input->post('password'))
        );
        $this->db->where('uid', $uid);
        $update_profile = $this->db->update('users', $data);
        log_message('info', 'Password Changed.');
        return $update_profile;
    }

    function get_uid_and_main_contact_by_username($username) {
        $this->db->select('uid');
        $this->db->select('main_contact');
        $this->db->where('username', $username);
        $query = $this->db->get('users');
        if ($query->num_rows == 1) {
            $row = $query->row();
            return $row;
        } else {
            return FALSE;
        }
    }

    function check_username($username) {
        $this->db->where('username', $username);
        $query = $this->db->get('users');
        if ($query->num_rows == 1) {
            return TRUE;
        }
    }

    function check_email($email) {
        $this->db->where('email', $email);
        $query = $this->db->get('users');
        if ($query->num_rows == 1) {
            return TRUE;
        }
    }

    function create_user() {
        // setting up array for company insert
        $new_company_insert_data = array(
            'company_name' => $this->input->post('company_name'));

        // insert company into db - companies
        $company_insert = $this->db->insert('companies', $new_company_insert_data);
        $cid = $this->db->insert_id();
        log_message('info', 'Last CID: ' . $cid);

        // setting up array for user insert
        $new_user_insert_data = array(
            'cid' => $cid,
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'job_title' => '',
            'email' => $this->input->post('email'),
            'username' => $this->input->post('username'),
            'password' => md5($this->input->post('password')),
            'main_contact' => '1', // TRUE
            'datecreated' => time()
        );

        // insert into db - users
        $insert_user = $this->db->insert('users', $new_user_insert_data);
        // getting last instered uid from DB
        $uid = $this->db->insert_id();
        log_message('info', 'Last UID: ' . $uid);

        return $insert_user;
    }

    function add_company_user($cid) {
        // setting up array for user insert
        $new_user_insert_data = array(
            'cid' => $cid,
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'job_title' => $this->input->post('job_title'),
            'email' => $this->input->post('email'),
            'username' => $this->input->post('username'),
            'password' => md5($this->input->post('password')),
            'main_contact' => '0', // FALSE
            'datecreated' => time()
        );

        // insert into db - users
        $insert_user = $this->db->insert('users', $new_user_insert_data);
        // getting last instered uid from DB
        $uid = $this->db->insert_id();
        log_message('info', 'Last UID: ' . $uid);
        return $insert_user;
    }

}
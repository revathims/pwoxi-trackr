<?php

class Account_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function update_profile($uid, $cid) {
        // setting up array for project insert
        $update_data = array(
            'cid' => $cid,
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'job_title' => $this->input->post('job_title'),
            'updated_date' => time()
        );

        // insert into db - users
        $this->db->where('uid', $uid);
        $this->db->where('cid', $cid);
        $update_profile = $this->db->update('users', $update_data);
        $this->session->set_flashdata('profile_update', 'Profile Updated.');
        // getting last instered uid from DB
        return $update_profile;
    }

    /**
     * Get all the people in the selected company.
     * @access	public
     * @param int $cid Company ID
     * @return bool
     */
    function get_user_information($uid, $cid) {
        $this->db->select("*");
        $this->db->from('users');
        $this->db->where('cid', $cid);
        $this->db->where('uid', $uid);
        $query = $this->db->get();
        if ($query->num_rows >= 1) {
            return $query->row_array();
        }
    }

}
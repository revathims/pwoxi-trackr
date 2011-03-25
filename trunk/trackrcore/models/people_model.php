<?php

class People_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function add_people($cid) {
        // setting up array for project insert
        $new_insert_data = array(
            'cid' => $cid,
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'email' => $this->input->post('email'),
            'password' => md5($this->input->post('password')),
            'created_date' => time()
        );

        // insert into db - users
        $insert_people = $this->db->insert('users', $new_insert_data);
        // getting last instered uid from DB
        $people_id = $this->db->insert_id();
        log_message('info', 'Last People ID: ' . $people_id);
        return $insert_people;
    }

    /**
     * Get all the people in the selected company.
     * @access	public
     * @param int $cid Company ID
     * @return bool
     */
    function get_all_people($cid) {
        $this->db->select("*");
        $this->db->from('users');
        $this->db->where('cid', $cid);
        $this->db->order_by("first_name", "asc");
        $query = $this->db->get();
        if ($query->num_rows >= 1) {
            return $query->result_array();
        }
    }

    function check_email($email) {
        $this->db->where('email', $email);
        $query = $this->db->get('users');
        if ($query->num_rows == 1) {
            return TRUE;
        }
    }

}
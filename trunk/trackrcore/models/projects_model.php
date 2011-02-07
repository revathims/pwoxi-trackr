<?php

class Projects_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function add_project($cid, $uid) {
        // setting up array for project insert
        $new_insert_data = array(
            'cid' => $cid,
            'uid' => $uid,
            'project_name' => $this->input->post('project_name'),
            'label' => $this->input->post('label'),
            'project_description' => $this->input->post('project_description'),
            'created_date' => time()
        );

        // insert into db - projects
        $insert_project = $this->db->insert('projects', $new_insert_data);
        // getting last instered uid from DB
        $project_id = $this->db->insert_id();
        log_message('info', 'Last Project ID: ' . $project_id);
        return $insert_project;
    }

    /**
     * Get all the projects in the selected company.
     * @access	public
     * @param int $cid Company ID
     * @return bool
     */
    function get_all_projects($cid) {
        $this->db->select("*");
        $this->db->from('projects');
        $this->db->where('cid', $cid);
        $this->db->order_by("created_date", "desc");
        $query = $this->db->get();
        if ($query->num_rows >= 1) {
            return $query->result_array();
        }
    }

}
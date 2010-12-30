<?php

class Company_model extends Model {

    /**
     * Get company detail by passing user id as identifier.
     * @access	public
     * @param int $uid User ID
     * @return mixed
     */
    function get_company_detail($uid) {
        $this->db->select('companies.cid, companies.company_name, companies.phone, companies.fax, companies.address, companies.url, companies.logo');
        $this->db->from('companies');
        $this->db->where('uid', $uid);
        $this->db->join('users', 'companies.cid = users.cid', 'inner');
        $query = $this->db->get();
        if ($query->num_rows == 1) {
            return $query->row_array();
        }
    }

    /**
     * Update company logo by passing Company ID & Logo filename
     * @access	public
     * @param int $cid Company ID
     * @param str $cid Logo filename
     * @return bool
     */
    function set_logo_by_cid($cid, $logo) {
        $data = array(
            'logo' => $logo
        );
        $this->db->where('cid', $cid);
        $update = $this->db->update('companies', $data);
        return $update;
    }

    /**
     * Update company data by passing Company ID
     * @access	public
     * @param int $cid Company ID
     * @return bool
     */
    function set_company_data_by_cid($cid) {
        $data = array(
            'company_name' => $this->input->post('company_name'),
            'phone' => $this->input->post('phone'),
            'fax' => $this->input->post('fax'),
            'address' => $this->input->post('address'),
            'url' => $this->input->post('url')
        );
        $this->db->where('cid', $cid);
        $update_company = $this->db->update('companies', $data);
        log_message('info', 'Company Information Updated');
        return $update_company;
    }

    /**
     * Get all the users in the selected company.
     * @access	public
     * @param int $cid Company ID
     * @return bool
     */
    function get_all_people($cid) {
        $select_array = array('uid', 'cid', 'first_name', 'last_name', 'email', 'username', 'main_contact', 'profile_pic');
        $this->db->select($select_array);
        $this->db->from('users');
        $this->db->where('cid', $cid);
        $query = $this->db->get();
        if ($query->num_rows >= 1) {
            return $query->result_array();
        }
    }

    /**
     * Get all the projects in the selected company.
     * @access	public
     * @param int $cid Company ID
     * @return bool
     */
    function get_all_projects($cid) {

        $this->db->select('*');
        $this->db->from('projects');
        $this->db->where('cid', $cid);
        $query = $this->db->get();
        if ($query->num_rows >= 1) {
            return $query->result_array();
        }
    }

     /**
     * Get all the clients in the selected company.
     * @access	public
     * @param int $cid Company ID
     * @return bool
     */
    function get_all_clients($cid) {

        $this->db->select('*');
        $this->db->from('clients');
        $this->db->where('cid', $cid);
        $query = $this->db->get();
        if ($query->num_rows >= 1) {
            return $query->result_array();
        }
    }

         /**
     * Get the count for clients in the selected company.
     * @access	public
     * @param int $cid Company ID
     * @return mixed
     */
    function get_all_clients_count($cid) {

        $this->db->where('cid', $cid);
        $this->db->from('clients');
        $query = $this->db->count_all_results();
        return $query;
       
    }

    /**
     * Get the activity stream based on Company.
     * @access	public
     * @param int $cid Company ID
     * @return mixed
     */
    function get_activity_stream($cid) {
        $this->db->select('*');
        $this->db->from('logging');
        $this->db->where('cid', $cid);
        $this->db->order_by("datelogged", "desc");
        $query = $this->db->get();
        if ($query->num_rows >= 1) {
            return $query->result_array();
        }
    }

}
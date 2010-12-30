<?php

class Clients_model extends Model {

    
   function add_client($cid) {
        // setting up array for user insert
        $new_client_insert_data = array(
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
        // adding log for this ad event.
        $event_array = array(
            'text' => $new_client_insert_data['company_name'].' is added as one of clients.',
            'uid' => $this->session->userdata('uid'),
            'cid' => $cid,
            'type' => 'clients',
            'targetid' => $clientid,
            'datelogged' => time(),
            );
        $add_log = $this->db->insert('logging', $event_array);

        // @todo add email notification.

        log_message('info', 'Last Cleint ID: ' . $clientid);
        return $insert_cleint;
    }

}
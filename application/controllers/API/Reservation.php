<?php

class Reservation extends CI_Controller {

    public function get() {
        $this->load->database();
        $id = $this->input->get('id');
        $options = [];
        if ($id) $options['id'] = $id;
        $data = $this->db->get_where('venue_reservations', $options)->result();

        return $this->output
                ->set_content_type('Content-Type: application/json;')
                ->set_output(json_encode($data));
    }

    public function insert() {
        $data = [
            'placement' => $this->input->post('placement'),
            'since' => $this->input->post('since'),
            'until' => $this->input->post('until'),
            'name' => $this->input->post('name'),
            'createdAt' => $this->input->post('createdAt'),
            'user' => $this->input->post('user'),
        ];

        $this->db->insert('venue_reservations', $data);
        return $this->output
                    ->set_content_type('Content-Type: application/json;')
                    ->set_output(json_encode($data));
    }
}
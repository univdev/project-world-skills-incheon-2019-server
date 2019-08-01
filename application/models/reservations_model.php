<?php

class Reservations_model extends CI_Model {

    public function get() {
        $this->load->database();
        return $this->db->get('venue_reservations');
    }
}
<?php

class Reservations extends CI_Controller {
    
    public function get($id = null) {
        $this->load->model('reservations_model');
        $config = [];
        if ($id) $config['idx'] = $id;

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($this->reservations_model->get()));
    }
}
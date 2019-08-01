<?php

class Rental extends CI_Controller {
    public function index() {
        $this->load->library('javascript');
        $this->load->library('javascript/jquery', FALSE);
        $this->load->library('parser');
        $header = [
            'link' => [
                ['href' => '/common/jquery-ui-1.12.1.custom/jquery-ui.css'],
                ['href' => '/common/css/common.css',],
                ['href' => '/common/css/rental.css',],
            ]
        ];
        $this->parser->parse('header', $header);
        $this->load->view('rental');
        $this->load->view('footer');
    }
}
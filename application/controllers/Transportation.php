<?php

class Transportation extends CI_Controller {
    public function index() {
        $this->load->library('parser');
        $header = [
            'link' => [
				['href' => '/common/jquery-ui-1.12.1.custom/jquery-ui.css'],
				['href' => '/common/css/common.css',],
                ['href' => '/common/css/transportation.css',],
			],
        ];
        $this->parser->parse('header', $header);
        $this->load->view('transportation');
        $this->load->view('footer');
    }
}
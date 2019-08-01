<?php

class Test extends CI_Controller {
    public function index() {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', '이름', 'required', [
            'required' => '반드시 %s를 입력해주세요',
        ]);
        
        if (!$this->form_validation->run()) {
            $this->load->view('form');
            echo 3;
            exit;
        }
    }
}
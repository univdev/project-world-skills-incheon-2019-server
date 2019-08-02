<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *
 * Controller API/Transportation
 *
 * This controller for ...
 *
 * @package   CodeIgniter
 * @category  Controller CI
 * @author    Setiawan Jodi <jodisetiawan@fisip-untirta.ac.id>
 * @author    Raul Guerrero <r.g.c@me.com>
 * @link      https://github.com/setdjod/myci-extension/
 * @param     ...
 * @return    ...
 *
 */

class Transportation extends CI_Controller
{
    
  public function __construct()
  {
    parent::__construct();
  }

  public function init() {
    $this->load->database();
    $data = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'].'/data/transportation.json'));
    $transportations = $data->transportations ?: [];
    foreach($transportations as $key => $item) {
      $query = [];
      foreach ($item as $key => $data) {
        # code...
        $query[$key] = is_array($data) ? json_encode($data) : $data;
      }
      $this->db->insert('transportations', $query);
    }
  }

  public function get()
  {
    $this->load->database();
    $data = json_encode($this->db->get('transportations')->result());

    return $this->output
                ->set_content_type('application/json')
                ->set_output($data);
  }

}


/* End of file API/Transportation.php */
/* Location: ./application/controllers/API/Transportation.php */
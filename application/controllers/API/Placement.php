<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *
 * Controller Placement
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

class Placement extends CI_Controller
{
    
  public function __construct()
  {
    parent::__construct();
  }

  public function init() {
    $this->load->database();
    $data = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'].'/data/placement.json'));
    $places = $data->places ?: [];
    foreach($places as $key => $item) {
      $query = [];
      foreach ($item as $key => $data) {
        # code...
        $query[$key] = is_array($data) ? json_encode($data) : $data;
      }
      $this->db->insert('placements', $query);
    }
  }

  public function get()
  {
    $this->load->database();

    $data = $this->db->get('placements')->result();

    $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
  }

}


/* End of file Placement.php */
/* Location: ./application/controllers/Placement.php */
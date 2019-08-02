<?php
defined('BASEPATH') or exit('No direct script access allowed');
// Don't forget include/define REST_Controller path

/**
 *
 * Controller API/TransportationReservation
 *
 * This controller for ...
 *
 * @package   CodeIgniter
 * @category  Controller CI/REST
 * @author    Setiawan Jodi <jodisetiawan@fisip-untirta.ac.id>
 * @author    Raul Guerrero <r.g.c@me.com>
 * @link      https://github.com/setdjod/myci-extension/
 * @param     ...
 * @return    ...
 *
 */

class Transportation_reservation extends CI_Controller
{
    
  public function __construct()
  {
    parent::__construct();
  }

  public function init() {
    $this->load->database();
    $data = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'].'/data/transportation_reservation.json'));
    $transportations = $data->transportation_reservations ?: [];
    foreach($transportations as $key => $item) {
      $query = [];
      foreach ($item as $key => $data) {
        # code...
        $query[$key] = is_array($data) || is_object($data) ? json_encode($data) : $data;
      }
      $this->db->insert('transportation_reservations', $query);
    }
  }

  public function get() {
    $this->load->database();
    $data = json_encode($this->db->get('transportation_reservations')->result());
    return $this->output
                ->set_content_type('application/json')
                ->set_output($data);
  }

}


/* End of file API/TransportationReservation.php */
/* Location: ./application/controllers/API/TransportationReservation.php */
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

  public function insert() {
    $this->load->database();
    $member = [];
    $config = [];
    $price = $this->input->post('price');
    $resultPrice = ($price * $this->input->post('adult')) + ($price * 0.6 * $this->input->post('kid'));
    if ($price <= 100000 && $price > 20000)
      $resultPrice += $price * 0.5 * $this->input->post('old');
    else if ($price > 100000)
      $resultPrice += $price * 0.2 * $this->input->post('old');
    $config['transportation'] = $this->input->post('transportation');
    $config['date'] = $this->input->post('date');
    $config['time'] = $this->input->post('time');
    $member['old'] = $this->input->post('old');
    $member['kid'] = $this->input->post('kid');
    $member['adult'] = $this->input->post('adult');
    $config['member'] = json_encode($member);
    $config['price'] = $resultPrice;

    $this->db->insert('transportation_reservations', $config);
    return $this->output
              ->set_content_type('application/json')
              ->set_output(json_encode($config));
  }

}


/* End of file API/TransportationReservation.php */
/* Location: ./application/controllers/API/TransportationReservation.php */
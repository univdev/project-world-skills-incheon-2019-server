<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *
 * Controller Admin_transportation_manager
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

class Admin_transportation_manager extends CI_Controller
{
    
  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $this->load->view('admin_header');
    $this->load->view('admin_transportation_manager');
  }

}


/* End of file Admin_transportation_manager.php */
/* Location: ./application/controllers/Admin_transportation_manager.php */
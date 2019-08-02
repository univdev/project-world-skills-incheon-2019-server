<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *
 * Controller Admin_transportation
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

class Admin_transportation extends CI_Controller
{
    
  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $this->load->view('admin_header');
    $this->load->view('admin_transportation');
  }

}


/* End of file Admin_transportation.php */
/* Location: ./application/controllers/Admin_transportation.php */
<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *
 * Controller Custom_404
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

class Custom_404 extends CI_Controller
{
    
  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $this->output->set_status_header('404'); 
    $this->load->view('custom_404');
  }

}


/* End of file Custom_404.php */
/* Location: ./application/controllers/Custom_404.php */
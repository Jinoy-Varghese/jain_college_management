<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *
 * Controller Sitemap
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

class Sitemap extends CI_Controller
{
    
  public function index()
  {

      $this->load->view('sitemap');
  }

}


/* End of file Sitemap.php */
/* Location: ./application/controllers/Sitemap.php */
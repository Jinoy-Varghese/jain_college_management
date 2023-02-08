<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * Model Lab_assistant_model
 *
 * This Model for ...
 * 
 * @package		CodeIgniter
 * @category	Model
 * @author    Setiawan Jodi <jodisetiawan@fisip-untirta.ac.id>
 * @link      https://github.com/setdjod/myci-extension/
 * @param     ...
 * @return    ...
 *
 */

class Lab_assistant_model extends CI_Model {

  // ------------------------------------------------------------------------

  public function __construct()
  {
    parent::__construct();
    
  }
  public function update_profile($update_data,$id)
  {
    $this->db->where('id',$id)->update('users',$update_data);
  }
  public function update_complaint_data($update_data,$complaint_id)
  {
    $this->db->where('complaint_id',$complaint_id)->update('lab_complaints',$update_data);
  }
  // ------------------------------------------------------------------------


  // ------------------------------------------------------------------------
  

  // ------------------------------------------------------------------------

}

/* End of file Librarian_model.php */
/* Location: ./application/models/Librarian_model.php */
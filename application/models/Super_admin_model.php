<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * Model Super_admin_model
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

class Super_admin_model extends CI_Model {

  // ------------------------------------------------------------------------

  public function __construct()
  {
    parent::__construct();
  }

  // ------------------------------------------------------------------------


  // ------------------------------------------------------------------------
  public function update_profile($update_data,$id)
  {
    $this->db->where('id',$id)->update('users',$update_data);
  }
  public function delete_hod($id)
  {
    $array = array(
      'user_status' => 0
);
    $this->db->set($array);
    $this->db->where('id',$id);
    $this->db->update('users');
  }
  public function delete_professor($id)
  {
    $array = array(
      'user_status' => 0
);
    $this->db->set($array);
    $this->db->where('id',$id);
    $this->db->update('users');
  }
  // ------------------------------------------------------------------------

}

/* End of file Super_admin_model.php */
/* Location: ./application/models/Super_admin_model.php */
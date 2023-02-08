<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * Model Student_model
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

class Hod_model extends CI_Model {

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

  public function Events_process($sub_data)
  {
    $this->db->insert('notifications',$sub_data);
  }
  public function lab_complaint_data($insert_complaint)
  {
    $this->db->insert('lab_complaints',$insert_complaint);
  }
  public function insert_news($insert_news)
  {
  $this->db->insert('news',$insert_news);
  }
  public function delete_subject($sub_num)
  {
    $this->db->where('sub_num',$sub_num);
    $this->db->delete('subjects');
  }
  public function delete_student($student_id)
  {
    $array = array(
      's_status' => 3
);

  $this->db->set($array);
   
    $this->db->where('student_id',$student_id);
    $this->db->update('student_data');
  }
  // ------------------------------------------------------------------------

}

/* End of file Student_model.php */
/* Location: ./application/models/Student_model.php */
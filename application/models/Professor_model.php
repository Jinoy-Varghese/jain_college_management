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

class Professor_model extends CI_Model {

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
  public function insert_notes($insert_note)
  {
  $this->db->insert('notes',$insert_note);
  }
  public function lab_complaint_data($insert_complaint)
  {
    $this->db->insert('lab_complaints',$insert_complaint);
  }
  public function edit_exam($exam_data,$exam_id)
  {
    $this->db->where('exam_id',$exam_id)->update('exam_questions',$exam_data);
  }

}

/* End of file professor_model.php */
/* Location: ./application/models/professor_model.php */
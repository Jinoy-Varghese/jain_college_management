<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Create_user_model extends CI_Model {

  // ------------------------------------------------------------------------
  public function insert_principal($u_data1,$u_data2)
  {
  $this->db->insert('users',$u_data1);
  $this->db->insert('principal_data',$u_data2);
  }
  public function insert_hod($u_data1,$u_data2)
  {
  $this->db->insert('users',$u_data1);
  $this->db->insert('hod_data',$u_data2);
  }
  public function insert_professor($u_data1,$u_data2)
  {
  $this->db->insert('users',$u_data1);
  $this->db->insert('professor_data',$u_data2);
  }
  public function insert_lab_assistant($u_data1,$u_data2)
  {
  $this->db->insert('users',$u_data1);
  $this->db->insert('lab_assistant_data',$u_data2);
  }
  public function insert_librarian($u_data1,$u_data2)
  {
  $this->db->insert('users',$u_data1);
  $this->db->insert('librarian_data',$u_data2);
  }
  public function insert_office_staff($u_data1,$u_data2)
  {
  $this->db->insert('users',$u_data1);
  $this->db->insert('office_data',$u_data2);
  }
  public function insert_student($u_data1,$u_data2)
  {
  $this->db->insert('users',$u_data1);
  $this->db->insert('student_data',$u_data2);
  }
  public function insert_parent($u_data1,$u_data2)
  {
  $this->db->insert('users',$u_data1);
  $this->db->insert('parent_data',$u_data2);
  }
  public function password_change($update_password,$id)
  {
    $this->db->where('id',$id)->update('users',$update_password);
  }
  // ------------------------------------------------------------------------

}

/* End of file Create_user_model.php */
/* Location: ./application/models/Create_user_model.php */
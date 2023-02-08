<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * Model Librarian_model
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

class Librarian_model extends CI_Model {

  // ------------------------------------------------------------------------

  public function __construct()
  {
    parent::__construct();
    
  }
  public function update_profile($update_data,$id)
  {
    $this->db->where('id',$id)->update('users',$update_data);
  }
  // ------------------------------------------------------------------------


  // ------------------------------------------------------------------------
  public function add_book($book_data)
  {
    $this->db->insert('books',$book_data);
  }
  public function update_book($book_data,$book_id)
  {
    $this->db->where('book_id',$book_id);
    $this->db->update('books',$book_data);
  }
  public function delete_book($book_id)
  {
    $this->db->where('book_id',$book_id);
    $this->db->delete('books');
  }
  public function issue_book($issue_data)
  {
    $this->db->insert('book_issues',$issue_data);
  }
  public function mark_as_returned($return_data)
  {
    $this->db->where('id',$return_data);
    $this->db->update('book_issues',array('status'=>"returned"));
  }

  // ------------------------------------------------------------------------

}

/* End of file Librarian_model.php */
/* Location: ./application/models/Librarian_model.php */
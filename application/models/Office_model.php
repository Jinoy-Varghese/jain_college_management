<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Office_model extends CI_Model 
{
    public function update_profile($update_data,$id)
    {
      $this->db->where('id',$id)->update('users',$update_data);
    }
}    
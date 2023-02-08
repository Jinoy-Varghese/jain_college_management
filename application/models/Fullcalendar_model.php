<?php

class Fullcalendar_model extends CI_Model
{
 function fetch_all_event(){
  $this->db->order_by('id');
  return $this->db->get('calendar');
 }

 function insert_event($data)
 {
  $this->db->insert('calendar', $data);
 }

 function update_event($data, $id)
 {
  $this->db->where('id', $id);
  $this->db->update('calendar', $data);
 }

 function delete_event($id)
 {
  $this->db->where('id', $id);
  $this->db->delete('calendar');
 }
}

?>

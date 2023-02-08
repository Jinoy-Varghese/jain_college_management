<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *
 * Controller Principal
 *
 * This controller for ...
 *
 * @package   CodeIgniter
 * @category  Controller CI

 *
 */

class Principal extends CI_Controller
{
    
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Fullcalendar_model');
    $this->load->model('Create_user_model');
  }

  public function index()
  {
    $this->load->view("header.php");
    $this->load->view("principal/dash_head.php");
    $this->load->view("principal/index.php");
    $this->load->view("principal/dash_footer.php");
    $this->load->view("footer.php");
  }
  public function view_professor()
  {
    $this->load->view("header.php");
    $this->load->view("principal/dash_head.php");
    $this->load->view("principal/view_professor.php");
    $this->load->view("principal/dash_footer.php");
    $this->load->view("footer.php");
  }
  public function view_Lab_Assistant()
  {
    $this->load->view("header.php");
    $this->load->view("principal/dash_head.php");
    $this->load->view("principal/view_Lab_Assistant.php");
    $this->load->view("principal/dash_footer.php");
    $this->load->view("footer.php");
  }
  public function view_Librarian()
  {
    $this->load->view("header.php");
    $this->load->view("principal/dash_head.php");
    $this->load->view("principal/view_Librarian.php");
    $this->load->view("principal/dash_footer.php");
    $this->load->view("footer.php");
  }
  public function view_hod()
  {
    $this->load->view("header.php");
    $this->load->view("principal/dash_head.php");
    $this->load->view("principal/view_hod.php");
    $this->load->view("principal/dash_footer.php");
    $this->load->view("footer.php");
  }
  public function verify_student()
  {
    $this->load->view("header.php");
    $this->load->view("principal/dash_head.php");
    $this->load->view("principal/verify_student.php");
    $this->load->view("principal/dash_footer.php");
    $this->load->view("footer.php");
  }
  public function verify_student_success()
  {
    $student_id=$this->uri->segment(3);
    $data=array('s_status'=>2);
    $this->db->where('student_id',$student_id);
    $this->db->update('student_data',$data);
    $this->session->set_flashdata('insert_success',"Sucessfully verified");
    redirect('Principal/verify_student','refresh');
  }
  public function verify_student_reject()
  {
    $student_id=$this->uri->segment(3);
    $data=array('s_status'=>5);
    $this->db->where('student_id',$student_id);
    $this->db->update('student_data',$data);
    $this->session->set_flashdata('insert_success',"Sucessfully verified");
    redirect('Principal/verify_student','refresh');
  }
  public function all_student()
  {
    $this->load->view("header.php");
    $this->load->view("principal/dash_head.php");
    $this->load->view("principal/all_student.php");
    $this->load->view("principal/dash_footer.php");
    $this->load->view("footer.php");
  }
  
  public function my_profile()
  {
    $this->load->view("header.php");
    $this->load->view("principal/dash_head.php");
    $this->load->view("principal/my_profile.php");
    $this->load->view("principal/dash_footer.php");
    $this->load->view("footer.php");
  }
  public function active_meetings()
  {
    $this->load->view("header.php");
    $this->load->view("principal/dash_head.php");
    $this->load->view("principal/active_meetings.php");
    $this->load->view("principal/dash_footer.php");
    $this->load->view("footer.php");
  }

  public function view_sem_num()
{
        $depart_gradguation=$_POST['post_gradguation']; // department id

        $users_arr = array();
        
      $this->db->select('*');
      $this->db->from('course_list');
      $this->db->where('gradguation',$depart_gradguation);
      $sql=$this->db->get();
      foreach($sql->result() as $user_data)
      {
        $department=$user_data->department;
        $users_arr[] = array("department" => $department);
      }

    
    // encoding array to json format
    echo json_encode($users_arr);
}
public function view_course()
{
        $depart_gradguation=$_POST['post_gradguation']; // department id
        $department=$_POST['post_department'];

        $users_arr = array();
        
      $this->db->select('*');
      $this->db->from('course_list');
      $this->db->where('gradguation',$depart_gradguation);
      $this->db->where('department',$department);
      $sql=$this->db->get();
      foreach($sql->result() as $user_data)
      {
        $course=$user_data->course_name;
        $users_arr[] = array("course_name" => $course);
      }

    
    // encoding array to json format
    echo json_encode($users_arr);
}

public function view_students_ajax()
{
  
    $department=$_POST['post_department']; 
    
    $course=$_POST['post_course'];
    $users_arr = array();
        
      $this->db->select('*');
      $this->db->from('users');
      $this->db->join('student_data','student_data.email=users.email');
      $this->db->where('s_course',$course);
      $this->db->where('dept',$department);
      $sql=$this->db->get();
      
      foreach($sql->result() as $user_data)
      {
        $name=$user_data->name;
        $s_id=$user_data->email;
        

        $users_arr[] = array("name" => $name,"s_id"=>$s_id);
      }
      
    
    // encoding array to json format
    echo json_encode($users_arr);
}

  public function update_profile()
    {
    if($this->input->post('update_user'))
    {
     $id=$this->input->post('id');; 
     $name=$this->input->post('name');
     $email=$this->input->post('email');
     $address=$this->input->post('address');  
     $gender=$this->input->post('gender');
     $phone=$this->input->post('phone');
     $update_data=array('name'=>$name,'email'=>$email,'address'=>$address,'gender'=>$gender,'phone'=>$phone);
     $this->Principal_model->update_profile($update_data,$id);
     $this->session->set_flashdata('update_success',"Successfully Updated");
     redirect('Principal/my_profile','refresh');
    }
    else
    {
      $this->session->set_flashdata('update_failed',"Updation Failed");
      redirect('Principal/my_profile','refresh');
    }
   }

   public function change_password()
   {
     if($this->input->post('changepw_btn'))
     {
     $id=$this->input->post('id');;
     $current=$this->input->post('current');
     $new=$this->input->post('new');
     $confirm=$this->input->post('confirm');

      $sql=$this->db->get_where('users',array('email'=>$_SESSION["u_id"]));
      foreach($sql->result() as $user_details)
      {
        $password=$user_details->password;
      } 
        if($password==md5($current))
        {
          if(md5($new)==md5($confirm))
          {
            $update_password=array('password'=>md5($confirm));
            $this->Create_user_model->password_change($update_password,$id);
            $this->session->set_flashdata('changepass_success',"Password Changed Successfully");
            redirect('Principal/my_profile','refresh');
          }
          else
          {
            $this->session->set_flashdata('changepass_failed',"New Password & Confirm Password Mismatch...!");
            redirect('Principal/my_profile','refresh');
          }
        }
        else
        {
          $this->session->set_flashdata('changepass_old_failed',"Current Password Mismatch...!");
          redirect('Principal/my_profile','refresh');
        }
   }
   else
   {
     $this->session->set_flashdata('changepass_wrong',"Password is wrong...!");
     redirect('Principal/my_profile','refresh');
   }
  }
  public function upload_image()
  {
  	$image = $_FILES['image']['name'];
  	$target = "assets/img/profile/".basename($image);
    $value=array('u_image'=>$target);
    $this->db->where('email',$_SESSION["u_id"]);
    $this->db->update('users',$value);
    move_uploaded_file($_FILES['image']['tmp_name'], $target);
    $this->session->set_flashdata('update_success',"Successfully Updated");

    redirect('Principal/my_profile','refresh');
  	
 
  }


}


/* End of file Principal.php */
/* Location: ./application/controllers/Principal.php */
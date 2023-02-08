<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *
 * Controller Super_admin
 *
 * This controller for ...
 *
 * @package   CodeIgniter
 * @category  Controller CI

 *
 */

class Super_admin extends CI_Controller
{
    
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Fullcalendar_model');
    $this->load->model('Create_user_model');
    $this->load->model('Super_admin_model');
  }

  public function index()
  {
    $this->load->view("header.php");
    $this->load->view("superadmin/dash_head.php");
    $this->load->view("superadmin/index.php");
    $this->load->view("superadmin/dash_footer.php");
    $this->load->view("footer.php");
  }
  public function add_professor()
  {
    $this->load->view("header.php");
    $this->load->view("superadmin/dash_head.php");
    $this->load->view("superadmin/add_professor.php");
    $this->load->view("superadmin/dash_footer.php");
    $this->load->view("footer.php");
  }
  public function add_Lab_Assistant()
  {
    $this->load->view("header.php");
    $this->load->view("superadmin/dash_head.php");
    $this->load->view("superadmin/add_Lab_Assistant.php");
    $this->load->view("superadmin/dash_footer.php");
    $this->load->view("footer.php");
  }
  public function add_office()
  {
    $this->load->view("header.php");
    $this->load->view("superadmin/dash_head.php");
    $this->load->view("superadmin/add_office.php");
    $this->load->view("superadmin/dash_footer.php");
    $this->load->view("footer.php");
  }
  public function change_principal()
  {
    $this->load->view("header.php");
    $this->load->view("superadmin/dash_head.php");
    $this->load->view("superadmin/change_principal.php");
    $this->load->view("superadmin/dash_footer.php");
    $this->load->view("footer.php");
  }
  public function add_Librarian()
  {
    $this->load->view("header.php");
    $this->load->view("superadmin/dash_head.php");
    $this->load->view("superadmin/add_Librarian.php");
    $this->load->view("superadmin/dash_footer.php");
    $this->load->view("footer.php");
  }
  public function add_hod()
  {
    $this->load->view("header.php");
    $this->load->view("superadmin/dash_head.php");
    $this->load->view("superadmin/add_hod.php");
    $this->load->view("superadmin/dash_footer.php");
    $this->load->view("footer.php");
  }
  public function verify_student()
  {
    $this->load->view("header.php");
    $this->load->view("superadmin/dash_head.php");
    $this->load->view("superadmin/verify_student.php");
    $this->load->view("superadmin/dash_footer.php");
    $this->load->view("footer.php");
  }
  public function update_fees()
  {
    $this->load->view("header.php");
    $this->load->view("amp.php");
    $this->load->view("superadmin/dash_head.php");
    $this->load->view("superadmin/update_fees.php");
    $this->load->view("superadmin/dash_footer.php");
    $this->load->view("footer.php");
  }
  public function delete_hod_page()
  {
    $this->load->view("header.php");
    $this->load->view("superadmin/dash_head.php");
    $this->load->view("superadmin/delete_hod.php");
    $this->load->view("superadmin/dash_footer.php");
    $this->load->view("footer.php");
  }
  public function delete_professor_page()
  {
    $this->load->view("header.php");
    $this->load->view("superadmin/dash_head.php");
    $this->load->view("superadmin/delete_professor.php");
    $this->load->view("superadmin/dash_footer.php");
    $this->load->view("footer.php");
  }
  public function delete_hod($id)
  {
   $this->Super_admin_model->delete_hod($id);
   $this->session->set_flashdata('delete_success',"Sucessfully deleted");
   redirect('Super_admin/delete_hod_page','refresh');
  }

  public function delete_professor($id)
  {
   $this->Super_admin_model->delete_professor($id);
   $this->session->set_flashdata('delete_success',"Sucessfully deleted");
   redirect('Super_admin/delete_professor_page','refresh');
  }

  public function update_gallery()
  {
    $this->load->view("header.php");
    $this->load->view("amp.php");
    $this->load->view("superadmin/dash_head.php");
    $this->load->view("superadmin/update_gallery.php");
    $this->load->view("superadmin/dash_footer.php");
    $this->load->view("footer.php");
  }
  public function view_gallery()
  {
    $this->load->view("header.php");
    $this->load->view("amp.php");
    $this->load->view("superadmin/dash_head.php");
    $this->load->view("superadmin/view_gallery.php");
    $this->load->view("superadmin/dash_footer.php");
    $this->load->view("footer.php");
  }
  
  public function verify_student_success()
  {
    $student_id=$this->uri->segment(3);
    $data=array('s_status'=>2);
    $this->db->where('student_id',$student_id);
    $this->db->update('student_data',$data);
    $this->session->set_flashdata('insert_success',"Sucessfully verified");
    redirect('Super_admin/verify_student','refresh');
  }
  public function verify_student_reject()
  {
    $student_id=$this->uri->segment(3);
    $data=array('s_status'=>5);
    $this->db->where('student_id',$student_id);
    $this->db->update('student_data',$data);
    $this->session->set_flashdata('insert_success',"Sucessfully verified");
    redirect('Super_admin/verify_student','refresh');
  }
  public function my_profile()
  {
    $this->load->view("header.php");
    $this->load->view("superadmin/dash_head.php");
    $this->load->view("superadmin/my_profile.php");
    $this->load->view("superadmin/dash_footer.php");
    $this->load->view("footer.php");
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
     $this->Super_admin_model->update_profile($update_data,$id);
     $this->session->set_flashdata('update_success',"Successfully Updated");
     redirect('Super_admin/my_profile','refresh');
    }
    else
    {
      $this->session->set_flashdata('update_failed',"Updation Failed");
      redirect('Super_admin/my_profile','refresh');
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
            redirect('Super_admin/my_profile','refresh');
          }
          else
          {
            $this->session->set_flashdata('changepass_failed',"New Password & Confirm Password Mismatch...!");
            redirect('Super_admin/my_profile','refresh');
          }
        }
        else
        {
          $this->session->set_flashdata('changepass_old_failed',"Current Password Mismatch...!");
          redirect('Super_admin/my_profile','refresh');
        }
   }
   else
   {
     $this->session->set_flashdata('changepass_wrong',"Password is wrong...!");
     redirect('Super_admin/my_profile','refresh');
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

    redirect('Super_admin/my_profile','refresh');
 
  }
  public function view_sem_num()
  {
        $depart_course =$_POST['post_course']; // department id
      
      $users_arr = array();
          
        $this->db->select('sem_num');
        $this->db->from('course_list');
        $sql=$this->db->where('course_name',$depart_course)->get();
        foreach($sql->result() as $user_data)
        {
          $sem_num=$user_data->sem_num;
        }
        $users_arr[] = array("sem_num" => $sem_num);
      
      // encoding array to json format
      echo json_encode($users_arr);
  }
  public function update_fee_process()
  {
     $course=$this->input->post('course');
     $semester=$this->input->post('semester');
     $fees=$this->input->post('fees');

     $fee_data=array('course'=>$course,'sem'=>$semester,'fee'=>$fees);
     $this->db->insert('fees',$fee_data);
     $this->session->set_flashdata('insert_success',"fee updated");
     redirect('Super_admin/update_fees','refresh');
    }
    public function update_gallery_process()
    {
      
       $news=$this->input->post('news');
       $news_file=$_FILES['news_file']['name'];
       $target = "assets/img/gallery/".basename($news_file);
       move_uploaded_file($_FILES['news_file']['tmp_name'], $target);
       $update_gallery=array('title'=>$news,'img_file'=>$target);
       $this->db->insert('gallery',$update_gallery);
       $this->session->set_flashdata('insert_success',"Successfully Inserted");
       redirect('Super_admin/update_gallery','refresh');
      
    }
    public function delete_image()
    {
      $id=$this->uri->segment(3);
      $this->db->where('id',$id);
      $this->db->delete('gallery');
      $this->session->set_flashdata('delete_success',"Sucessfully deleted");
      redirect('Super_admin/view_gallery','refresh');
    }

}


/* End of file Super_admin.php */
/* Location: ./application/controllers/Super_admin.php */
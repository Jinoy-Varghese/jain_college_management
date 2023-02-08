<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *
 * Controller Lab_assistant
 *
 * This controller for ...
 *
 * @package   CodeIgniter
 * @category  Controller CI
 * @author    Setiawan Jodi <jodisetiawan@fisip-untirta.ac.id>
 * @author    Raul Guerrero <r.g.c@me.com>
 * @link      https://github.com/setdjod/myci-extension/
 * @param     ...
 * @return    ...
 *
 */

class Lab_assistant extends CI_Controller
{
    
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Fullcalendar_model');
    $this->load->model('Create_user_model');
    $this->load->model('Lab_assistant_model');
  }
  public function index()
  {
    $this->load->view("header.php");
    $this->load->view("lab_assistant/dash_head.php");
    $this->load->view("lab_assistant/index.php");
    $this->load->view("lab_assistant/dash_footer.php");
    $this->load->view("footer.php"); 
  }
  public function lab_assistant_profile()
  {
    $this->load->view("header.php");
    $this->load->view("lab_assistant/dash_head.php");
    $this->load->view("lab_assistant/my_profile_lab.php");
    $this->load->view("lab_assistant/dash_footer.php");
    $this->load->view("footer.php");
  }
  public function complaints()
  {
    $this->load->view("header.php");
    $this->load->view("lab_assistant/dash_head.php");
    $this->load->view("lab_assistant/complaints.php");
    $this->load->view("lab_assistant/dash_footer.php");
    $this->load->view("footer.php");
  }
  public function update_complaint_data($complaint_id)
  {
    $updated_complaint=array('fixed_on'=>date('d-m-Y'),'status'=>0);
    $this->Lab_assistant_model->update_complaint_data($updated_complaint,$complaint_id);
    $this->session->set_flashdata('update_success',"Successfully Updated");
    redirect('Lab_assistant/complaints','refresh'); 
  }
  public function notification_count()
  {
    if(isset($_POST['view']))
    {
    $con = mysqli_connect("localhost", "root", "", "college_management");
    $query = "SELECT * FROM lab_complaints ORDER BY complaint_id DESC LIMIT 5";
    $result = mysqli_query($con, $query);
    
        $status_query = "SELECT * FROM lab_complaints WHERE status=1";
        $result_query = mysqli_query($con, $status_query);
        $count = mysqli_num_rows($result_query);
        $data = array(
           'unseen_notification'  => $count
        );
        echo json_encode($data);
    }
  }

  public function update_profile()
    {
    if($this->input->post('update_user'))
    {
     $id=$this->input->post('id'); 
     $name=$this->input->post('name');
     $email=$this->input->post('email');
     $address=$this->input->post('address');  
     $gender=$this->input->post('gender');
     $phone=$this->input->post('phone');
     $update_data=array('name'=>$name,'email'=>$email,'address'=>$address,'gender'=>$gender,'phone'=>$phone);
     $this->Lab_assistant_model->update_profile($update_data,$id);
     $this->session->set_flashdata('update_success',"Successfully Updated");
     redirect('Lab_assistant/lab_assistant_profile','refresh');
    }
    else
    {
      $this->session->set_flashdata('update_failed',"Updation Failed");
      redirect('Lab_assistant/lab_assistant_profile','refresh');
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
            redirect('Lab_assistant/lab_assistant_profile','refresh');
          }
          else
          {
            $this->session->set_flashdata('changepass_failed',"New Password & Confirm Password Mismatch...!");
            redirect('Lab_assistant/lab_assistant_profile','refresh');
          }
        }
        else
        {
          $this->session->set_flashdata('changepass_old_failed',"Current Password Mismatch...!");
          redirect('Lab_assistant/lab_assistant_profile','refresh');
        }
   }
   else
   {
     $this->session->set_flashdata('changepass_wrong',"Password is wrong...!");
     redirect('Lab_assistant/lab_assistant_profile','refresh');
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

    redirect('Lab_assistant/lab_assistant_profile','refresh');
  	
 
  }
}


/* End of file Lab_assistant.php */
/* Location: ./application/controllers/Lab_assistant.php */
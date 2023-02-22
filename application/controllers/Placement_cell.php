<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *
 * Controller Placement_cell
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

class Placement_cell extends CI_Controller
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
    $this->load->view("placement_cell/dash_head.php");
    $this->load->view("placement_cell/index.php");
    $this->load->view("placement_cell/dash_footer.php");
    $this->load->view("footer.php"); 
  }
  public function placement_cell_profile()
  {
    $this->load->view("header.php");
    $this->load->view("placement_cell/dash_head.php");
    $this->load->view("placement_cell/my_profile_lab.php");
    $this->load->view("placement_cell/dash_footer.php");
    $this->load->view("footer.php");
  }
  public function create_offer()
  {
    $this->load->view("header.php");
    $this->load->view("placement_cell/dash_head.php");
    $this->load->view("placement_cell/create_offer.php");
    $this->load->view("placement_cell/dash_footer.php");
    $this->load->view("footer.php");
  }
  public function view_applications()
  {
    $this->load->view("header.php");
    $this->load->view("placement_cell/dash_head.php");
    $this->load->view("placement_cell/view_applications.php");
    $this->load->view("placement_cell/dash_footer.php");
    $this->load->view("footer.php");
  }
  public function view_offers()
  {
    $this->load->view("header.php");
    $this->load->view("placement_cell/dash_head.php");
    $this->load->view("placement_cell/view_offers.php");
    $this->load->view("placement_cell/dash_footer.php");
    $this->load->view("footer.php");
  }
  public function applicants_page($job_id)
  {
    $this->load->view("header.php");
    $this->load->view("placement_cell/dash_head.php");
    $this->load->view("placement_cell/applicants_page.php",$job_id);
    $this->load->view("placement_cell/dash_footer.php");
    $this->load->view("footer.php");
  }
  public function delete_offer($job_id)
  {
    $this->db->where('job_id', $job_id);
    $this->db->delete('offers');
    $this->session->set_flashdata('update_success',"Successfully Updated");
    redirect('Placement_cell/view_Offers','refresh'); 
  }
  public function application_status()
  {
    $status=$_REQUEST['status'];
    $application_id=$_REQUEST['application_id'];
    $job_id=$_REQUEST['job_id'];
    $link="Placement_cell/applicants_page/".$job_id;
    $offer_array=array('status'=>$status);
    $this->db->where('application_id', $application_id);
    $this->db->update('offer_application',$offer_array);
    $this->session->set_flashdata('update_success',"Successfully Updated");
    redirect($link,'refresh'); 
  }

  public function create_offer_process()
  {
    if($this->input->post('create_offer_btn'))
    {

     $job_post=$this->input->post('job_post');   
     $c_name=$this->input->post('c_name');
     $job_location=$this->input->post('job_location');  
     $job_salary=$this->input->post('job_salary');
     $job_description=$this->input->post('job_description');
     $job_eligibility=$this->input->post('job_eligibility');
     $about_company=$this->input->post('about_company');
     $last_date=$this->input->post('last_date');

     $c_logo = $_FILES['c_logo']['name'];
     $target = "assets/img/company/".basename($c_logo);
     move_uploaded_file($_FILES['c_logo']['tmp_name'], $target);
     $value=array('c_logo'=>$target);

     $create_offer_array=array('job_post'=>$job_post,'c_name'=>$c_name,'job_location'=>$job_location,'job_salary'=>$job_salary,'job_description'=>$job_description,'job_eligibility'=>$job_eligibility,'about_company'=>$about_company,'last_date'=>$last_date,'C_logo'=>$target);
     $this->db->insert('offers',$create_offer_array);
     $this->session->set_flashdata('insert_success',"Successfully Inserted");
     redirect('Placement_cell/create_Offer','refresh');
    }
    else
    {
      $this->session->set_flashdata('insert_failed',"Insertion Failed");
      redirect('Placement_cell/create_Offer','refresh');
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
<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *
 * Controller Student
 *
 * This controller for ...
 *
 * @package   CodeIgniter
 * @category  Controller CI

 *
 */

class Student extends CI_Controller
{
    
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Fullcalendar_model');
    $this->load->model('Create_user_model');
    $this->load->model('Student_model');
  }

  public function index()
  {
    $this->load->view("header.php");
    $this->load->view("student/dash_head.php");
    $this->load->view("student/index.php");
    $this->load->view("student/dash_footer.php");
    $this->load->view("footer.php");
  }
  public function live_meeting()
  {
    $this->load->view("header.php");
    $this->load->view("amp.php");
    $this->load->view("student/dash_head.php");
    $this->load->view("amp.php");
    $this->load->view("student/live_meeting.php");
    $this->load->view("student/dash_footer.php");
    $this->load->view("footer.php");
  }
public function student_profile()
{
  $this->load->view("header.php");
  $this->load->view("student/dash_head.php");
  $this->load->view("amp.php");
  $this->load->view("student/my_profile1.php");
  $this->load->view("student/dash_footer.php");
  $this->load->view("footer.php");
}
public function notes()
{
  $this->load->view("header.php");
  $this->load->view("student/dash_head.php");
  $this->load->view("amp.php");
  $this->load->view("student/notes.php");
  $this->load->view("student/dash_footer.php");
  $this->load->view("footer.php");
}
public function exams()
{
  $this->load->view("header.php");
  $this->load->view("student/dash_head.php");
  $this->load->view("amp.php");
  $this->load->view("student/exams.php");
  $this->load->view("student/dash_footer.php");
  $this->load->view("footer.php");
}
public function exam_page()
{
  $this->load->view("header.php");
  $this->load->view("amp.php");
  $this->load->view("student/exam_page.php");
  $this->load->view("student/dash_footer.php");
  $this->load->view("footer.php");
}
public function assignment()
{
  $this->load->view("header.php");
  $this->load->view("student/dash_head.php");
  $this->load->view("student/submit_assignment.php");
  $this->load->view("student/dash_footer.php");
  $this->load->view("footer.php");
}
public function attendance()
{
  $this->load->view("header.php");
  $this->load->view("student/dash_head.php");
  $this->load->view("student/attendance.php");
  $this->load->view("student/dash_footer.php");
  $this->load->view("footer.php");
}
public function results()
{
  $this->load->view("header.php");
  $this->load->view("student/dash_head.php");
  $this->load->view("student/results.php");
  $this->load->view("student/dash_footer.php");
  $this->load->view("footer.php");
}
public function internal_mark()
{
  $this->load->view("header.php");
  $this->load->view("student/dash_head.php");
  $this->load->view("student/internal_mark.php");
  $this->load->view("student/dash_footer.php");
  $this->load->view("footer.php");
}
public function fee_payment()
{
  $this->load->view("header.php");
  $this->load->view("student/dash_head.php");
  $this->load->view("amp.php");
  $this->load->view("student/fee_payment.php");
  $this->load->view("student/dash_footer.php");
  $this->load->view("footer.php");
}
public function pgRedirect()
{
  $this->load->view("student/pay/lib/config_paytm.php");
  $this->load->view("student/pay/lib/encdec_paytm.php");
  $this->load->view("student/pay/pgRedirect.php");
}
public function pgResponse()
{
  $this->load->view("student/pay/lib/config_paytm.php");
  $this->load->view("student/pay/lib/encdec_paytm.php");
  $this->load->view("student/pay/pgResponse.php");
}

public function upload_assignment($as_id)
{
  $id=$_SESSION['u_id'];
  $this->db->select('*');
  $this->db->from('student_data');
  $this->db->where('email',$id);
  $sql=$this->db->get();
  foreach($sql->result() as $user_data)
  {
    $semester=$user_data->s_sem;
  }
  
   $assign_sem=$user_data->s_sem;
   $subject=$this->input->post('subject');  
   $tr_id=$this->input->post('tr_id');
   $assign_topic=$this->input->post('assign_topic');
   $upload_file = $_FILES['u_file']['name'];
   $target = "assets/img/assignments/".basename($upload_file);
   move_uploaded_file($_FILES['u_file']['tmp_name'], $target);
   $assign_upload=array('assign_id'=>$as_id,'assign_by'=>$_SESSION['u_id'],'assign_sem'=>$assign_sem,'assign_subject'=>$subject,'assign_to'=>$tr_id,'assign_topic'=>$assign_topic,'assign_date'=>date('Y-m-d'),'assign_file'=>$target);
   $this->db->insert('assignment_submit',$assign_upload);
   $this->session->set_flashdata('add_assign',"Successfully Uploaded");
   redirect('Student/assignment','refresh');
}

public function view_subject_ajax()
{
      $id=$_SESSION['u_id'];
      $this->db->select('*');
      $this->db->from('student_data');
      $this->db->where('email',$id);
      $sql=$this->db->get();
      foreach($sql->result() as $user_data)
      {
        $semester=$user_data->s_sem;
      }
        $depart_sub =$_POST['post_subject']; // department id
    

        $users_arr = array();
        
      $this->db->select('*');
      $this->db->from('users');
      $this->db->join('subject_assigned','subject_assigned.teacher_id=users.email');
      $this->db->where('subject',$depart_sub);
      $this->db->where('sem',$semester);
      $sql=$this->db->get();
      foreach($sql->result() as $user_data)
      {
        $name=$user_data->name;
        $users_arr[] = array("name" => $name);
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
   $this->Student_model->update_profile($update_data,$id);
   $this->session->set_flashdata('update_success',"Successfully Updated");
   redirect('Student/student_profile','refresh');
  }
  else
  {
    $this->session->set_flashdata('update_failed',"Updation Failed");
    redirect('Student/student_profile','refresh');
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
          redirect('Student/student_profile','refresh');
        }
        else
        {
          $this->session->set_flashdata('changepass_failed',"New Password & Confirm Password Mismatch...!");
          redirect('Student/student_profile','refresh');
        }
      }
      else
      {
        $this->session->set_flashdata('changepass_old_failed',"Current Password Mismatch...!");
        redirect('Student/student_profile','refresh');
      }
    }
   else
    {
      $this->session->set_flashdata('changepass_wrong',"Password is wrong...!");
      redirect('Student/student_profile','refresh');
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

  redirect('Student/Student_profile','refresh');
 }
 public function submit_answer_process()
 {

   $id=$_SESSION['u_id'];


   $this->db->select('*');
   $this->db->from('users');
   $this->db->join('student_data','student_data.email=users.email');
   $this->db->where('users.email',$id);
   $sql=$this->db->get();
   foreach($sql->result() as $user_data)
   {
     $s_sem=$user_data->s_sem;
     $s_course=$user_data->s_course;
   }


   $limit=$this->input->post('limit')-1;
   $exam_id=$this->input->post('exam_id');

   $this->db->select('*');
   $this->db->from('exam_questions');
   $this->db->where('exam_id',$exam_id);
   $sql=$this->db->get();
   foreach($sql->result() as $user_data)
   {
     $subject=$user_data->subject;
   }


   $mark=0;
   for($i=1;$i<=$limit;$i++)
   {
      
      $answer='answer'.$i;
      $o_answer=$this->input->post($answer);

      $this->db->select('*');
      $this->db->from('exam_questions');
      $this->db->where('exam_id',$exam_id);
      $this->db->where('question_id',$i);
      $sql=$this->db->get();
      foreach($sql->result() as $exam_check)
      {
        if($o_answer==$exam_check->answer)
        {
          $mark++;
        }
      }
      

    }
    $my_mark=($mark*10)/$limit;

    $exam_data=array('student_id'=>$id,'mark_obtained'=>$my_mark,'exam_id'=>$exam_id,'sem'=>$s_sem,'course'=>$s_course,'subject'=>$subject);
    $this->db->insert('exam_marks',$exam_data);

    $this->session->set_flashdata('insert_success',"Sucessfully inserted");
    redirect('Student/exams','refresh');

 }

}


/* End of file Student.php */
/* Location: ./application/controllers/Student.php */
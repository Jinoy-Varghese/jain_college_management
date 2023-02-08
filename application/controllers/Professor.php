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

class Professor extends CI_Controller
{
    
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Fullcalendar_model');
    $this->load->model('Create_user_model');
    $this->load->model('Professor_model');
  }

  public function index()
  {
    $this->load->view("header.php");
    $this->load->view("professor/dash_head.php");
    $this->load->view("professor/index.php");
    $this->load->view("professor/dash_footer.php");
    $this->load->view("footer.php");
  }
  public function add_student()
  {
    $this->load->view("header.php");
    $this->load->view("amp.php");
    $this->load->view("professor/dash_head.php");
    $this->load->view("professor/add_student.php");
    $this->load->view("professor/dash_footer.php");
    $this->load->view("footer.php");
  }
  public function add_parent()
  {
    $this->load->view("header.php");
    $this->load->view("amp.php");
    $this->load->view("professor/dash_head.php");
    $this->load->view("professor/add_parent.php");
    $this->load->view("professor/dash_footer.php");
    $this->load->view("footer.php");
  }
  public function mark_attendance()
  {
    $this->load->view("header.php");
    $this->load->view("amp.php");
    $this->load->view("professor/dash_head.php");
    $this->load->view("professor/mark_attendance.php");
    $this->load->view("professor/dash_footer.php");
    $this->load->view("footer.php");
  }
  public function view_students()
  {
    $this->load->view("header.php");
    $this->load->view("amp.php");
    $this->load->view("professor/dash_head.php");
    $this->load->view("professor/view_students.php");
    $this->load->view("professor/dash_footer.php");
    $this->load->view("footer.php");
  }
  public function live_meeting()
  {
    $this->load->view("header.php");
    $this->load->view("amp.php");
    $this->load->view("professor/dash_head.php");
    $this->load->view("professor/live_meeting.php");
    $this->load->view("professor/dash_footer.php");
    $this->load->view("footer.php");
  }
  public function notes()
  {
    $this->load->view("header.php");
    $this->load->view("amp.php");
    $this->load->view("professor/dash_head.php");
    $this->load->view("professor/notes.php");
    $this->load->view("professor/dash_footer.php");
    $this->load->view("footer.php");
  }
  public function add_notes_page()
  {
    $this->load->view("header.php");
    $this->load->view("amp.php");
    $this->load->view("professor/dash_head.php");
    $this->load->view("professor/add_notes_page.php");
    $this->load->view("professor/dash_footer.php");
    $this->load->view("footer.php");
  }
  public function add_assignment()
  {
    $this->load->view("header.php");
    $this->load->view("amp.php");
    $this->load->view("professor/dash_head.php");
    $this->load->view("professor/add_assignment.php");
    $this->load->view("professor/dash_footer.php");
    $this->load->view("footer.php");
  }
  public function view_assignment()
  {
    $this->load->view("header.php");
    $this->load->view("amp.php");
    $this->load->view("professor/dash_head.php");
    $this->load->view("professor/view_assignment.php");
    $this->load->view("professor/dash_footer.php");
    $this->load->view("footer.php");
  }
  public function assignments()
  {
    $this->load->view("header.php");
    $this->load->view("amp.php");
    $this->load->view("professor/dash_head.php");
    $this->load->view("professor/assignments.php");
    $this->load->view("professor/dash_footer.php");
    $this->load->view("footer.php");
  }
  public function create_exam()
  {
    $this->load->view("header.php");
    $this->load->view("amp.php");
    $this->load->view("professor/dash_head.php");
    $this->load->view("professor/create_exam.php");
    $this->load->view("professor/dash_footer.php");
    $this->load->view("footer.php");
  }
  public function create_question()
  {
    $this->load->view("header.php");
    $this->load->view("amp.php");
    $this->load->view("professor/dash_head.php");
    $this->load->view("professor/create_question.php");
    $this->load->view("professor/dash_footer.php");
    $this->load->view("footer.php");
  }
  public function lab_complaint()
  {
    $this->load->view("header.php");
    $this->load->view("amp.php");
    $this->load->view("professor/dash_head.php");
    $this->load->view("professor/lab_complaint.php");
    $this->load->view("professor/dash_footer.php");
    $this->load->view("footer.php");
  }
  public function view_internal_mark()
  {
    $this->load->view("professor/view_internal_mark.php");
  }
  public function monitor_student()
  {
    $this->load->view("header.php");
    $this->load->view("amp.php");
    $this->load->view("professor/dash_head.php");
    $this->load->view("professor/monitor_student.php");
    $this->load->view("professor/dash_footer.php");
    $this->load->view("footer.php");
  }
  public function exams_conducted()
  {
    $this->load->view("header.php");
    $this->load->view("amp.php");
    $this->load->view("professor/dash_head.php");
    $this->load->view("professor/exams_conducted.php");
    $this->load->view("professor/dash_footer.php");
    $this->load->view("footer.php");
  }
  public function update_exam()
 {
  $this->load->view("header.php");
  $this->load->view("amp.php");
  $this->load->view("professor/dash_head.php");
  $this->load->view("Professor/update_exam.php");
  $this->load->view("Professor/dash_footer.php");
  $this->load->view("footer.php");
 }
 public function subject_attendance()
 {
  $this->load->view("header.php");
  $this->load->view("amp.php");
  $this->load->view("professor/dash_head.php");
  $this->load->view("Professor/subject_attendance.php");
  $this->load->view("Professor/dash_footer.php");
  $this->load->view("footer.php");
 }
 public function lab_record()
 {
  $this->load->view("header.php");
  $this->load->view("amp.php");
  $this->load->view("professor/dash_head.php");
  $this->load->view("Professor/lab_record.php");
  $this->load->view("Professor/dash_footer.php");
  $this->load->view("footer.php");
 }
 public function lab_pps()
 {
  $this->load->view("header.php");
  $this->load->view("amp.php");
  $this->load->view("professor/dash_head.php");
  $this->load->view("Professor/lab_pps.php");
  $this->load->view("Professor/dash_footer.php");
  $this->load->view("footer.php");
 }


 public function edit_exam()
 {
   $exam_id=$this->input->post('exam_id');
   $subject=$this->input->post('subject');
   $time=$this->input->post('time');
   $course=$this->input->post('course');
   $scheduled_date=$this->input->post('scheduled_date');
   $last_date=$this->input->post('last_date');
   $semester=$this->input->post('semester');
   
   $exam_data=array('subject'=>$subject,'time'=>$time,'course'=>$course,'scheduled_date'=>$scheduled_date,'last_date'=>$last_date,'semester'=>$semester);
   $this->Professor_model->edit_exam($exam_data,$exam_id);
   $this->session->set_flashdata('insert_success',"Sucessfully inserted");
   redirect('Professor/exams_conducted','refresh');
 }

  public function insert_note_process()
  {
    if($this->input->post('n_add'))
    {
      $sql=$this->db->get_where('users',array('email'=>$_SESSION["u_id"]));
      foreach($sql->result() as $user_name)
      {
        $note_by=$user_name->name;
      }

     $note_for=$this->input->post('semester');   
     $course=$this->input->post('course');
     $note_heading=$this->input->post('note_heading');  
     $note_desc=$this->input->post('note_desc');
     $note_subject=$this->input->post('note_subject');
     $note_file = $_FILES['note_file']['name'];
     $target = "assets/img/notes/".basename($note_file);
     move_uploaded_file($_FILES['note_file']['tmp_name'], $target);
     $value=array('note_file'=>$target);
     $insert_note=array('note_for'=>$note_for,'note_by'=>$note_by,'course'=>$course,'note_heading'=>$note_heading,'note_desc'=>$note_desc,'note_subject'=>$note_subject,'note_file'=>$target);
     $this->Professor_model->insert_notes($insert_note);
     $this->session->set_flashdata('insert_note_success',"Successfully Inserted");
     redirect('professor/notes','refresh');
    }
    else
    {
      $this->session->set_flashdata('insert_failed',"Insertion Failed");
      redirect('professor/notes','refresh');
    }
  }
  public function start_meeting()
  {
    $value=array('meet_status'=>1);
    $this->db->where('email',$_SESSION["u_id"]);
    $this->db->update('professor_data',$value);
    $link="https://mtcst.herokuapp.com/".md5($_SESSION["u_id"]); 
    redirect($link,'refresh');
  }
  public function leave_meeting()
  {
    $value=array('meet_status'=>0);
    $this->db->where('email',$_SESSION["u_id"]);
    $this->db->update('professor_data',$value);
    $this->session->set_flashdata('meeting_over',);
    redirect('Professor/live_meeting','refresh');
  }
  public function mark_attendance_process()
  {
    $id=$_SESSION['u_id'];
    $this->db->select('*');
    $this->db->from('incharge_list');
    $this->db->where('user_incharge',$id);
    $sql=$this->db->get();
    foreach($sql->result() as $user_data)
    {
      $s_sem=$user_data->semester;
      $u_dept=$user_data->incharge_dept;
    }
    $limit=$this->input->post('limit');
    $date=$this->input->post('date');
    for($i=1;$i<=$limit;$i++)
    {
       $attendance=$this->input->post($i);
       $student_id='sid'.$i;
       $sid=$this->input->post($student_id);
       $attendance_data=array('s_id'=>$sid,'s_attendance'=>$attendance,'s_sem'=>$s_sem,'timestamp'=>$date);
       $this->db->insert('attendance',$attendance_data);
    }
    $this->session->set_flashdata('insert_success',"Sucessfully inserted");
    redirect('Professor/mark_attendance','refresh');
  }

  public function add_assignment_data()
  {
   $assign_topic=$this->input->post('as_topic');
   $subject=$this->input->post('subject');
   $semester=$this->input->post('semester');  
   $last_date=$this->input->post('last_date');
   $course=$this->input->post('course');
   $assign_data=array('as_topic'=>$assign_topic,'as_by'=>$_SESSION['u_id'],'subject'=>$subject,'semester'=>$semester,'last_date'=>$last_date,'course'=>$course);
   $this->db->insert('assignment_topic',$assign_data);
   $this->session->set_flashdata('add_topic',"Successfully Added");
   redirect('professor/add_assignment','refresh');
 }

  public function professor_profile()
  {
    $this->load->view("header.php");
    $this->load->view("professor/dash_head.php");
    $this->load->view("professor/my_profile2.php");
    $this->load->view("professor/dash_footer.php");
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
     $this->Professor_model->update_profile($update_data,$id);
     $this->session->set_flashdata('update_success',"Successfully Updated");
     redirect('professor/professor_profile','refresh');
    }
    else
    {
      $this->session->set_flashdata('update_failed',"Updation Failed");
      redirect('professor/professor_profile','refresh');
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
            redirect('professor/professor_profile','refresh');
          }
          else
          {
            $this->session->set_flashdata('changepass_failed',"New Password & Confirm Password Mismatch...!");
            redirect('professor/professor_profile','refresh');
          }
        }
        else
        {
          $this->session->set_flashdata('changepass_old_failed',"Current Password Mismatch...!");
          redirect('professor/professor_profile','refresh');
        }
   }
   else
   {
     $this->session->set_flashdata('changepass_wrong',"Password is wrong...!");
     redirect('professor/professor_profile','refresh');
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
    redirect('Professor/Professor_profile','refresh');	
  }
  public function view_subject_ajax()
  {
    

        $depart_sub =$_POST['post_subject']; // department id
      

      $users_arr = array();
          
        $this->db->select('*');
        $this->db->from('subject_assigned');
        $sql=$this->db->where('subject',$depart_sub)->get();
        foreach($sql->result() as $user_data)
        {
          $sem=$user_data->sem;
          $users_arr[] = array("sem" => $sem);
        }

      
      // encoding array to json format
      echo json_encode($users_arr);
  }
  public function view_sem_num()
  {
        $depart_course =$_POST['post_course']; // department id
      
      $users_arr = array();
          
        $this->db->select('DISTINCT(sem)');
        $this->db->from('subject_assigned');
        $this->db->where('sub_course',$depart_course);
        $this->db->where('teacher_id',$_SESSION['u_id']);
        $sql=$this->db->get();
        foreach($sql->result() as $user_data)
        {
          $sem=$user_data->sem;
          $users_arr[] = array("sem" => $sem);
        }
        
      
      // encoding array to json format
      echo json_encode($users_arr);
  }

  public function view_assign_subject_ajax()
  {
    
      $depart_sem =$_POST['post_semester']; 
      $depart_course=$_POST['post_course'];
      $users_arr = array();

        $this->db->select('subject');
        $this->db->from('subject_assigned');
        $this->db->where('teacher_id',$_SESSION['u_id']);
        $this->db->where('sub_course',$depart_course);
        $this->db->where('sem',$depart_sem);
        $sql=$this->db->get();
        
        foreach($sql->result() as $user_data)
        {
          $subject=$user_data->subject; 
          $users_arr[] = array("subject" => $subject);
        }
        
      
      // encoding array to json format
      echo json_encode($users_arr);
  }


  public function view_assignment_ajax()
  {
    
      $depart_sem =$_POST['post_semester']; 
      $depart_subject=$_POST['post_subject'];
      $users_arr = array();
          
        $this->db->select('*');
        $this->db->from('assignment_submit');
        $this->db->join('users','users.email=assignment_submit.assign_by');
        $this->db->where('assign_subject',$depart_subject);
        $sql=$this->db->where('assign_sem',$depart_sem)->get();
        
        foreach($sql->result() as $user_data)
        {
          $name=$user_data->name;
          $assign_subject=$user_data->assign_subject;
          $assign_topic=$user_data->assign_topic;
          $assign_date=date('d-m-Y',strtotime($user_data->assign_date));
          $assign_file=base_url().$user_data->assign_file;
          $users_arr[] = array("name" => $name,"assign_subject"=>$assign_subject,"assign_topic"=>$assign_topic,"assign_date"=>$assign_date,"assign_file"=>$assign_file);
        }
        
      
      // encoding array to json format
      echo json_encode($users_arr);
  }

  public function mark_assignment()
  {

    $id=$_SESSION['u_id'];
    $this->db->select('*');
    $this->db->from('users');
    $this->db->join('professor_data','professor_data.email=users.email');
    $this->db->where('users.email',$id);
    $sql=$this->db->get();
    foreach($sql->result() as $user_data)
    {
      $dept=$user_data->dept;
    }
    $course=$this->input->post('course');
    $subject=$this->input->post('subject');
    $semester=$this->input->post('semester');
    $limit=$this->input->post('limit');
    for($i=1;$i<=$limit;$i++)
    {

       $student_id='sid'.$i;
       $rating='rating'.$i;
       $mark=$this->input->post($rating);
       $sid=$this->input->post($student_id);
       $assignment_data=array('a_email'=>$sid,'a_subject'=>$subject,'a_sem'=>$semester,'a_course'=>$course,'mark'=>$mark,'a_dept'=>$dept);
       $this->db->insert('assignment',$assignment_data);
    }
    $this->session->set_flashdata('insert_success',"Sucessfully inserted");
    redirect('Professor/assignments','refresh');
  }
  public function create_question_process()
  {

    $id=$_SESSION['u_id'];

    $course=$this->input->post('course');
    $subject=$this->input->post('subject');
    $semester=$this->input->post('semester');
    $limit=$this->input->post('limit');
    $time=$this->input->post('time');
    $scheduled_date=$this->input->post('scheduled_date');
    $last_date=$this->input->post('last_date');


    $exam_id=$semester.$subject.rand();
    for($i=1;$i<=$limit;$i++)
    {

       $question='question'.$i;
       $optiona='optiona'.$i;
       $optionb='optionb'.$i;
       $optionc='optionc'.$i;
       $optiond='optiond'.$i;
       $answer='answer'.$i;
       
       $o_question=$this->input->post($question);
       $o_optiona=$this->input->post($optiona);
       $o_optionb=$this->input->post($optionb);
       $o_optionc=$this->input->post($optionc);
       $o_optiond=$this->input->post($optiond);
       $o_answer=$this->input->post($answer);


       $exam_data=array('question'=>$o_question,'option_a'=>$o_optiona,'option_b'=>$o_optionb,'option_c'=>$o_optionc,'option_d'=>$o_optiond,'answer'=>$o_answer,'question_by'=>$id,'course'=>$course,'semester'=>$semester,'subject'=>$subject,'exam_id'=>$exam_id,'question_id'=>$i,'time'=>$time,'scheduled_date'=>$scheduled_date,'last_date'=>$last_date);
       $this->db->insert('exam_questions',$exam_data);
    }
    $this->session->set_flashdata('insert_success',"Sucessfully inserted");
    redirect('Professor/create_exam','refresh');

  }

  public function lab_complaint_data()
  {
    if($this->input->post('complaint_reg'))
    {
     $id=$_SESSION['u_id'];
     $sym_no=$this->input->post('sym_no');
     $complaint=$this->input->post('complaint');
     $insert_complaint=array('sym_no'=>$sym_no,'complaint'=>$complaint,'register_by'=>$_SESSION['u_id'],'status'=>1);
     $this->Professor_model->lab_complaint_data($insert_complaint);
     $this->session->set_flashdata('registered_success',"Complaint Registered Successfully");
     redirect('Professor/lab_complaint','refresh');
    }
    else
    {
      $this->session->set_flashdata('registration_failed',"Registration Failed");
      redirect('Professor/lab_complaint','refresh');
    }
  }
  public function create_live_meeting()
  {
    if($this->input->post('start'))
    {
     $id=$_SESSION['u_id'];
     $course=$this->input->post('course');
     $subject=$this->input->post('subject');
     $semester=$this->input->post('semester');
     $meet_data=array('meet_by'=>$id,'course'=>$course,'sem'=>$semester,'subject'=>$subject,'status'=>1);
     $value1=array('meet_status'=>1);
     $this->db->where('email',$id);
     $this->db->update('professor_data',$value1);
     $this->db->insert('meeting_data',$meet_data);
     redirect('https://mtcst.herokuapp.com/'.md5($subject).md5($semester));
    }
    else
    {
      redirect('Professor/live_meeting','refresh');
    }
  }
  public function create_pta_meeting()
  {
    
    $id=$_SESSION['u_id'];
    $this->db->select('*');
    $this->db->from('incharge_list');
    $this->db->where('user_incharge',$id);
    $sql=$this->db->get();
    foreach($sql->result() as $user_data)
    {
      $semester=$user_data->semester;
      $course=$user_data->course;
    }
     $meet_data=array('meet_by'=>$id,'course'=>$course,'sem'=>$semester,'status'=>1);
     $value1=array('meet_status'=>1);
     $this->db->where('email',$id);
     $this->db->update('professor_data',$value1);
     $this->db->insert('meeting_data',$meet_data);
     redirect('https://mtcst.herokuapp.com/'.md5($course).md5($semester));
    
  
     // redirect('Professor/live_meeting','refresh');
    
  }
  public function mark_subject_attendance()
  {

    $id=$_SESSION['u_id'];
    $this->db->select('*');
    $this->db->from('users');
    $this->db->join('professor_data','professor_data.email=users.email');
    $this->db->where('users.email',$id);
    $sql=$this->db->get();
    foreach($sql->result() as $user_data)
    {
      $dept=$user_data->dept;
    }
    $course=$this->input->post('course');
    $subject=$this->input->post('subject');
    $semester=$this->input->post('semester');
    $limit=$this->input->post('limit');
    for($i=1;$i<=$limit;$i++)
    {

       $student_id='sid'.$i;
       $rating='v'.$i;
       $mark=$this->input->post($rating);
       $sid=$this->input->post($student_id);
       $subject_data=array('s_id'=>$sid,'subject'=>$subject,'s_sem'=>$semester,'course'=>$course,'s_attendance'=>$mark,'dept'=>$dept);
       $this->db->insert('subject_attendance',$subject_data);
    }
    $this->session->set_flashdata('insert_success',"Sucessfully inserted");
    redirect('Professor/subject_attendance','refresh');
  }
  public function offline_mark()
  {
    $this->load->view("header.php");
    $this->load->view("professor/dash_head.php");
    $this->load->view("professor/offline.php");
    $this->load->view("professor/dash_footer.php");
    $this->load->view("footer.php");
  }
  
  public function offline_mark_process()
  {
    $id=$_SESSION['u_id'];

    $course=$this->input->post('course');
    $subject=$this->input->post('subject');
    $semester=$this->input->post('semester');
    $total=$this->input->post('total_mark');
    $limit=$this->input->post('limit');
    

    $exam_id=$semester.$subject.rand();
    for($i=1;$i<=$limit;$i++)
    {

      $student_id='sid'.$i;
      $rating='v'.$i;
      $mark=$this->input->post($rating);
      $sid=$this->input->post($student_id);
      $my_mark=($mark*10)/$total;
       $exam_data=array('subject'=>$subject,'student_id'=>$sid,'mark_obtained'=>$my_mark,'exam_id'=>$exam_id,'course'=>$course,'sem'=>$semester);
       $this->db->insert('exam_marks',$exam_data);
    }
    $this->session->set_flashdata('insert_success',"Sucessfully inserted");
    redirect('Professor/offline_mark','refresh');
   
  }
  public function mark_lab_record()
  {

    $id=$_SESSION['u_id'];
    $this->db->select('*');
    $this->db->from('users');
    $this->db->join('professor_data','professor_data.email=users.email');
    $this->db->where('users.email',$id);
    $sql=$this->db->get();
    foreach($sql->result() as $user_data)
    {
      $dept=$user_data->dept;
    }
    $course=$this->input->post('course');
    $subject=$this->input->post('subject');
    $semester=$this->input->post('semester');
    $limit=$this->input->post('limit');
    for($i=1;$i<=$limit;$i++)
    {

       $student_id='sid'.$i;
       $rating='rating'.$i;
       $mark=$this->input->post($rating);
       $sid=$this->input->post($student_id);
       $lab_record_data=array('email'=>$sid,'subject'=>$subject,'sem'=>$semester,'course'=>$course,'mark'=>$mark,'dept'=>$dept);
       $this->db->insert('lab_record',$lab_record_data);
    }
    $this->session->set_flashdata('insert_success',"Sucessfully inserted");
    redirect('Professor/lab_record','refresh');
  }
  public function mark_lab_pps()
  {

    $id=$_SESSION['u_id'];
    $this->db->select('*');
    $this->db->from('users');
    $this->db->join('professor_data','professor_data.email=users.email');
    $this->db->where('users.email',$id);
    $sql=$this->db->get();
    foreach($sql->result() as $user_data)
    {
      $dept=$user_data->dept;
    }
    $course=$this->input->post('course');
    $subject=$this->input->post('subject');
    $semester=$this->input->post('semester');
    $limit=$this->input->post('limit');
    for($i=1;$i<=$limit;$i++)
    {

       $student_id='sid'.$i;
       $rating='rating'.$i;
       $mark=$this->input->post($rating);
       $sid=$this->input->post($student_id);
       $pps_mark_data=array('email'=>$sid,'subject'=>$subject,'sem'=>$semester,'course'=>$course,'mark'=>$mark,'dept'=>$dept);
       $this->db->insert('pps_mark',$pps_mark_data);
    }
    $this->session->set_flashdata('insert_success',"Sucessfully inserted");
    redirect('Professor/lab_pps','refresh');
  }
  public function view_students_ajax()
  {
    
      $depart_sem =$_POST['post_semester']; 
      $depart_course=$_POST['post_course'];
      $users_arr = array();
          
        $this->db->select('*');
        $this->db->from('users');
        $this->db->join('student_data','student_data.email=users.email');
        $this->db->where('s_course',$depart_course);
        $this->db->where('s_status','2');
        $sql=$this->db->where('s_sem',$depart_sem)->get();
        
        foreach($sql->result() as $user_data)
        {
          $name=$user_data->name;
          $s_id=$user_data->email;
          $users_arr[] = array("name" => $name,"s_id"=>$s_id);
        }
        
      
      // encoding array to json format
      echo json_encode($users_arr);
  }
  



  }
  
 

/* End of file Super_admin.php */
/* Location: ./application/controllers/Super_admin.php */
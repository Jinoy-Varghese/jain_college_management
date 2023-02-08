<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Create_user_model');
  }
  public function index()
  {
    $this->load->view("landing_page.php");
  }
  public function login()
  {
    $this->load->view("header");
    $this->load->view("login");
    $this->load->view("footer");
  }
  public function logout()
  {
    $_SESSION = array();

    // If it's desired to kill the session, also delete the session cookie.
    // Note: This will destroy the session, and not just the session data!
    if (ini_get("session.use_cookies")) 
    {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    session_unset();
    session_destroy();
    redirect('home/login');
  }
  public function course()
  {
    $this->load->view("amp.php");
    $this->load->view("landing_page/land_head.php");
    $this->load->view("landing_page/course.php");
    $this->load->view("landing_page/land_footer.php");
  }
  public function department()
  {
    $this->load->view("amp.php");
    $this->load->view("landing_page/land_head.php");
    $this->load->view("landing_page/department.php");
    $this->load->view("landing_page/land_footer.php");
  }
  public function gallery()
  {
    $this->load->view("amp.php");
    $this->load->view("landing_page/land_head.php");
    $this->load->view("landing_page/gallery.php");
    $this->load->view("landing_page/land_footer.php");
  }
  public function about()
  {
    $this->load->view("amp.php");
    $this->load->view("landing_page/land_head.php");
    $this->load->view("landing_page/about.php");
    $this->load->view("landing_page/land_footer.php");
  }



   public function login_process()
   {
     if($this->input->post('u_login'))
      {
        $u_name=$this->input->post('u_name');
        $u_pass=md5($this->input->post('u_password'));
        $u_data=array('u_name'=>$u_name,'u_pass'=>$u_pass);
        $users_list=$this->db->get_where('users',array('email'=>$u_data['u_name'],'user_status'=>1));
        if($users_list->num_rows()>0)
        {
          foreach($users_list->result() as $users)
          {
            if($u_data['u_name']==$users->email && $u_data['u_pass']==$users->password)
            {
              $_SESSION['u_id']=$u_data['u_name'];
              $_SESSION['role']=$users->role;
              if($users->role=="Super Admin")
              {
              redirect('Super_admin','refresh');
              }
              elseif($users->role=="librarian")
              {
              redirect('Librarian','refresh');
              }
              elseif($users->role=="hod")
              {
              redirect('Hod','refresh');
              }
              elseif($users->role=="parent")
              {
              redirect('Parents','refresh');
              }
              elseif($users->role=="student")
              {
              redirect('student','refresh');
              }
              elseif($users->role=="professor")
              {
              redirect('Professor','refresh');
              }
              elseif($users->role=="lab assistant")
              {
              redirect('Lab_assistant','refresh');
              }
              elseif($users->role=="principal")
              {
              redirect('Principal','refresh');
              }
              elseif($users->role=="office")
              {
              redirect('Office','refresh');
              }
            }
            else
            {
              $this->session->set_flashdata('invalid_user',"failed");
              redirect('Home/login','refresh');
            }
          }
        }
        else
            {
              $this->session->set_flashdata('invalid_user',"failed");
              redirect('Home/login','refresh');
            }
      }
   }
   public function insert_hod()
   {
     if($this->input->post('u_reg'))
     {
       $f_name=$this->input->post('f_name');
       $l_name=$this->input->post('l_name');
       $u_name=$f_name." ".$l_name;
       $u_email=$this->input->post('u_email');
       $u_address=$this->input->post('u_address');
       $u_gender=$this->input->post('u_gender');
       $u_dob=$this->input->post('u_dob');
       $u_education=$this->input->post('u_education');
       $u_net=$this->input->post('u_net');
       $u_set=$this->input->post('u_set');
       $ph_no=$this->input->post('ph_no');
       $u_pass=md5($this->input->post('u_pass'));
       $u_dept=$this->input->post('u_dept');
       $u_role="hod";
       $u_data1=array('name'=>$u_name,'password'=>$u_pass,'email'=>$u_email,'address'=>$u_address,'gender'=>$u_gender,'phone'=>$ph_no,'role'=>$u_role);
       $u_data2=array('email'=>$u_email,'dob'=>$u_dob,'dept'=>$u_dept,'u_education'=>$u_education,'u_net'=>$u_net,'u_set'=>$u_set);
       $this->Create_user_model->insert_hod($u_data1,$u_data2);
       $this->session->set_flashdata('insert_success',"Sucessfully inserted");
       redirect('Super_admin/add_hod','refresh');
     }
     else
     {
      $this->session->set_flashdata('insert_failed',"insertion failed");
       redirect('Super_admin/add_hod','refresh');
     }
   }
   public function google_auth()
   {
    $this->load->view("google_auth.php"); 
   }
   public function insert_professor()
   {
     if($this->input->post('u_reg'))
     {
       $f_name=$this->input->post('f_name');
       $l_name=$this->input->post('l_name');
       $u_name=$f_name." ".$l_name;
       $u_email=$this->input->post('u_email');
       $u_address=$this->input->post('u_address');
       $u_gender=$this->input->post('u_gender');
       $u_dob=$this->input->post('u_dob');
       $u_education=$this->input->post('u_education');
       $u_net=$this->input->post('u_net');
       $u_set=$this->input->post('u_set');
       $ph_no=$this->input->post('ph_no');
       $u_pass=md5($this->input->post('u_pass'));
       $u_dept=$this->input->post('u_dept');
       $u_role="professor";
       $u_data1=array('name'=>$u_name,'password'=>$u_pass,'email'=>$u_email,'address'=>$u_address,'gender'=>$u_gender,'phone'=>$ph_no,'role'=>$u_role);
       $u_data2=array('email'=>$u_email,'dob'=>$u_dob,'dept'=>$u_dept,'u_education'=>$u_education,'u_net'=>$u_net,'u_set'=>$u_set);
       $this->Create_user_model->insert_professor($u_data1,$u_data2);
       $this->session->set_flashdata('insert_success',"Sucessfully inserted");
       redirect('Super_admin/add_professor','refresh');
     }
     else
     {
      $this->session->set_flashdata('insert_failed',"insertion failed");
       redirect('Super_admin/add_professor','refresh');
     }
   }
   public function insert_lab_assistant()
   {
     if($this->input->post('u_reg'))
     {
       $f_name=$this->input->post('f_name');
       $l_name=$this->input->post('l_name');
       $u_name=$f_name." ".$l_name;
       $u_email=$this->input->post('u_email');
       $u_address=$this->input->post('u_address');
       $u_gender=$this->input->post('u_gender');
       $u_dob=$this->input->post('u_dob');
       $u_education=$this->input->post('u_education');
       $ph_no=$this->input->post('ph_no');
       $u_pass=md5($this->input->post('u_pass'));
       $u_dept=$this->input->post('u_dept');
       $u_role="lab assistant";
       $u_data1=array('name'=>$u_name,'password'=>$u_pass,'email'=>$u_email,'address'=>$u_address,'gender'=>$u_gender,'phone'=>$ph_no,'role'=>$u_role);
       $u_data2=array('email'=>$u_email,'dob'=>$u_dob,'dept'=>$u_dept,'u_education'=>$u_education);
       $this->Create_user_model->insert_lab_assistant($u_data1,$u_data2);
       $this->session->set_flashdata('insert_success',"Sucessfully inserted");
       redirect('Super_admin/add_lab_assistant','refresh');
     }
     else
     {
      $this->session->set_flashdata('insert_failed',"insertion failed");
       redirect('Super_admin/add_lab_assistant','refresh');
     }
   }
   public function insert_student()
   {
     if($this->input->post('u_reg'))
     {
       $f_name=$this->input->post('f_name');
       $l_name=$this->input->post('l_name');
       $u_name=$f_name." ".$l_name;
       $u_email=$this->input->post('u_email');
       $u_address=$this->input->post('u_address');
       $u_gender=$this->input->post('u_gender');
       $u_dob=$this->input->post('u_dob');
       $u_sslc=$this->input->post('u_sslc');
       $u_plustwo=$this->input->post('u_plustwo');
       $ph_no=$this->input->post('ph_no');
       $u_pass=md5($this->input->post('u_pass'));
       $u_dept=$this->input->post('u_dept');
       $u_role="student";
       $u_data1=array('name'=>$u_name,'password'=>$u_pass,'email'=>$u_email,'address'=>$u_address,'gender'=>$u_gender,'phone'=>$ph_no,'role'=>$u_role);
       $u_data2=array('email'=>$u_email,'dob'=>$u_dob,'dept'=>$u_dept,'u_sslc'=>$u_sslc,'u_plustwo'=>$u_plustwo);
       $this->Create_user_model->insert_student($u_data1,$u_data2);
       $this->session->set_flashdata('insert_success',"Sucessfully inserted");
       redirect('hod/add_student','refresh');
     }
     else
     {
      $this->session->set_flashdata('insert_failed',"insertion failed");
       redirect('Super_admin/add_student','refresh');
     }
   }
   public function insert_student_professor()
   {
     if($this->input->post('u_reg'))
     {
      $id=$_SESSION['u_id'];
      $this->db->select('*');
      $this->db->from('incharge_list');
      $this->db->where('user_incharge',$id);
      $sql=$this->db->get();
      foreach($sql->result() as $user_data)
      {
        $sem=$user_data->semester;
        $u_dept=$user_data->incharge_dept;
      }

       $f_name=$this->input->post('f_name');
       $l_name=$this->input->post('l_name');
       $u_name=$f_name." ".$l_name;
       $u_email=$this->input->post('u_email');
       $u_address=$this->input->post('u_address');
       $u_gender=$this->input->post('u_gender');
       $u_dob=$this->input->post('u_dob');
       $u_sslc=$this->input->post('u_sslc');
       $u_plustwo=$this->input->post('u_plustwo');
       $u_sslcboard=$this->input->post('u_sslcboard');
       $u_plusboard=$this->input->post('u_plusboard');
       $ph_no=$this->input->post('ph_no');
       $u_pass=md5($this->input->post('u_pass'));
       $u_course=$this->input->post('course');
       
       $u_role="student";
       $u_data1=array('name'=>$u_name,'password'=>$u_pass,'email'=>$u_email,'address'=>$u_address,'gender'=>$u_gender,'phone'=>$ph_no,'role'=>$u_role);
       $u_data2=array('email'=>$u_email,'dob'=>$u_dob,'dept'=>$u_dept,'s_sem'=>$sem,'s_course'=>$u_course,'u_sslc'=>$u_sslc,'u_plustwo'=>$u_plustwo,'u_sslcboard'=>$u_sslcboard,'u_plusboard'=>$u_plusboard);
       $this->Create_user_model->insert_student($u_data1,$u_data2);
       $this->session->set_flashdata('insert_success',"Sucessfully inserted");
       redirect('professor/add_student','refresh');
     }
     else
     {
      $this->session->set_flashdata('insert_failed',"insertion failed");
       redirect('professor/add_student','refresh');
     }
   }
   public function insert_professor_hod()
   {
     if($this->input->post('u_reg'))
     {
       $f_name=$this->input->post('f_name');
       $l_name=$this->input->post('l_name');
       $u_name=$f_name." ".$l_name;
       $u_email=$this->input->post('u_email');
       $u_address=$this->input->post('u_address');
       $u_gender=$this->input->post('u_gender');
       $u_dob=$this->input->post('u_dob');
       $ph_no=$this->input->post('ph_no');
       $u_pass=md5($this->input->post('u_pass'));
       $u_dept=$this->input->post('u_dept');
       $u_role="professor";
       $u_data1=array('name'=>$u_name,'password'=>$u_pass,'email'=>$u_email,'address'=>$u_address,'gender'=>$u_gender,'phone'=>$ph_no,'role'=>$u_role);
       $u_data2=array('email'=>$u_email,'dob'=>$u_dob,'dept'=>$u_dept);
       $this->Create_user_model->insert_professor($u_data1,$u_data2);
       $this->session->set_flashdata('insert_success',"Sucessfully inserted");
       redirect('hod/add_professor','refresh');
     }
     else
     {
      $this->session->set_flashdata('insert_failed',"insertion failed");
       redirect('hod/add_professor','refresh');
     }
   }
   public function change_principal_process()
   {
     if($this->input->post('u_reg'))
     {
       $f_name=$this->input->post('f_name');
       $l_name=$this->input->post('l_name');
       $u_name=$f_name." ".$l_name;
       $u_email=$this->input->post('u_email');
       $u_address=$this->input->post('u_address');
       $u_gender=$this->input->post('u_gender');
       $u_dob=$this->input->post('u_dob');
       $u_education=$this->input->post('u_education');
       $u_net=$this->input->post('u_net');
       $u_set=$this->input->post('u_set');
       $ph_no=$this->input->post('ph_no');
       $u_pass=md5($this->input->post('u_pass'));
       $u_role="principal";
       $u_data1=array('name'=>$u_name,'password'=>$u_pass,'email'=>$u_email,'address'=>$u_address,'gender'=>$u_gender,'phone'=>$ph_no,'role'=>$u_role);
       $u_data2=array('principal_email'=>$u_email,'dob'=>$u_dob,'u_education'=>$u_education,'u_net'=>$u_net,'u_set'=>$u_set);
       $this->Create_user_model->insert_principal($u_data1,$u_data2);
       $this->session->set_flashdata('insert_success',"Sucessfully inserted");
       redirect('super_admin/change_principal','refresh');
     }
     else
     {
      $this->session->set_flashdata('insert_failed',"insertion failed");
       redirect('super_admin/change_principal','refresh');
     }
   }
   public function insert_lab_assistant_hod()
   {
     if($this->input->post('u_reg'))
     {
       $f_name=$this->input->post('f_name');
       $l_name=$this->input->post('l_name');
       $u_name=$f_name." ".$l_name;
       $u_email=$this->input->post('u_email');
       $u_address=$this->input->post('u_address');
       $u_gender=$this->input->post('u_gender');
       $u_dob=$this->input->post('u_dob');
       $u_education=$this->input->post('u_education');
       $ph_no=$this->input->post('ph_no');
       $u_pass=md5($this->input->post('u_pass'));
       $u_dept=$this->input->post('u_dept');
       $u_role="lab assistant";
       $u_data1=array('name'=>$u_name,'password'=>$u_pass,'email'=>$u_email,'address'=>$u_address,'gender'=>$u_gender,'phone'=>$ph_no,'role'=>$u_role);
       $u_data2=array('email'=>$u_email,'dob'=>$u_dob,'dept'=>$u_dept,'u_education'=>$u_education);
       $this->Create_user_model->insert_lab_assistant($u_data1,$u_data2);
       $this->session->set_flashdata('insert_success',"Sucessfully inserted");
       redirect('hod/add_lab_assistant','refresh');
     }
     else
     {
      $this->session->set_flashdata('insert_failed',"insertion failed");
       redirect('hod/add_lab_assistant','refresh');
     }
   }
   public function insert_parent()
   {
     if($this->input->post('u_reg'))
     {
       $f_name=$this->input->post('f_name');
       $l_name=$this->input->post('l_name');
       $u_name=$f_name." ".$l_name;
       $u_email=$this->input->post('u_email');
       $u_address=$this->input->post('u_address');
       $u_gender=$this->input->post('u_gender');
       $ph_no=$this->input->post('ph_no');
       $s_mail=$this->input->post('s_mail');
       $u_pass=md5($this->input->post('u_pass'));
       $u_dept=$this->input->post('u_dept');
       $u_role="parent";
       $u_data1=array('name'=>$u_name,'password'=>$u_pass,'email'=>$u_email,'address'=>$u_address,'gender'=>$u_gender,'phone'=>$ph_no,'role'=>$u_role);
       $u_data2=array('email'=>$u_email,'s_mail'=>$s_mail,'dept'=>$u_dept);
       $this->Create_user_model->insert_parent($u_data1,$u_data2);
       $this->session->set_flashdata('insert_success',"Sucessfully inserted");
       redirect('professor/add_parent','refresh');
     }
     else
     {
      $this->session->set_flashdata('insert_failed',"insertion failed");
       redirect('professor/add_parent','refresh');
     }
   }
   public function insert_librarian()
   {
     if($this->input->post('u_reg'))
     {
       $f_name=$this->input->post('f_name');
       $l_name=$this->input->post('l_name');
       $u_name=$f_name." ".$l_name;
       $u_email=$this->input->post('u_email');
       $u_address=$this->input->post('u_address');
       $u_gender=$this->input->post('u_gender');
       $u_dob=$this->input->post('u_dob');
       $u_education=$this->input->post('u_education');
       $ph_no=$this->input->post('ph_no');
       $u_pass=md5($this->input->post('u_pass'));
       $u_role="librarian";
       $u_data1=array('name'=>$u_name,'password'=>$u_pass,'email'=>$u_email,'address'=>$u_address,'gender'=>$u_gender,'phone'=>$ph_no,'role'=>$u_role);
       $u_data2=array('email'=>$u_email,'dob'=>$u_dob,'u_education'=>$u_education);
       $this->Create_user_model->insert_librarian($u_data1,$u_data2);
       $this->session->set_flashdata('insert_success',"Successfully inserted");
       redirect('Super_admin/add_librarian','refresh');
     }
     
     else
     {
       $this->session->set_flashdata('insert_failed',"insertion failed");
       redirect('Super_admin/add_librarian','refresh');
     }
    }
    public function insert_office_staff()
    {
      if($this->input->post('u_reg'))
      {
        $f_name=$this->input->post('f_name');
        $l_name=$this->input->post('l_name');
        $u_name=$f_name." ".$l_name;
        $u_email=$this->input->post('u_email');
        $u_address=$this->input->post('u_address');
        $u_gender=$this->input->post('u_gender');
        $u_dob=$this->input->post('u_dob');
        $ph_no=$this->input->post('ph_no');
        $u_pass=md5($this->input->post('u_pass'));
        $u_role="office";
        $u_data1=array('name'=>$u_name,'password'=>$u_pass,'email'=>$u_email,'address'=>$u_address,'gender'=>$u_gender,'phone'=>$ph_no,'role'=>$u_role);
        $u_data2=array('email'=>$u_email,'dob'=>$u_dob);
        $this->Create_user_model->insert_office_staff($u_data1,$u_data2);
        $this->session->set_flashdata('insert_success',"Successfully inserted");
        redirect('Super_admin/add_office','refresh');
      }
      
      else
      {
        $this->session->set_flashdata('insert_failed',"insertion failed");
        redirect('Super_admin/add_office','refresh');
      }
     }
   public function leave_meeting()
   {
     $this->db->from('users');
     $this->db->select('*');
     $this->db->where('email',$_SESSION['u_id']);
     $sql=$this->db->get();
     foreach($sql->result() as $user_data)
     {
       $present=$user_data->role;
     }
     if($present=='professor')
     {
       $value1=array('meet_status'=>0);
       $value2=array('status'=>0);

       $this->db->where('email',$_SESSION["u_id"]);
       $this->db->update('professor_data',$value1);
       $this->db->where('meet_by',$_SESSION["u_id"]);
       $this->db->update('meeting_data',$value2);

       $this->session->set_flashdata('meeting_over',"Theernnu");
       redirect('Professor/live_meeting','refresh');
     }
     elseif($present=='student')
     {
      redirect('student/live_meeting','refresh');
     }
     else
     {
      
      redirect('parents/live_meeting','refresh');
     }
    
   }

   public function search()
   {

    $search=strtolower($_GET['s']);

    if (strpos($search, 'course') !== false OR strpos($search, 'ug')!== false OR strpos($search, 'pg')!== false OR strpos($search, 'course')!== false) 
    {
      redirect('Home/course','refresh');
    }
    elseif (strpos($search, 'department') !== false OR strpos($search, 'ug department')!== false OR strpos($search, 'pg depertment')!== false OR strpos($search, 'dept')!== false) 
    {
      redirect('Home/department','refresh');
    }
    elseif (strpos($search, 'about') !== false OR strpos($search, 'history')!== false OR strpos($search, 'mtcst')!== false OR strpos($search, 'college')!== false OR strpos($search, 'address')!== false) 
    {
      redirect('Home/about','refresh');
    }
    elseif (strpos($search, 'website') !== false OR strpos($search, 'home')!== false OR strpos($search, 'achivement')!== false OR strpos($search, 'activit')!== false) 
    {
      redirect('Home/','refresh');
    }
    elseif (strpos($search, 'gallery') !== false OR strpos($search, 'photo')!== false OR strpos($search, 'image')!== false OR strpos($search, 'pic')!== false) 
    {
      redirect('Home/gallery','refresh');
    }
    elseif (strpos($search, 'login') !== false OR strpos($search, 'sign')!== false OR strpos($search, 'logi')!== false) 
    {
      redirect('Home/login','refresh');
    }
   }
   public function forgot_mail()
   {
    $this->load->view("header");
    $this->load->view('forgot_mail.php');
    $this->load->view("footer");
   }
   public function send_mail()
   {
    $this->load->view('mailer.php');
   }
   public function reset_my_password()
   {
    $this->load->view("header");
    $this->load->view('reset_my_password.php');
    $this->load->view("footer");
   }
   public function reset_pass_process()
   {
    $email=$this->input->post('email');
    $old_pass=$this->input->post('old_pass');
    $new_password=$this->input->post('new_password');
    $confirm_password=$this->input->post('confirm_password');
    if($new_password==$confirm_password)
    {
      $users_list=$this->db->get_where('users',array('email'=>$email,'user_status'=>1,'password'=>$old_pass));
      if($users_list->num_rows()>0)
      {
        $value=array('password'=>md5($new_password));
        $this->db->where('email',$email);
        $this->db->update('users',$value);
        $this->session->set_flashdata('reset_success',"success");
        redirect('Home/login','refresh');
      }
      else
      {
        $this->session->set_flashdata('invalid_user',"failed");
        redirect('Home/login','refresh');
      }

    }

     

   }


}
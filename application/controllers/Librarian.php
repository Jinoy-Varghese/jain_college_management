<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Librarian extends CI_Controller
{
    
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Fullcalendar_model');
    $this->load->model('Create_user_model');
    $this->load->model('Librarian_model');
  }

  public function index()
  {
    $this->load->view("header.php");
    $this->load->view("librarian/dash_head.php");
    $this->load->view("librarian/index.php");
    $this->load->view("librarian/dash_footer.php");
    $this->load->view("footer.php"); 
  }
  public function add_books()
  {
    $this->load->view("header.php");
    $this->load->view("amp.php");
    $this->load->view("librarian/dash_head.php");
    $this->load->view("librarian/add_books.php");
    $this->load->view("librarian/dash_footer.php");
    $this->load->view("footer.php"); 
  }
  public function all_books()
  {
    $this->load->view("header.php");
    $this->load->view("amp.php");
    $this->load->view("librarian/dash_head.php");
    $this->load->view("librarian/all_books.php");
    $this->load->view("librarian/dash_footer.php");
    $this->load->view("footer.php"); 
  }
  public function insert_book()
  {
    $book_name=$this->input->post('book_name');
    $writer_name=$this->input->post('writer_name');
    $copies=$this->input->post('copies');
    $about=$this->input->post('about');
    $book_data=array('book_name'=>$book_name,'author'=>$writer_name,'copies'=>$copies,'about'=>$about);
    $this->Librarian_model->add_book($book_data);
    $this->session->set_flashdata('insert_success',"Sucessfully inserted");
    redirect('Librarian/add_books','refresh');
  }
  public function delete_book($book_id)
  {
   $this->Librarian_model->delete_book($book_id);
   $this->session->set_flashdata('delete_success',"Sucessfully deleted");
   redirect('Librarian/all_books','refresh');
  }
  public function update_book()
  {
    $this->load->view("header.php");
    $this->load->view("amp.php");
    $this->load->view("librarian/dash_head.php");
    $this->load->view("librarian/update_book");
    $this->load->view("librarian/dash_footer.php");
    $this->load->view("footer.php");
  }
  public function update_book_process()
  {
    $book_name=$this->input->post('book_name');
    $writer_name=$this->input->post('writer_name');
    $copies=$this->input->post('copies');
    $about=$this->input->post('about');
    $book_id=$this->input->post('book_id');
    $book_data=array('book_name'=>$book_name,'author'=>$writer_name,'copies'=>$copies,'about'=>$about);
    $this->Librarian_model->update_book($book_data,$book_id);
    $this->session->set_flashdata('update_success',"Sucessfully inserted");
    redirect('Librarian/all_books','refresh');
  }
  public function issue_book()
  {
    $this->load->view("header.php");
    $this->load->view("amp.php");
    $this->load->view("librarian/dash_head.php");
    $this->load->view("librarian/issue_book");
    $this->load->view("librarian/dash_footer.php");
    $this->load->view("footer.php");
  }
  public function issue_book_page()
  {
    $this->load->view("header.php");
    $this->load->view("amp.php");
    $this->load->view("librarian/dash_head.php");
    $this->load->view("librarian/issue_book_page");
    $this->load->view("librarian/dash_footer.php");
    $this->load->view("footer.php");
  }
  public function issue_book_process()
  {
    $book_id=$this->input->post('book_id');
    $return_date=$this->input->post('return_date');
    $borrower_id=$this->input->post('borrower_id');
    $status="issued";
    $sql=$this->db->select('b_times,copies')->from('books')->where('book_id',$book_id)->get();
    foreach($sql->result() as $b)
    {
      $b_times=$b->b_times;
      $copies=$b->copies;
    }
    $b_times=$b_times+1;
    $copies=$copies-1;
    $book_up=array('b_times'=>$b_times,'copies'=>$copies);
    $this->Librarian_model->update_book($book_up,$book_id);
    $issue_data=array('book_id'=>$book_id,'return_date'=>$return_date,'borrower_id'=>$borrower_id,'status'=>$status);
    $this->Librarian_model->issue_book($issue_data);
    $this->session->set_flashdata('book_issued',"Sucessfully inserted");
    redirect('Librarian/issue_book','refresh');
  }
  public function issued_books()
  {
    $this->load->view("header.php");
    $this->load->view("amp.php");
    $this->load->view("librarian/dash_head.php");
    $this->load->view("librarian/issued_books");
    $this->load->view("librarian/dash_footer.php");
    $this->load->view("footer.php");
  }
  public function mark_as_returned($issue)
  {
    $sql=$this->db->select('book_id')->from('book_issues')->where('id',$issue)->get();
    foreach($sql->result() as $b)
    {
      $book_id=$b->book_id;
    }
    $return_data=$issue;
    $sql=$this->db->select('copies')->from('books')->where('book_id',$book_id)->get();
    foreach($sql->result() as $b)
    {
      $copies=$b->copies;
    }
    $copies=$copies+1;
    $book_up=array('copies'=>$copies);
    $this->Librarian_model->update_book($book_up,$book_id);
    
    $this->Librarian_model->mark_as_returned($return_data);
    $this->session->set_flashdata('book_returned',"Sucessfully inserted");
    redirect('Librarian/issued_books','refresh');
  }
  public function Librarian_profile()
  {
    $this->load->view("header.php");
    $this->load->view("librarian/dash_head.php");
    $this->load->view("librarian/my_profile3.php");
    $this->load->view("librarian/dash_footer.php");
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
     $this->Librarian_model->update_profile($update_data,$id);
     $this->session->set_flashdata('update_success',"Successfully Updated");
     redirect('Librarian/Librarian_profile','refresh');
    }
    else
    {
      $this->session->set_flashdata('update_failed',"Updation Failed");
      redirect('Librarian/Librarian_profile','refresh');
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
            redirect('Librarian/Librarian_profile','refresh');
          }
          else
          {
            $this->session->set_flashdata('changepass_failed',"New Password & Confirm Password Mismatch...!");
            redirect('Librarian/Librarian_profile','refresh');
          }
        }
        else
        {
          $this->session->set_flashdata('changepass_old_failed',"Current Password Mismatch...!");
          redirect('Librarian/Librarian_profile','refresh');
        }
   }
   else
   {
     $this->session->set_flashdata('changepass_wrong',"Password is wrong...!");
     redirect('Librarian/Librarian_profile','refresh');
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
    redirect('Librarian/Librarian_profile','refresh');
  }
}


/* End of file Librarian.php */
/* Location: ./application/controllers/Librarian.php */

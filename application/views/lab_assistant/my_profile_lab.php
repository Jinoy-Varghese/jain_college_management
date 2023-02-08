<div class="container p-lg-4 ">
<?php 
if($this->session->flashdata('update_success')){
 echo '
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> Record Updated Successfully.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
if($this->session->flashdata('update_failed')){
    echo '
   <div class="alert alert-danger alert-dismissible fade show" role="alert">
     <strong>Failed!</strong> Something Went wrong, please try again.
     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
       <span aria-hidden="true">&times;</span>
     </button>
   </div>';
   }
   if($this->session->flashdata('changepass_success')){
    echo '
   <div class="alert alert-success alert-dismissible fade show" role="alert">
     <strong>Success!</strong> Password Changed Successfully.
     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
       <span aria-hidden="true">&times;</span>
     </button>
   </div>';
   }
   if($this->session->flashdata('changepass_failed')){
       echo '
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Failed!</strong> New Password & Confirm Password Mismatch...!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
      }
   if($this->session->flashdata('changepass_old_failed')){
       echo '
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Failed!</strong> Current Password Mismatch...!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
      }
      if($this->session->flashdata('changepass_wrong')){
        echo '
       <div class="alert alert-danger alert-dismissible fade show" role="alert">
         <strong>Failed!</strong> Password is wrong...!
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>';
       }      
?>
<?php
defined('BASEPATH') or exit('No direct script access allowed');
if(!isset($_SESSION['u_id']))
{
  redirect('Home/login','refresh');
}
?>

<nav aria-label="breadcrumb mt-sm-5">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">My Profile</li>
        </ol>
    </nav>

<head>
<style>
.personal
{
    height:40px;
    width:100%;
    border:none;
    background:#3c3c3c;
    color:#fff;
    text-align:center;
    padding:8px 8px;
    border:2px solid #f3f3f3;
    
    border-radius:0px 0px 0px 15px;
    outline:none;
    transition:0.5s;
}
.changepw
{
    height:40px;
    width:100%;
    border:none;
    outline:none; 
    background:#fff;
    text-align:center;
    padding:8px 8px;
    border:2px solid #f3f3f3;
    
    border-radius:0px 0px 15px 0px;
    transition:0.5s; 
}  
</style>
</head>

<?php
$sql=$this->db->get_where('users',array('email'=>$_SESSION["u_id"]));
foreach($sql->result() as $user_details)
{
  $user_details->name;
} 
?>

<script>
$(document).ready(function(){
    $(".personal").click(function(){
      $("#details").css("display","block");
      $("#changepass").css("display","none");
      $(".personal").css("background","#3c3c3c");
      $(".personal").css("color","#fff");
      $(".changepw").css("background","#fff");
      $(".changepw").css("color","#000");
    });
    $(".changepw").click(function(){
      $("#details").css("display","none");
      $("#changepass").css("display","block");
      $(".changepw").css("background","#3c3c3c");
      $(".changepw").css("color","#fff");
      $(".personal").css("background","#fff");
      $(".personal").css("color","#000");
    });
  });    
</script> 

<div class="container">
		<div class="row">
	
		<div class="col-md-3 col-12 mt-5">
		<?php
    $this->db->from('users');
    $this->db->select('*');
     $this->db->where('email',$_SESSION['u_id']);
     $sql=$this->db->get();
     foreach($sql->result() as $user_data)
     {
       $image=$user_data->u_image;
       if($image==null)
       {
        echo "<img src='".base_url('assets/img/no-profile.jpg')."' class='img-fluid img-thumbnail'>";
       }
       else
       {
        echo "<img src='".base_url($image)."' class='img-fluid img-thumbnail' style='height:250px;'>";
       }
           }
           ?>
		</div>
    
    <div class="col-md-3 col-12 text-center pt-md-5 ml-md-n3">
      <div class="pt-md-3"></div>
      <h2 class="col-12 pt-md-5" style="white-space:nowrap;"><?php echo strtoupper($user_details->name);?></h2>
      <div class="col-12"><h6 class="badge badge-dark" style="font-size:1rem;"><?php echo strtoupper($user_details->role);?></h6></div>

      <div class="col-12 pt-md-5 ml-md-n4">
        <div class="custom-file">
        <label for="select_img" class="btn btn-primary" style="height:35px;"><i class="fas fa-camera"></i>&nbsp&nbspChoose Photo</label>
        <form method="post" action="<?php echo base_url("Lab_assistant/upload_image");?>" enctype="multipart/form-data">
        <input type="file" class="custom-file-input" name="image" id="select_img"  onchange="this.form.submit()">
        </form>
        </div>
      </div>
    </div>
    <div class="ml-md-n5"><hr class="ml-md-n5" style="width:400vw;"></div>

    <div class="col-md-2 col-6 mt-n3 p-0"><button id="personal" class="personal" style="outline:none;"><h6>Personal Details</h6></button></div>
    <div class="col-md-2 col-6 mt-n3 p-0"><button id="changepw" class="changepw" style="outline:none;"><h6>Change Password</h6></button></div>


		</div> <!--End of 1st div row!--> 
		</div> <!--End of 1st div container!--> 

<!--Details update fields!--> 

<div class="container">


<div class="row" id="details">

<div class="col-md-12 col-12 text-center mt-3"><h4><b><u>PERSONAL DETAILS</u></b></h4></div>

<div class="col-md-12">
<form class="needs-validation mt-5" novalidate method="post" action="<?php echo base_url("Lab_assistant/update_profile");?>">
  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="validationCustom01">User_ID</label>
      <input type="number" class="form-control" name="id" id="validationCustom01" value="<?php echo $user_details->id;?>" readonly>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationCustom02">Name</label>
      <input type="text" class="form-control" name="name" id="validationCustom02" value="<?php echo $user_details->name;?>" required>
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationCustom03">E-mail</label>
      <input type="email" class="form-control" name="email" id="validationCustom03" value="<?php echo $user_details->email;?>" readonly>
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-5 mb-3">
      <label for="validationCustom04">Address</label>
      <input type="text" class="form-control" name="address" id="validationCustom04" value="<?php echo $user_details->address;?>" required>
    </div>
    <div class="col-md-3 mb-3">
      <label for="validationCustom05">Gender</label>
      <select class="custom-select" name="gender" id="validationCustom05" required>
      <?php
      if($user_details->gender=='m')
      {
      ?>
        <option name="gender" disabled value="">Choose...</option>
        <option name="gender" value="m" selected>Male</option>
        <option name="gender" value="f">Female</option>
        <?php
      }
      elseif($user_details->gender=='f')
      {
      ?>
      <option name="gender" disabled value="">Choose...</option>
      <option name="gender" value="m">Male</option>
      <option name="gender" value="f" selected>Female</option>
      <?php
      }
      ?>
      </select>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationCustom06">Mobile Number</label>
      <input type="text" class="form-control" name="phone" id="validationCustom06" value="<?php echo $user_details->phone;?>" required>
      <div class="invalid-feedback">
        Please provide a valid zip.
      </div>
    </div>
  </div>
  <input type="hidden" value="<?php echo $user_details->id;?>" name="id">


  <div class="col text-center mb-5">
  <input class="btn btn-primary" name="update_user" type="submit" value="Update Details">
  </div>

</form>
</div>

</div>
</div>

<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>

<!--Change Password fields!--> 

<div id="changepass" style="display:none;" class="mb-5">
<div class="col-md-12 col-12 text-center mt-3"><h4><b><u>CHANGE PASSWORD</u></b></h4></div>
<div class="col-md-12">
<form class="needs-validation mt-5" novalidate action="<?php echo base_url("Lab_assistant/change_password");?>" method="post">
  <div class="form-row">
  <div class="col-md-4 mb-3">
    <label for="inputPassword5">Current Password</label>
    <input type="password" id="inputPassword5" class="form-control" aria-describedby="passwordHelpBlock" name="current" required>
  </div>
  <div class="col-md-4 mb-3">
    <label for="inputPassword5">New Password</label>
    <input type="password" id="inputPassword5" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,20}" aria-describedby="passwordHelpBlock" name="new" required>
    <small id="passwordHelpBlock" class="form-text text-muted ">
    Your password must be 8-20 characters long, contain letters (both upper and lower case) and numbers.
    </small>
  </div>
  <div class="col-md-4 mb-3">
    <label for="inputPassword5">Confirm Password</label>
    <input type="password" id="inputPassword5" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,20}" aria-describedby="passwordHelpBlock" name="confirm" required>
    </div>
  </div>
  <input type="hidden" value="<?php echo $user_details->id;?>" name="id">
  <div class="col text-center mt-3">
  <input class="btn btn-primary" type="submit" value="Change Password" name="changepw_btn">
  </div>
</form>
</div>


</div>
</div>
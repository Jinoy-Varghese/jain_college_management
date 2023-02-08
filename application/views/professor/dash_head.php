<?php
defined('BASEPATH') or exit('No direct script access allowed');
if(!isset($_SESSION['u_id']) OR $_SESSION['role']!="professor")
{
  redirect('Home/login','refresh');
}

?>
<style>
@keyframes bell-shake {
    0% {
        transform: rotate(0deg);
    }
    5% {
        transform: rotate(10deg);
    }
    10% {
        transform: rotate(-10deg);
    }
    15% {
        transform: rotate(10deg);
    }
    20% {
        transform: rotate(-10deg);
    }
    25% {
        transform: rotate(0deg);
    }
    75% {
        transform: rotate(0deg);
    }
    80% {
        transform: rotate(10deg);
    }
    85% {
        transform: rotate(-10deg);
    }
    90% {
        transform: rotate(10deg);
    }
    95% {
        transform: rotate(-10deg);
    }
    100% {
        transform: rotate(0);
    }
}
.alert-bell {
  animation: bell-shake 1.5s cubic-bezier(0.250, 0.460, 0.450, 0.940) infinite;
  animation-delay: 4s;
}
.dropdown-menu-arrow,.dropdown-menu-arrow2 {
  top: -26px;
  left: 7%;
  width: 0;
  height: 0;
  position: relative;
}
.dropdown-menu-arrow:before,
.dropdown-menu-arrow2:before,
.dropdown-menu-arrow2:after,
.dropdown-menu-arrow:after {
  content: "";
  position: absolute;
  display: block;
  width: 0;
  height: 0;
  border-width: 7px 8px;
  border-style: solid;
  border-color: transparent;
  z-index: 1001;
}
.dropdown-menu-arrow:after,.dropdown-menu-arrow2:after {
  bottom: -18px;
  right: -8px;
  border-bottom-color: #fff;
}
.dropdown-menu-arrow:before,.dropdown-menu-arrow2:before {
  bottom: -17px;
  right: -8px;
  border-bottom-color: coral;
}

</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="<?php echo base_url('assets/js/sweetalert2.all.min.js'); ?>"></script>
<?php 
  $sql=$this->db->get_where('users',array('email'=>$_SESSION["u_id"]));
  foreach($sql->result() as $user_name)
  {
    $user_name->name;
  }
?>

  <!-- Custom styles for this template -->

  <link href="<?php echo base_url('assets/css/simple-sidebar.css'); ?>" rel="stylesheet">
  <!--navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top sticky-top mt-0 mb-0 pb-0 pt-0"><!-- sticky top can be replaced with fixed-botto or fixed-top -->
    <button class="btn btn-primary" id="menu-toggle">Menu</button>
    <a href="#" class="navbar-brand mx-auto mt-0 mb-0 pb-0 pt-0"><div class='rounded-circle ml-md-2'><img src="<?php echo base_url('assets/image/logo1.png');?>"class="ml-n1 mt-n1" style='width:60px; height:60px;'></div></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarTogglerDemo02">
      <ul class="navbar-nav my-2 my-lg-0">
        <li class="nav-item active"><a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a></li>
       
       
        <li class="nav-item dropdown ">
            <a class="nav-link " href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
             <i class="fas fa-bell 
             
             <?php
                $sql=$this->db->select('meet_status')->from('professor_data')->where('email',$_SESSION['u_id'])->get();
                foreach($sql->result() as $value)
                {
                  $status=$value->meet_status;
                }
                if($status==1)
                {
             ?>
             text-warning alert-bell
             <?php 
                }
              ?>
             
             "></i>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="border-top-color: coral;">
            <span class="dropdown-menu-arrow "></span>
            <?php
              if($status==1)
              {
            ?>
              <a class="dropdown-item" href="<?php echo base_url('Home/leave_meeting') ?>">A meeting is running on background.<br> Click to close meeting</a>
              <?php 
              }
              else
              {
              ?>
               <a class="dropdown-item" href="#">No Notifications</a>
              <?php
              }
               ?>
            </div>
          </li>



        <li class="nav-item dropdown mr-4">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <?php echo $user_name->name; ?>
            
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="border-top-color: coral;">
            <span class="dropdown-menu-arrow" ></span>
              <a class="dropdown-item" href="<?php echo site_url(); ?>Professor/professor_profile"><i class="fa fa-user mr-1"></i>My Profile</a>
              <a href="<?php echo base_url(); ?>home/logout" class="dropdown-item" id="logoutbtn_id"><i class="fa fa-power-off mr-1"></i>Logout</a>
            </div>
          </li>
      </ul>
      <form class="form-inline my-2 my-lg-0" method="get" action="<?php echo base_url('/Home/search'); ?>">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" name="s">
        <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
  </nav>

  <!--/navigation-->
  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">
      <?php
         $this->db->from('users');
         $this->db->select('*');
         $this->db->join('professor_data','professor_data.email=users.email');
         $this->db->where('professor_data.email',$_SESSION['u_id']);
         $sql=$this->db->get();
        foreach($sql->result() as $user_data)
        {  
          $dept=$user_data->dept;
          $image=$user_data->u_image;
          if($image==null)
          {
            echo "<img src='".base_url('assets/img/no-profile.jpg')."' class='img-fluid img-thumbnail rounded-circle ml-md-2 ml-2' style='width:150px; height:150px;'>";
          }
          else
          {
            echo "<img src='".base_url($image)."' class='img-fluid img-thumbnail rounded-circle ml-md-2 ml-2' style='width:150px;'>";
          }
        }
     ?>
    
<!-- special privilage -->
<?php
  $time1=0;
  $time2=2;
  $this->db->select('*');
  $this->db->from('incharge_list');
  $this->db->where('user_incharge',$_SESSION['u_id']);
  $this->db->limit(1);
  $this->db->order_by('timestamp','DESC');
  $sql=$this->db->get();
  foreach($sql->result() as $user_data)
  {
    $course1=$user_data->course;
    $sem1=$user_data->semester;
    $time1=$user_data->timestamp;
    $this->db->select('*');
    $this->db->from('incharge_list');
    $this->db->where('course',$course1);
    $this->db->where('semester',$sem1);

    $this->db->limit(1);
    $this->db->order_by('timestamp','DESC');
    $sql=$this->db->get();
    foreach($sql->result() as $user_data)
    {
    $time2=$user_data->timestamp;
    }
  }

  if($time1>=$time2)
  {
    $extra_menu=1;
  }
  else{
    $extra_menu=0;
  }

?>
<!-- /special privilage -->



      <div class="text-center font-weight-bold"><?php echo $user_name->name; ?></div>
      </div>
      <div class="list-group list-group-flush">
        <a href="<?php echo site_url(); ?>Professor/" class="list-group-item list-group-item-action bg-light">Dashboard</a>
        <?php
            if($extra_menu==1)
            {
          ?>
        <a href="<?php echo site_url(); ?>Professor/view_students" class="list-group-item list-group-item-action bg-light">My Students</a>
        <?php
            }
          ?>
        <div class="list-group-item  bg-light sub-menu"><a href='#drop-down' class="drop-down-n w-100">Add Users<div class='angle fas fa-angle-down right'></div></a></div>
          <ul class="drop-down-ul">
            <a href='<?php echo site_url(); ?>Professor/add_student' class="drop-down-a"><li class="drop-down-li">Student</li></a>
            <a href='<?php echo site_url(); ?>Professor/add_parent' class="drop-down-a"><li class="drop-down-li">Parent</li></a>
          </ul>

        <div class="list-group-item  bg-light sub-menu3"><a href='#drop-down2' class="drop-down-n w-100">Attendance<div class='angle fas fa-angle-down right'></div></a></div>
          <ul class="drop-down-ul3" style="background:#DAE0E5;">
          <?php
            if($extra_menu==1)
            {
          ?>
            <a href="<?php echo site_url(); ?>Professor/mark_attendance" class="drop-down-a"><li class="drop-down-li">Common Attendance</li></a>
          <?php
            }
          ?>
            <a href="<?php echo site_url(); ?>Professor/subject_attendance" class="drop-down-a"><li class="drop-down-li">Subject Attendance</li></a>
        </ul>
                
        <div class="list-group-item  bg-light sub-menu2"><a href='#drop-down2' class="drop-down-n w-100">Exams<div class='angle fas fa-angle-down right'></div></a></div>
          <ul class="drop-down-ul2" style="background:#DAE0E5;">
            <a href='<?php echo site_url(); ?>Professor/create_exam' class="drop-down-a"><li class="drop-down-li">Create Exam</li></a>
            <a href='<?php echo site_url(); ?>Professor/monitor_student' class="drop-down-a"><li class="drop-down-li">Monitor Exam</li></a>
            <a href='<?php echo site_url(); ?>Professor/exams_conducted' class="drop-down-a"><li class="drop-down-li">Exams Conducted</li></a>
            <a href='<?php echo site_url(); ?>Professor/offline_mark' class="drop-down-a" title="Upload marks of exams conducted offline"><li class="drop-down-li">Upload Offline Marks</li></a>
          </ul>
        <a href="<?php echo site_url(); ?>Professor/live_meeting" class="list-group-item list-group-item-action bg-light">Live Meeting <i class="fas fa-video float-right mt-1"></i></a>
        <div class="list-group-item  bg-light sub-menu4"><a href='#drop-down4' class="drop-down-n w-100">Lab Data<div class='angle fas fa-angle-down right'></div></a></div>
          <ul class="drop-down-ul4" style="background:#DAE0E5;">
            <a href='<?php echo site_url(); ?>Professor/lab_record' class="drop-down-a"><li class="drop-down-li">Record</li></a>
            <a href='<?php echo site_url(); ?>Professor/lab_pps' class="drop-down-a"><li class="drop-down-li">PPS</li></a>
          </ul>

          <div class="list-group-item  bg-light sub-menu5"><a href='#drop-down2' class="drop-down-n w-100">Assignments<div class='angle fas fa-angle-down right'></div></a></div>
          <ul class="drop-down-ul5" style="background:#DAE0E5;">
            <a href='<?php echo site_url(); ?>Professor/add_assignment' class="drop-down-a"><li class="drop-down-li">Add Assignments</li></a>
            <a href='<?php echo site_url(); ?>Professor/view_assignment' class="drop-down-a"><li class="drop-down-li">View Assignments</li></a>
            <a href='<?php echo site_url(); ?>Professor/assignments' class="drop-down-a"><li class="drop-down-li">Mark Assignments</li></a>
         </ul>


        <a href="<?php echo site_url(); ?>Professor/notes" class="list-group-item list-group-item-action bg-light">Notes</a>
        <a href="<?php echo site_url(); ?>Professor/lab_complaint" class="list-group-item list-group-item-action bg-light">Report Complaints</a>
  <?php
      if($extra_menu==1)
      {
        echo '<a href="'.site_url().'Professor/view_internal_mark" class="list-group-item list-group-item-action bg-light">View Internal Mark</a>';
      }
  ?>
        




        
        
      </div>
    </div>
    <!-- /#sidebar-wrapper -->
    <script>
$('#logoutbtn_id').on('click',function(e)
{
    e.preventDefault();
    const href=$(this).attr('href')

    Swal.fire({
  title: 'ARE YOU SURE?',
  text: "Do you want to Log Out",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#dc3545',
  cancelButtonColor: '#6c757d',
  confirmButtonText: 'Log Out'
}).then((result) => {
  if (result.value) {
    document.location.href=href;
  }
})
})
</script>
    <!-- Page Content -->
    <div id="page-content-wrapper">

      <div class="container-fluid">



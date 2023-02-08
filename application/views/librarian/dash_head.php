<?php
defined('BASEPATH') or exit('No direct script access allowed');
if(!isset($_SESSION['u_id']) OR $_SESSION['role']!="librarian")
{
  redirect('Home/login','refresh');
}

?>
<style>
#navbarDropdownMenuLink::after
  .dropdown-menu-arrow {
  top: -26px;
  left: 7%;
  width: 0;
  height: 0;
  position: relative;
}
.dropdown-menu-arrow:before,
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
.dropdown-menu-arrow:after {
  bottom: -18px;
  right: -8px;
  border-bottom-color: white;
}
.dropdown-menu-arrow:before {
  bottom: 80px;
  right: 140px;
  border-bottom-color: white;
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
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top sticky-top mt-0 mb-0 pb-0 pt-0">
    <button class="btn btn-primary" id="menu-toggle">Menu</button>
    <a href="#" class="navbar-brand mx-auto"><div class='rounded-circle ml-md-2'><img src="<?php echo base_url('assets/image/logo1.png');?>"class="ml-n1 mt-n1" style='width:60px; height:60px;'></div></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="true" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarTogglerDemo02">
      <ul class="navbar-nav my-2 my-lg-0">
        <li class="nav-item active"><a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a></li>
        <li class="nav-item dropdown mr-4">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <?php echo $user_name->name; ?>
            
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="border-top-color: coral;">
            <span class="dropdown-menu-arrow" ></span>
              <a class="dropdown-item" href="<?php echo site_url(); ?>Librarian/librarian_profile"><i class="fa fa-user mr-1"></i>My Profile</a>
              <a href="<?php echo site_url(); ?>home/logout" class="dropdown-item" id="logoutbtn_id"><i class="fa fa-power-off mr-1"></i>Logout</a>
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
     $this->db->where('email',$_SESSION['u_id']);
     $sql=$this->db->get();
     foreach($sql->result() as $user_data)
     {
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
    
      <div class="text-center font-weight-bold"><?php echo $user_name->name; ?></div>
      </div>
      <div class="list-group list-group-flush">
        <a href="<?php echo site_url(); ?>Librarian/" class="list-group-item list-group-item-action bg-light">Dashboard</a>
        <a href="<?php echo site_url(); ?>Librarian/all_books" class="list-group-item list-group-item-action bg-light">All Books</a>
        <a href="<?php echo site_url(); ?>Librarian/add_books" class="list-group-item list-group-item-action bg-light">Add New Book</a>
        <a href="<?php echo site_url(); ?>Librarian/issue_book" class="list-group-item list-group-item-action bg-light">Issue Book</a>
        <a href="<?php echo site_url(); ?>Librarian/issued_books" class="list-group-item list-group-item-action bg-light">Issued Books</a>
        
        
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

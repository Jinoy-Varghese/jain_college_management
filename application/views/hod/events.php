

<div class="container p-lg-4 ">
<?php 
if($this->session->flashdata('insert_success')){
 echo '
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> New record created.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
if($this->session->flashdata('insert_failed')){
    echo '
   <div class="alert alert-danger alert-dismissible fade show" role="alert">
     <strong>Failed!</strong> Something Wend wrong, please try again.
     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
       <span aria-hidden="true">&times;</span>
     </button>
   </div>';
   }
?>
<nav aria-label="breadcrumb mt-sm-5">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Notice Board</li>
    </ol>
    </nav>
    <form class="needs-validation mt-5" novalidate method="post" action="<?php echo base_url();?>hod/Events_process">
        
        
        <div class="form-row">
            
            <div class="col-md-4 mb-3">
                <label for="validationCustom04">Description</label>
                <textarea cols='40' rows='10' class="form-control" id="validationCustom01" value=""  name="desc" required ></textarea>
             <div class="mt-3">  
              <input class="btn btn-primary" type="submit" name="u_reg" value="Submit"></div>
     </form>
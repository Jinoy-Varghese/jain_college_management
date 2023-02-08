

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
        <li class="breadcrumb-item active" aria-current="page">Add Course</li>
    </ol>
    </nav>
    <form class="needs-validation mt-5" novalidate method="post" action="<?php echo base_url();?>hod/add_course_process">
        
        
        <div class="form-row">
            
            <div class="col-md-4 mb-3">
                <label for="validationCustom04">Gradguation</label>
                <select class="custom-select" id="validationCustom04" name="gradguation" required>
                    <option selected disabled value="">Choose...</option>
                    <option value="UG">UG</option>
                    <option value="PG">PG</option>
                </select>
                <div class="invalid-feedback">
                    Please select a Gradguation.
                </div>
            </div>
            
            <div class="col-md-4 mb-3">
                <label for="validationCustom04">Course Name</label>
                <input type="text" class="form-control" id="validationCustom01" value="" name="course_name" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
                <div class="invalid-feedback">
                    Please enter a Course Name.
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <label for="validationCustom04">No. of Semester</label>
                <input type="number" class="form-control" id="validationCustom03" value="" name="sem_num" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
                <div class="invalid-feedback">
                    Please enter the number of semester.
                </div>
            </div>
          </div>
    
            <input class="btn btn-primary" type="submit" name="u_reg" value="Submit form">
            </form>
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

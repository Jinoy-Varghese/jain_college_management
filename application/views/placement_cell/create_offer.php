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
   if(isset($_SESSION['insert_failed'])){
    unset($_SESSION['insert_failed']);
}
if(isset($_SESSION['insert_success'])){
    unset($_SESSION['insert_success']);
}
?>
    <nav aria-label="breadcrumb mt-sm-5">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create Offer</li>
        </ol>
    </nav>
    <form class="needs-validation mt-5" novalidate method="post"
        action="<?php echo base_url();?>Placement_cell/create_offer_process" enctype="multipart/form-data">
        <div class="form-row">
            <div class="col-md-4 mb-3">
                <label for="validationCustom01">Company Name</label>
                <input type="text" class="form-control" id="validationCustom01" name="c_name" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
                <div class="invalid-feedback">
                    Please provide a Company Name.
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <label for="validationCustom02">Company Logo</label>
                <input type="file" class="form-control " id="validationCustom02" name="c_logo" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
                <div class="invalid-feedback">
                    Please provide a Company Logo.
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <label for="exampleInputEmail1">Job Post</label>
                <input type="text" class="form-control" id="validationCustom02" name="job_post" required>
                <div class="invalid-feedback">
                    Please provide a valid Job Post.
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6 mb-3">
                <label for="validationCustom03">Job Location</label>
                <input type="text" class="form-control" id="validationCustom03" name="job_location" required>
                <div class="invalid-feedback">
                    Please provide a Location.
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="validationCustom03">Salary</label>
                <input type="number" class="form-control" id="validationCustom03" name="job_salary" required>
                <div class="invalid-feedback">
                    Please provide a Salary.
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="validationCustom05">Job Description</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="1" name="job_description" required></textarea>
                <div class="invalid-feedback">
                    Please provide a valid Job Description.
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="validationCustom05">Eligibility</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="1" name="job_eligibility" required></textarea>
                <div class="invalid-feedback">
                    Please provide a valid Eligibility.
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="validationCustom05">About Company</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="1" name="about_company" required></textarea>
                <div class="invalid-feedback">
                    Please provide a valid Company details.
                </div>
            </div>
 
            <div class="col-md-6 mb-3">
                <label for="validationCustom05">Last Date</label>
                <input type="date" class="form-control" id="validationCustom05" name="last_date" required>
                <div class="invalid-feedback">
                    Please provide a valid Date.
                </div>
            </div>

        </div>
        
        <input class="btn btn-primary" type="submit" name="create_offer_btn" value="Create Offer">
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
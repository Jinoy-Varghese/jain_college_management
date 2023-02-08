

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
        <li class="breadcrumb-item"><a href="#">Add User</a></li>
        <li class="breadcrumb-item active" aria-current="page">Change Principal</li>
    </ol>
    </nav>
    <form class="needs-validation mt-5" novalidate method="post" action="<?php echo base_url();?>home/change_principal_process">
    <div class="form-row">
        <div class="col-md-4 mb-3">
        <label for="validationCustom01">First name</label>
        <input type="text" class="form-control" id="validationCustom01" name="f_name" required>
        <div class="valid-feedback">
            Looks good!
        </div>
        <div class="invalid-feedback">
            Please provide a First Name.
        </div>
        </div>
        <div class="col-md-4 mb-3">
        <label for="validationCustom02">Last name</label>
        <input type="text" class="form-control" id="validationCustom02" name="l_name" required>
        <div class="valid-feedback">
            Looks good!
        </div>
        <div class="invalid-feedback">
            Please provide a Last Name.
        </div>
        </div>
        <div class="col-md-4 mb-3">
        <label for="exampleInputEmail1">e-mail</label>
        <input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" class="form-control" id="exampleInputEmail1" name="u_email" required>
        <div class="invalid-feedback">
            Please provide a valid email.
        </div>
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-6 mb-3">
        <label for="validationCustom03">Address</label>
        <input type="text" class="form-control" id="validationCustom03" name="u_address" required>
        <div class="invalid-feedback">
            Please provide a Address.
        </div>
        </div>
        <div class="col-md-3 mb-3">
        <label for="validationCustom04">Gender</label>
        <select class="custom-select" id="validationCustom04" name="u_gender" required>
            <option selected disabled value="">Choose...</option>
            <option value="m">M</option>
            <option value="f">F</option>
            <option value="other">Other</option>
        </select>
        <div class="invalid-feedback">
            Please select a Gender.
        </div>
        </div>
        <div class="col-md-3 mb-3">
        <label for="validationCustom05">Date of Birth</label>
        <input type="date" class="form-control" id="validationCustom05" name="u_dob" required>
        <div class="invalid-feedback">
            Please provide a valid Date.
        </div>
        </div>
        <div class="form-row">
        <div class="col-md-6 mb-3">
        <label for="validationCustom06">Education Qualification</label>
        <input type="text" class="form-control" id="validationCustom06" name="u_education" required>
        <div class="invalid-feedback">
            Please provide a Education Qualification.
        </div>
        </div>
        <div class="col-md-3 mb-3">
        <label for="validationCustom07">NET Exam</label>
        <select class="custom-select" id="validationCustom07" name="u_net" required>
            <option selected disabled value="">Choose...</option>
            <option value="Passed">Passed</option>
            <option value="Not Passed">Not Passed</option>
        </select>
        <div class="invalid-feedback">
            Please select a option.
        </div>
        </div>
        <div class="col-md-3 mb-3">
        <label for="validationCustom08">SET Exam</label>
        <select class="custom-select" id="validationCustom08" name="u_set" required>
            <option selected disabled value="">Choose...</option>
            <option value="Passed">Passed</option>
            <option value="Not Passed">Not Passed</option>
        </select>
        <div class="invalid-feedback">
            Please provide a option.    
        </div>
        </div>
        <div class="col-md-3 mb-3">
        <label for="validationCustom05">Phone Number</label>
        <input type="tel" pattern="^\d{10}$" class="form-control" id="validationCustom05" name="ph_no" required>
        <div class="invalid-feedback">
            Please provide a valid Phone Number.
        </div>
        </div>
        <div class="col-md-3 mb-3">
        <label for="inputPassword5">Password</label>
        <input type="password" id="inputPassword5" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,20}" aria-describedby="passwordHelpBlock" name="u_pass" required>
        <small id="passwordHelpBlock" class="form-text text-muted ">
        Your password must be 8-20 characters long, contain letters (both upper and lower case) and numbers.
        </small>
        </div>

    </div>
    <div class="form-group">
        <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
        <label class="form-check-label" for="invalidCheck">
            Agree to terms and conditions
        </label>
        <div class="invalid-feedback">
            You must agree before submitting.
        </div>
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

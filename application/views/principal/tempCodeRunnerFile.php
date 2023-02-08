<?php
<form class="needs-validation mt-5" novalidate method="post" action="<?php echo base_url();?>home/insert_hod">
    <div class="form-row">
        <div class="col-md-4 mb-3">
        <label for="validationCustom01">First name</label>
        <input type="text" class="form-control" id="validationCustom01" value="Mark" name="f_name" required>
        <div class="valid-feedback">
            Looks good!
        </div>
        <div class="invalid-feedback">
            Please provide a First Name.
        </div>
        </div>
        <div class="col-md-4 mb-3">
        <label for="validationCustom02">Last name</label>
        <input type="text" class="form-control" id="validationCustom02" value="Otto" name="l_name" required>
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
        <div class="col-md-3 mb-3">
        <label for="validationCustom04">Department</label>
        <select class="custom-select" id="validationCustom04" name="u_dept" required>
            <option selected disabled value="">Choose...</option>
            <option value="Computer Science">Computer Science</option>
            <option value="Polymer Chemistry">Polymer Chemistry</option>
            <option value="B.Com">B.Com</option>
            <option value="BBA">BBA</option>
            <option value="Botany">Botany</option>
            <option value="Electronics">Electronics</option>
            <option value="BA English">BA English</option>
        </select>
        <div class="invalid-feedback">
            Please select a Department.
        </div>
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
    <input class="btn btn-primary" type="submit" name="u_reg" value="Submit form">
    </form>
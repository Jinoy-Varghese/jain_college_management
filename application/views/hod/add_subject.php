

<div class="container p-lg-4 ">
<?php 
if($this->session->flashdata('insert_success')){
 echo '
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> New subject created.
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
        <li class="breadcrumb-item active" aria-current="page">Add Subject</li>
    </ol>
    </nav>
    <form class="needs-validation mt-5" novalidate method="post" action="<?php echo base_url();?>hod/add_subject_process">
        
        
        <div class="form-row">
            
            <div class="col-md-3 mb-3">
                <label for="validationCustom04">Course</label>
                <select class="custom-select" id="validationCustom08" required name="course">
            <option selected disabled value="">Choose...</option>
            <?php 

            $id=$_SESSION['u_id'];
            $this->db->select('*');
            $this->db->from('users');
            $this->db->join('hod_data','hod_data.email=users.email');
            $this->db->where('users.email',$id);
            $sql=$this->db->get();
            foreach($sql->result() as $user_data)
            {
            $dept=$user_data->dept;
            }


            $this->db->distinct();
            $this->db->select('course_name');
            $this->db->from('course_list');
            $this->db->where('department',$dept);
            $sql=$this->db->get();
            foreach($sql->result() as $course_data)
            {
            echo "<option value='$course_data->course_name'>$course_data->course_name</option>";
            }
            ?>
            </select>
                <div class="invalid-feedback">
                    Please select a Gradguation.
                </div>
            </div>
            
            <div class="col-md-3 mb-3">
                <label for="validationCustom04">Subject Name</label>
                <input type="text" class="form-control" id="validationCustom01" value="" name="sub_name" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
                <div class="invalid-feedback">
                    Please enter a Subject Name.
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <label for="validationCustom04">Semester</label>
                <input type="number" class="form-control" id="validationCustom03" value="" name="sub_sem" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
                <div class="invalid-feedback">
                    Please enter the semester.
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <label for="validationCustom04">Subject Type</label>
                <select class="custom-select" id="validationCustom04" name="is_lab" required>
                    <option selected disabled value="">Choose...</option>
                    <option value="theory">Theory</option>
                    <option value="lab">Lab</option>
                </select>
                <div class="invalid-feedback">
                    Please select a subject type.
                </div>
            </div>
          </div>
    
            <input class="btn btn-primary" type="submit" name="u_reg" value="Create subject">
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

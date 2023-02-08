<div class="container p-lg-4 ">

    <?php 
if($this->session->flashdata('insert_success')){
 echo '
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> Student semester updated successfully.
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



    <style>

.custom-button:hover
{
  color:white !important;
  background:#DC3545;
  cursor:pointer;
}
</style>


    <link href="<?php echo base_url('assets/bootstrap-table/bootstrap-table.min.css'); ?>" rel="stylesheet">
    <script src="<?php echo base_url('assets/bootstrap-table/jspdf.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/bootstrap-table/jspdf.plugin.autotable.js'); ?>"></script>
    <script src="<?php echo base_url('assets/bootstrap-table/bootstrap-table.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/bootstrap-table/bootstrap-table-export.min.js'); ?>"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous">
    </script>

    <nav aria-label="breadcrumb mt-sm-5">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item">Upgrade Student Semester</li>
        </ol>
    </nav>




    <form class=" mt-5" method="post" action="<?php echo base_url();?>Hod/upgrade_student_process" id="submitmyForm">

        <div class="form-row mt-5">



            <div class="col-md-4 mb-3">
                <label for="validationCustom07">Course</label>

                <select class="custom-select" id="course" required name="course">
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


            $this->db->select('*');
            $this->db->from('course_list');
            $this->db->where('department',$dept);
            $sql=$this->db->get();
            foreach($sql->result() as $user_data)
            {
        
            echo "<option value='$user_data->course_name'>".ucwords($user_data->course_name)."</option>";
            
            }
            ?>
                </select>
                <div class="valid-feedback">
                    Looks good!
                </div>
                <div class="invalid-feedback">
                    Please enter a course.
                </div>
            </div>




            <div class="col-md-4 mb-3">
                <label for="validationCustom05">Semester</label>

                <select class="custom-select" id="semester" required name="semester">
                    <option selected disabled value="">Choose...</option>




                </select>
                <div class="valid-feedback">
                    Looks good!
                </div>
                <div class="invalid-feedback">
                    Please enter a course.
                </div>
            </div>
           


            </form>


        </div>
        <div class="form-row mt-4">
            <button class="btn border-danger ml-1 custom-button text-danger" id="upgrade_button">Upgrade</button>
        </div>


</div>
<script type="text/javascript">
$(document).ready(function() {

    $("#course").change(function() {
        var course = $(this).val();

        $.ajax({
            url: '<?php echo base_url(); ?>/Hod/view_sem_num',
            type: 'post',
            data: {
                post_course: course
            },
            dataType: 'json',
            success: function(response) {

                var len = response.length;

                $("#semester").empty();
                var sem_num = response[0]['sem_num'];
                var j = 1;
                for (var i = 0; i < sem_num; i++) {

                    $("#semester").append("<option value='s" + j + "'>" + j +
                        "</option>");
                    j++;

                }
            }
        });
    });



});
</script>
<script>
$('#upgrade_button').on('click',function(e)
{
const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success m-2',
    cancelButton: 'btn btn-danger m-2'
  },
  buttonsStyling: false
})

swalWithBootstrapButtons.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, upgrade!',
  cancelButtonText: 'No, cancel!',
  reverseButtons: true
}).then((result) => {
  if (result.value) {
    var x = document.forms["submitmyForm"]["course"].value;
    var y = document.forms["submitmyForm"]["semester"].value;

  if (x == "" && y=="") {
    Swal.fire('Please fill out the required fields')
    return false;
  }else
  {
    document.getElementById("submitmyForm").submit();
  }
  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons.fire(
      'Cancelled',
      'The operation is cancelled.',
      'error'
    )
  }
})
})
</script>
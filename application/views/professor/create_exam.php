<div class="container p-lg-4 ">

    <?php 
if($this->session->flashdata('insert_success')){
 echo '
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> New exam created.
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
            <li class="breadcrumb-item"><a href="#">Exams</a></li>
            <li class="breadcrumb-item">Create Exam</li>
        </ol>
    </nav>




    <form class=" mt-5" method="get" action="<?php echo base_url();?>Professor/create_question">

        <div class="form-row mt-5">



            <div class="col-md-4 mb-3">
                <label for="validationCustom07">Course</label>

                <select class="custom-select" id="course" required name="course">
                    <option selected disabled value="">Choose...</option>
                    <?php 

            $id=$_SESSION['u_id'];
            $this->db->select('*');
            $this->db->from('users');
            $this->db->join('professor_data','professor_data.email=users.email');
            $this->db->where('users.email',$id);
            $sql=$this->db->get();
            foreach($sql->result() as $user_data)
            {
             $dept=$user_data->dept;
            }


            $this->db->select('DISTINCT(sub_course)');
            $this->db->from('subject_assigned');
            $this->db->where('teacher_id',$_SESSION['u_id']);
            $sql=$this->db->get();
            foreach($sql->result() as $subject_data)
            {
            echo "<option value='$subject_data->sub_course'>$subject_data->sub_course</option>";
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
                <label for="validationCustom06">Subject</label>

                <select class="custom-select" id="subject" required name="subject">
                    <option selected disabled value="select">Choose...</option>
                    <?php 

            $this->db->select('DISTINCT(subject)');
            $this->db->from('subject_assigned');
            $this->db->where('teacher_id',$_SESSION['u_id']);
            $sql=$this->db->get();
            foreach($sql->result() as $user_data)
            {
            echo "<option value='$user_data->subject'>$user_data->subject</option>";
            }
            ?>
                </select>

            </div>

            <div class="col-md-4 mb-3">
                <label for="validationCustom05">Semester</label>

                <select class="custom-select" id="semester" required name="semester">
                    <option selected disabled value="">Choose...</option>






                </select>

            </div>
            <div class="col-md-4 mb-3">
                <label for="validationCustom01">Number of questions</label>
                <input type="number" class="form-control" required name="question_no">
            </div>

            <div class="col-md-4 mb-3">
                <label for="validationCustom01">Count Down Time</label>
                <input type="time" class="form-control" step="any" name="time" value="00:30:15">
            </div>

            <div class="col-md-4 mb-3">
                <label for="validationCustom01">Last Date and Time</label>
                <input required type="datetime-local" class="form-control" name="last_date"
                    min="<?php echo date("Y-m-d"); ?>T<?php $time=strtotime(date("H:i"));echo date("H:i", strtotime('+15 minutes', $time)); ?>">
            </div>






        </div>
        <div class="form-row mt-4">
            <input class="btn btn-primary ml-1" type="submit" name="u_reg" value="Next">
        </div>

    </form>
</div>
<script type="text/javascript">
$(document).ready(function() {

    $("#subject").change(function() {
        var subject = $(this).val();

        $.ajax({
            url: '<?php echo base_url(); ?>/professor/view_subject_ajax',
            type: 'post',
            data: {
                post_subject: subject
            },
            dataType: 'json',
            success: function(response) {

                var len = response.length;

                $("#semester").empty();
                $("#semester").append(
                    "<option disabled value='select' selected>--Select--</option>");
                for (var i = 0; i < len; i++) {
                    var sem = response[i]['sem'];

                    $("#semester").append("<option value='" + sem + "'>" + sem +
                        "</option>");

                }
            }
        });
    });



});
</script>
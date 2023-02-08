<?php 
if($this->session->flashdata('meeting_over')){
 echo '
<div class="alert alert-warning alert-dismissible fade show mt-2" role="alert">
  <strong>Success!</strong>  The meeting has been ended.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
 
 
?>
 <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3"></div>
        <div class="col-md-3"></div>
 <div class="col-md-3 col-sm-5 mt-5 mb-3 mb-md-0">
            <a href="<?php echo base_url();?>Professor/create_pta_meeting" class=" float-right btn btn-primary col-12 col-md-8" style="cursor:pointer">Start PTA Meeting</a>
            </div>
    <div class="vid-out mt-md-2 col-md-5">
        <video autoplay="true" id="videoElement" class=" col-md-11 mt-md-4 pl-2 pr-2 shadow"></video>
    </div>
    <div class="col-md-7 mt-md-5 pt-0">

        <form action="<?php echo base_url();?>Professor/create_live_meeting" method="post" class="col-12 form-row pl-0">

            <div class="col-md-6 mb-3 p-2">
                <label for="validationCustom05">Course</label>
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
            <div class="col-md-6 mb-3 p-2">
                <label for="validationCustom05">Subject</label>
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

            <div class="col-md-6 mb-3 p-2">
                <label for="validationCustom05">Semester</label>
                <select class="custom-select" id="semester" required name="semester">
                    <option selected disabled value="">Choose...</option>



                   


                </select>
            </div>
           
            <div class="col-md-6 mb-3 p-2 mt-2">
            <label for="validationCustom05"></label>
                <input type="submit" class="form-control btn text-primary border-primary custom-button" id="validationCustom05" name="start" value="Start Meeting">
                
            </div>
           

        </form>



        <!--<?php
   $sql=$this->db->select('meet_status')->from('professor_data')->where('email',$_SESSION['u_id'])->get();
   foreach($sql->result() as $value)
	{
    $status=$value->meet_status;
  }
  if($status==1)
  {
    ?>

    <div class="mt-4">
      <a href="start_meeting" class="btn btn-primary text-light shadow">Rejoin Meeting</a>
      <a href="leave_meeting" class="btn btn-danger text-light shadow">Stop Meeting</a>
    </div>
  <?php 
  }
  else
  {
  ?>

    <div class="mt-4">
      <a href="start_meeting" class="btn btn-primary text-light shadow">Start Meeting</a>
    </div>

  <?php 
   }
  ?>-->


    </div>
</div>


<!-- added live preview with details-->




<script>
var video = document.querySelector("#videoElement");

if (navigator.mediaDevices.getUserMedia) {
    navigator.mediaDevices.getUserMedia({
            video: true
        })
        .then(function(stream) {
            video.srcObject = stream;
        })
        .catch(function(err0r) {
            console.log("Something went wrong!");
        });
}
</script>
<style>
#videoElement {


    height: 250px;
    padding: 0;
    border: 1px solid blue;
    /*
  	background: url("<?php echo base_url("assets/image/video-thumb1.jpg");?>");
    background-size:contain;
    background-repeat:no-repeat;
    */
}

.custom-button:hover
{
  color:white !important;
  background:#007BFF;
  cursor:pointer;
}
</style>
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
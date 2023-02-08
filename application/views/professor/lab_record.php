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


  
<style>
    fieldset {
  border: 0;
  color:#fff0;
  border-radius: 1px;
  
 
}
.hidden{
  opacity:0;
}
.star-cb-group {
  /* remove inline-block whitespace */
  font-size: 0;
  /* flip the order so we can use the + and ~ combinators */
  unicode-bidi: bidi-override;
  direction: rtl;
  margin-left:30px;
  /* the hidden clearer */
}
.star-cb-group * {
  font-size: 2rem;
}
.star-cb-group > input {
  display: none;
}
.star-cb-group > input + label {
  /* only enough room for the star */
  display: inline-block;
  overflow: hidden;
  
  width: 1em;
  white-space: nowrap;
  cursor: pointer;
}
.star-cb-group > input + label:before {
  display: inline-block;
  text-indent: -9999px;
  content: "☆";
  margin-left:-12px;

  color: #888;
}
.star-cb-group > input:checked ~ label:before, .star-cb-group > input + label:hover ~ label:before, .star-cb-group > input + label:hover:before {
  content: "★";
  color: #e52;
  text-shadow: 0 0 1px #333;
  

}
.star-cb-group > .star-cb-clear + label {
  text-indent: -9999px;
  width: 0.5em;
  margin-left: -0.5em;
    


}
.star-cb-group > .star-cb-clear + label:before {
  width: 0.5em;
  
}
.star-cb-group:hover > input + label:before {
  content: "☆";
  color: #888;
  text-shadow: none;
}
.star-cb-group:hover > input + label:hover ~ label:before, .star-cb-group:hover > input + label:hover:before {
  content: "★";
  color: #e52;
  text-shadow: 0 0 1px #333;
  
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
            <li class="breadcrumb-item"><a href="#">Lab Data</a></li>
            <li class="breadcrumb-item active">Record</li>
        </ol>
    </nav>




    <form class=" mt-5" method="post" action="<?php echo base_url();?>Professor/mark_lab_record">

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

            $this->db->select('DISTINCT(subject),is_lab');
            $this->db->from('subject_assigned');
            $this->db->join('subjects','subjects.sub_name=subject_assigned.subject');
            $this->db->where('teacher_id',$_SESSION['u_id']);
            $sql=$this->db->get();
            foreach($sql->result() as $user_data)
            {
                if($user_data->is_lab=='lab')
                {
                     echo "<option value='$user_data->subject'>$user_data->subject</option>";
                }
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

            <div class=" col-12 p-0 mt-5 ">
                <div class="col-12 col-md-12 p-0">


                    <table id="table" data-toolbar="#toolbar" data-search="false" data-sortable="false"
                        data-show-columns="false" data-toggle="table" data-pagination="false" class="table"
                        data-visible-search="false">
                        <thead class="table-primary">

                            <tr>
                                <th data-field="no." data-sortable="true">no.</th>
                                <th data-field="name" data-sortable="true">Name</th>

                                <th data-field="edit">Action</th>
                            </tr>

                        </thead>
                        <tbody id="table_body">
                        </tbody>
                    </table>



                </div>
            </div>
        </div>
        <div class="form-row mt-4">
            <input class="btn btn-primary ml-1" type="submit" name="u_reg" value="Submit">
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

    $("#semester").change(function() {
        var semester = $(this).val();
        var course = $('#course').val();

        $.ajax({
            url: '<?php echo base_url(); ?>/Professor/view_students_ajax',
            type: 'post',
            data: {
                post_semester: semester,
                post_course: course
            },
            dataType: 'json',
            success: function(response) {

                var len = response.length;
                var j = 1;
                $("#table_body").empty();

                for (var i = 0; i < len; i++) {
                    var name = response[i]['name'];
                    var s_id = response[i]['s_id'];

                    $("#table_body").append("<tr><td>" + j + "</td><td>" + name +
                        "</td><td class=' p-0' ><input type='hidden' name='limit' value='" +
                        j + "'><input type='hidden' name='sid" + j + "' value='" +
                        s_id + "'> <fieldset>  <span class='star-cb-group'><input required type='radio' id='rating-5"+j+"' name='rating"+j+"' value='5' /><label for='rating-5"+j+"'>5</label><input required type='radio' id='rating-4"+j+"' name='rating"+j+"' value='4'  /><label for='rating-4"+j+"'>4</label><input required type='radio' id='rating-3"+j+"' name='rating"+j+"' value='3' /><label for='rating-3"+j+"'>3</label><input required type='radio' id='rating-2"+j+"' name='rating"+j+"' value='2' /><label for='rating-2"+j+"'>2</label><input required type='radio' id='rating-1"+j+"' name='rating"+j+"' value='1' /><label for='rating-1"+j+"'>1</label><input required type='radio' id='rating-0"+j+"' name='rating"+j+"' value='0' class='star-cb-clear' /><label for='rating-0"+j+"' class='hidden'>0</label></span></fieldset></td></tr>");
                    j++;

                }


            }
        });
    });

});
</script>






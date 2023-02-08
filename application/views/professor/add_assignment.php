<div class="container p-lg-4 ">

<?php
defined('BASEPATH') or exit('No direct script access allowed');
if(!isset($_SESSION['u_id']))
{
  redirect('Home/login','refresh');
}
if($this->session->flashdata('add_topic')){
    echo '
   <div class="alert alert-success alert-dismissible fade show" role="alert">
     <strong>Success!</strong> New Assignment Added.
     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
       <span aria-hidden="true">&times;</span>
     </button>
   </div>';
   }
?>

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
            <li class="breadcrumb-item">Assignments</li>
            <li class="breadcrumb-item active" aria-current="page">Add Assignment</li>
        </ol>
    </nav>

    <form class=" mt-5" method="post" action="<?php echo base_url();?>Professor/add_assignment_data">

<div class="form-row mt-5">



    <div class="col-md-6 mb-3">
        <label for="validationCustom07">Course</label>

        <select class="custom-select" id="course" required name="course">
            <option selected disabled value="">Choose...</option>
            <?php
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


    <div class="col-md-6 mb-3">
        <label for="validationCustom05">Semester</label>

        <select class="custom-select" id="semester" required name="semester">
            <option selected disabled value="">Choose...</option>






        </select>

    </div>

    <div class="col-md-6 mb-3">
        <label for="validationCustom05">Subjects</label>

        <select class="custom-select" id="subject" required name="subject">
            <option selected disabled value="">Choose...</option>



        </select>

    </div>


    <div class="col-md-6 mb-3">
                <label for="validationCustom05">Submission Date</label>
                <input type="date" class="form-control" id="validationCustom05" name="last_date" required>
                <div class="invalid-feedback">
                    Please provide a valid Date.
                </div>
            </div>


            <div class="col-md-12 mt-3">
                <div class="form-floating">
                <label for="validationCustom02">Assignment Topic</label>
                    <textarea class="form-control" name="as_topic" id="validationCustom02" placeholder="Assignment Topic" style="height: 100px" required></textarea>    
                    <div class="invalid-feedback">
                    Please Leave the Topic.
                </div>
                </div>



</div>
<div class="form-row mt-4">
    <input class="btn btn-primary ml-1" type="submit" name="add_assign_btn" value="Submit">
</div>

</form>


<div class="container mt-5">
    <table id="table" data-toolbar="#toolbar" data-search="false" data-sortable="false"
                        data-show-columns="false" data-toggle="table" data-pagination="false" class="table"
                        data-visible-search="false">
                        <thead class="table-primary">

                            <tr class="text-center">
                                <th data-field="sl.no" data-sortable="true">Sl.No</th>
                                <th data-field="department" data-sortable="true">Department</th>
                                <th data-field="semester" data-sortable="true">Semester</th>
                                <th data-field="subject" data-sortable="true">Subject</th>
                                <th data-field="topic" data-sortable="true">Topic</th>
                                <th data-field="last_date" data-sortable="true">Submission_date</th>
                            </tr>

                        </thead>
	<tbody>
	<?php 
    $this->db->select('*');
    $this->db->from('assignment_topic');
    $this->db->where('as_by',$_SESSION['u_id']);
    $sql=$this->db->get();
    $sl_no=1;
	foreach($sql->result() as $assignment_data)
	{
    ?>
		<tr class="text-center">
            <td><?php echo $sl_no; $sl_no++;?></td>
			<td><?php echo $assignment_data->course ?></td>
			<td><?php echo $assignment_data->semester ?></td>
            <td><?php echo $assignment_data->subject ?></td>
            <td><?php echo $assignment_data->as_topic ?></td>
			<td><?php echo date('d-m-Y',strtotime($assignment_data->last_date)) ?></td>
	  	</tr>
	<?php		
	}
	?>
	</tbody>
    </table>
    </div>



</div>    


<script type="text/javascript">
$(document).ready(function() {

    $("#course").change(function() {
        var course = $(this).val();

        $.ajax({
            url: '<?php echo base_url(); ?>/professor/view_sem_num',
            type: 'post',
            data: {
                post_course: course
            },
            dataType: 'json',
            success: function(response) {

                var len = response.length;
                var j = 1;
                $("#semester").empty();
                $("#semester").append(
                    "<option disabled value='select' selected>--Select--</option>");
                
                for (var i = 0; i < len; i++) {
                    var sem = response[i]['sem'];
                    $("#semester").append("<option value='" + sem + "'>" + sem +
                        "</option>");
                    j++;
                }
            }
        });
    });

    $("#semester").change(function() {
        var semester = $(this).val();
        var course = $('#course').val();

        $.ajax({
            url: '<?php echo base_url(); ?>/professor/view_assign_subject_ajax',
            type: 'post',
            data: {
                post_semester: semester,
                post_course: course
            },
            dataType: 'json',
            success: function(response) {

                var len = response.length;
                var j = 1;
                $("#subject").empty();
                $("#subject").append(
                    "<option disabled value='select' selected>--Select--</option>");
                for (var i = 0; i < len; i++) {
                    var subject = response[i]['subject'];

                    $("#subject").append("<option value='" + subject + "'>" + subject +
                        "</option>");
                    j++;

                }


            }
        });
    });

    
});
</script>

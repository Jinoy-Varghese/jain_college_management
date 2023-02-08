<div class="container p-lg-4 ">
<?php
defined('BASEPATH') or exit('No direct script access allowed');
if(!isset($_SESSION['u_id']))
{
  redirect('Home/login','refresh');
}
if($this->session->flashdata('add_assign')){
    echo '
   <div class="alert alert-success alert-dismissible fade show" role="alert">
     <strong>Success!</strong> Assignment Uploaded successfully.
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


<div class="container" class="col-md-12"><br>

    <nav aria-label="breadcrumb mt-sm-5">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Assignments</a></li>
            <li class="breadcrumb-item active" aria-current="page">View Assignment</li>
        </ol>
    </nav>

    <div class="container">

        <div class="row">

        <div class="col-md-6 mb-3">
                <label for="validationCustom06">Subject</label>

                <select class="custom-select" id="subject" required name="subject">
                    <option selected disabled value="select">Choose...</option>
                    <?php
                      $this->db->select('*');
                      $this->db->from('subject_assigned');
                      $this->db->where('teacher_id',$_SESSION['u_id']);
                      $sql=$this->db->get();
                      foreach($sql->result() as $subject)
                        {
                        echo "<option value='$subject->subject'>$subject->subject</option>";
                        }
                    ?>
                </select>

            </div>

            <div class="col-md-6 mb-3">
                <label for="validationCustom05">Semester</label>

                <select class="custom-select" id="semester" required name="semester">
                    <option selected disabled value="">Choose...</option>

                </select>

            </div>

        </div>

    </div>


    <table id="table" data-toolbar="#toolbar" data-search="false" data-sortable="false"
                        data-show-columns="false" data-toggle="table" data-pagination="false" class="table"
                        data-visible-search="false">
                        <thead class="table-primary">

                            <tr>
                                <th data-field="no." data-sortable="true">no.</th>
                                <th data-field="submitted_by" data-sortable="true">Submitted By</th>
                                <th data-field="topic">Topic</th>
                                <th data-field="date">Submitted Date</th>
                                <th data-field="file">Assignment File</th>
                            </tr>

                        </thead>
                        <tbody id="table_body">
                        </tbody>
                    </table>
    

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
        var subject = $('#subject').val();

        $.ajax({
            url: '<?php echo base_url(); ?>/Professor/view_assignment_ajax',
            type: 'post',
            data: {
                post_semester: semester,
                post_subject: subject
            },
            dataType: 'json',
            success: function(response) {

                var len = response.length;
                var j = 1;
                $("#table_body").empty();

                for (var i = 0; i < len; i++) {
                    var name = response[i]['name'];
                    var assign_subject = response[i]['assign_subject'];
                    var assign_topic = response[i]['assign_topic'];
                    var assign_date = response[i]['assign_date'];
                    var assign_file = response[i]['assign_file'];
                    
                    
                    $("#table_body").append("<tr><td>" + j + "</td><td>" + name +
                        "</td><td>" + assign_topic + "</td><td>" + assign_date + "</td><td class='text-center'><a href=" + assign_file + " class='btn btn-primary text-light' download>Download</a></td>");
                    j++;

                }


            }
        });
    });

});
</script>
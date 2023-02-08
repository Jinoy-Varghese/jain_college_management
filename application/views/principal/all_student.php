<div class="container p-lg-4 ">

    <?php 
if($this->session->flashdata('insert_success')){
 echo '
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> Fees updated successfully.
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
    .detail-view {
        animation: animate 0.3s linear 1;
    }

    @keyframes animate {
        0% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }
    }

    .b {
        display: inline-block;
        width: 114px;
    }

    .colan {
        display: inline-block;
        width: 15px;
    }

    .custom-button {

        color: #007BFF;
        text-decoration: none;

    }

    .custom-button:hover {
        color: white;
        background: #007BFF;
        cursor: pointer;
    }
    </style>


    <link href="<?php echo base_url('assets/bootstrap-table/bootstrap-table.min.css'); ?>" rel="stylesheet">

    <script src="<?php echo base_url('assets/bootstrap-table/tableExport.min.js'); ?>"></script>
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
            <li class="breadcrumb-item"><a href="#">View Users</a></li>
            <li class="breadcrumb-item">All Students </li>
        </ol>
    </nav>




    <form class=" mt-5" method="post" action="<?php echo base_url();?>office/offline_fees_process">

        <div class="form-row mt-5">



            <div class="col-md-4 mb-3">
                <label for="validationCustom07">Gradguation</label>

                <select class="custom-select" id="gradguation" required name="gradguation">
                    <option selected disabled value="">Choose...</option>
                    <?php 

            $id=$_SESSION['u_id'];
            $this->db->select('*');
            $this->db->from('course_list');
            $sql=$this->db->get();
            foreach($sql->result() as $user_data)
            {
        
            echo "<option value='$user_data->gradguation'>$user_data->gradguation</option>";
            
            }
            ?>
                </select>
                <div class="valid-feedback">
                    Looks good!
                </div>

            </div>




            <div class="col-md-4 mb-3">
                <label for="validationCustom05">Department</label>

                <select class="custom-select" id="department" required name="department">
                    <option selected disabled value="">Choose...</option>




                </select>
                <div class="valid-feedback">
                    Looks good!
                </div>

            </div>
            <div class="col-md-4 mb-3">
                <label for="validationCustom05">course</label>

                <select class="custom-select" id="course" required name="course">
                    <option selected disabled value="">Choose...</option>




                </select>
                <div class="valid-feedback">
                    Looks good!
                </div>

            </div>


            <div class=" col-12 p-0 mt-5 ">
                <div class="col-12 col-md-12 p-0">


                    <table id="table" data-show-export="false" data-toolbar="#toolbar" data-search="false"
                        data-sortable="false" data-show-columns="false" data-toggle="table" data-pagination="false"
                        class="table" data-visible-search="false" data-detail-formatter="detailFormatter"
                        data-detail-view="false">
                        <thead class="table-primary">

                            <tr>
                                <th data-field="#" data-sortable="false">#</th>
                                <th data-field="name" data-sortable="false">Name</th>
                                <th data-field="email" data-sortable="false">E-Mail</th>




                            </tr>

                        </thead>
                        <tbody id="table_body">
                        </tbody>
                    </table>




                </div>
            </div>
        </div>


    </form>
</div>
<script type="text/javascript">
$(document).ready(function() {

    $("#gradguation").change(function() {
        var gradguation = $(this).val();

        $.ajax({
            url: '<?php echo base_url(); ?>/principal/view_sem_num',
            type: 'post',
            data: {
                post_gradguation: gradguation
            },
            dataType: 'json',
            success: function(response) {

                var len = response.length;

                $("#department").empty();
                $("#department").append(
                    "<option disabled value='select' selected>--Select--</option>");


                for (var i = 0; i < len; i++) {
                    var dep = response[i]['department'];

                    $("#department").append("<option value='" + dep + "'>" + dep +
                        "</option>");

                }
            }
        });
    });


    $("#department").change(function() {
        var department = $(this).val();
        var gradguation = $('#gradguation').val();

        $.ajax({
            url: '<?php echo base_url(); ?>/principal/view_course',
            type: 'post',
            data: {
                post_department: department,
                post_gradguation: gradguation
            },
            dataType: 'json',
            success: function(response) {

                var len = response.length;
                var j = 1;
                $("#course").empty();
                $("#course").append(
                    "<option disabled value='select' selected>--Select--</option>");
                for (var i = 0; i < len; i++) {
                    var course = response[i]['course_name'];


                    $("#course").append("<option value='" + course + "'>" + course +
                        "</option>");
                    j++;

                }


            }
        });
    });

    $("#course").change(function() {
        var course = $(this).val();
        var gradguation = $('#gradguation').val();
        var department = $('#department').val();


        $.ajax({
            url: '<?php echo base_url(); ?>/principal/view_students_ajax',
            type: 'post',
            data: {
                post_department: department,

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
                        "</td><td>" + s_id +
                        "</td><td class=' p-0' ><input type='hidden' name='limit' value='" +
                        j + "'><input type='hidden' name='sid" + j + "' value='" +
                        s_id + "'> </tr></td>");
                    j++;

                }


            }

        });
    });
});
</script>
<script>
var $table = $('#table')

$(function() {
    $('#toolbar').find('select').change(function() {
        $table.bootstrapTable('destroy').bootstrapTable({
            exportDataType: $(this).val(),
            exportTypes: ['json', 'xml', 'csv', 'txt', 'sql', 'excel', 'pdf'],
            columns: [{
                field: 'state',
                checkbox: true,
                visible: $(this).val() === 'selected'
            }]
        })
    }).trigger('change')
})
</script>
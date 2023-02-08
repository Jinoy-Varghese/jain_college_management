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

<style>
.file_border {
    height: 45vh;
    border: 2px solid #3c3c3c;
    position: relative;
}

.file_1 {
    margin: 0;
    position: absolute;
    top: 55%;
    left: 50%;
    transform: translate(-50%, -50%);
}
</style>

<div class="container" class="col-md-12"><br>

    <nav aria-label="breadcrumb mt-sm-5">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Assignment</li>
        </ol>
    </nav>


    <div class="container mt-5">
        <table id="table" data-toolbar="#toolbar" data-search="false" data-sortable="false" data-show-columns="false"
            data-toggle="table" data-pagination="false" class="table" data-visible-search="false">
            <thead class="table-primary">

                <tr class="text-center">
                    <th data-field="sl.no" data-sortable="true">Sl.No</th>
                    <th data-field="subject" data-sortable="true">Subject</th>
                    <th data-field="topic" data-sortable="true">topic</th>
                    <th data-field="last_date" data-sortable="true">Submission_date</th>
                    <th data-field="action" data-sortable="true">Upload</th>
                    <th data-field="view" data-sortable="true">Status</th>
                </tr>

            </thead>
            <tbody>
                <?php
    $this->db->select('s_sem');
    $this->db->from('student_data');
    $this->db->where('email',$_SESSION['u_id']);
    $sql=$this->db->get();
    foreach($sql->result() as $user_data)
	{
        $login_id=$user_data->s_sem;
    }
    
    $this->db->select('*');
    $this->db->from('assignment_topic');
    $this->db->where('semester',$login_id);
    $sql=$this->db->get();
    $sl_no=1;
	foreach($sql->result() as $assignment_data)
	{
    ?>
                <tr class="text-center">
                    <td><?php echo $sl_no; $sl_no++;?></td>
                    <td><?php echo $assignment_data->subject ?></td>
                    <td><?php echo $assignment_data->as_topic ?></td>
                    <td><?php echo date('d-m-Y',strtotime($assignment_data->last_date)) ?></td>
                    <td><button type='button' class='btn btn-primary' data-toggle='modal'
                            data-target='#exampleModalCenter<?php echo $assignment_data->as_id;?>'>Upload File</button>
                            </td>
                    <td>
                    <?php
                        $this->db->select('*');
                        $this->db->from('assignment_submit');
                        $this->db->where('assign_by',$_SESSION['u_id']);
                        $this->db->where('assign_topic',$assignment_data->as_topic);
                        $sql=$this->db->get();
                        foreach($sql->result() as $view_ass)
                        {
                            if($view_ass->assign_file!==null)
                            {
                                echo "<div class='text-success font-weight-bold'>File Uploaded</div>";
                            }
                        }
                        ?>
                    </td>
                </tr>


  
                    <div class="modal fade bd-example-modal-lg"
                        id="exampleModalCenter<?php echo $assignment_data->as_id;?>" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        

                        <form class="needs-validation mt-5" novalidate method="post"
                    action="<?php echo base_url()?>Student/upload_assignment/<?php echo $assignment_data->as_id;?>" enctype="multipart/form-data">


                        
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Details</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                
                                <div class="modal-body">

                                    <input type="hidden" name="assign_id" value="<?php echo $assignment_data->as_id;?>"
                                        disabled style="background:none; border:none;">

                                    <div class="form-row mt-5 ml-5">
                                        <div class="col-md-3 col-12 mt-4 file_border">

                                            <div class="col-12 text-center file_1"><i class="fas fa-cloud-upload-alt"
                                                    style="font-size:50px;"></i>
                                                <p>Upload the File Here</p><br>
                                                <label for="upload_file_id" class="btn btn-primary mt-n5">Choose
                                                    File</label>
                                                <input type="file" class="custom-file-input" name="u_file"
                                                    id="upload_file_id">
                                            </div>

                                        </div>

                                        <div class="col-md-8 mb-3 ml-5">
                                            <label for="validationCustom04">Subject</label>
                                            <input type="text" class="form-control" name="subject"
                                                value="<?php echo $assignment_data->subject;?>" readonly>

                                            <div class="col-md-14 mt-3">
                                                <label for="validationCustom05">Submitted To</label>
                                                <?php
                                                $this->db->select('*');
                                                $this->db->from('users');
                                                $this->db->where('email',$assignment_data->as_by);
                                                $sql=$this->db->get();
                                                foreach($sql->result() as $name)
                                                {
                                                echo "<input type='text' class='form-control' name='tr_id' value='".$name->name."'readonly>";
                                                }
                                                ?>
                                            </div>

                                            <div class="col-md-14 mt-3">
                                                <div class="form-floating">
                                                    <label for="validationCustom02">Topic</label>
                                                    <input type="text" class="form-control" name="assign_topic"
                                                        id="assign_topic"
                                                        value="<?php echo $assignment_data->as_topic;?>" readonly>

                                                </div>
                                            </div>

                                            <div class="col-md-14 mt-3">
                                                <div class="form-floating">
                                                    <label for="validationCustom02">Submission Date</label>
                                                    <input type="text" class="form-control" name="assign_date"
                                                        id="assign_date"
                                                        value="<?php echo date('d-m-Y',strtotime($assignment_data->last_date));?>"
                                                        disabled>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <input type="button" class="btn btn-secondary" data-dismiss="modal" value="Close">
                                    <input type="submit" name="assign_btn" class="btn btn-primary" value="Upload File">

                                </div>
                            </div>
                        </div>
                    </div>

                </form>
                <?php		
	}
	?>
            </tbody>
        </table>
    </div>
    </div>
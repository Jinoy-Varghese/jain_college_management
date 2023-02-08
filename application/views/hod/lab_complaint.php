    <?php
defined('BASEPATH') or exit('No direct script access allowed');
if(!isset($_SESSION['u_id']))
{
  redirect('Home/login','refresh');
}
?>
<link href="<?php echo base_url('assets/bootstrap-table/bootstrap-table.min.css'); ?>" rel="stylesheet">

<script src="<?php echo base_url('assets/bootstrap-table/tableExport.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/bootstrap-table/jspdf.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/bootstrap-table/jspdf.plugin.autotable.js'); ?>"></script>
<script src="<?php echo base_url('assets/bootstrap-table/bootstrap-table.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/bootstrap-table/bootstrap-table-export.min.js'); ?>"></script>


<div class="container p-lg-4 ">
    <?php 
if($this->session->flashdata('registered_success')){
 echo '
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> New Complaint Registered.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
if($this->session->flashdata('registration_failed')){
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
            <li class="breadcrumb-item"><a href="#">Report Complaints</a></li>
            <li class="breadcrumb-item active" aria-current="page">Register Complaint</li>
        </ol>
    </nav>
    <form class="needs-validation mt-5" novalidate method="post"
        action="<?php echo base_url();?>Hod/lab_complaint_data">
        <div class="form-row">
        <div class="col-md-3"></div>
            <div class="col-md-12 col-12 mb-3">
                <label for="validationCustom01">System No/Device</label>
                <input type="text" class="form-control" id="validationCustom01" name="sym_no" required>
                <div class="invalid-feedback">
                    Please provide a System No/Device No.
                </div>
            </div>
            </div>
            <div class="form-row">
            <div class="col-md-3"></div>
            <div class="col-md-12 mb-3">
                <div class="form-floating">
                <label for="validationCustom02">Complaint</label>
                    <textarea class="form-control" name="complaint" id="validationCustom02" placeholder="Leave a Complaint here" style="height: 100px" required></textarea>    
                    <div class="invalid-feedback">
                    Please Leave the complaint.
                </div>
                </div>
            </div>
        
        </div>
        <input class="btn btn-primary" type="submit" name="complaint_reg" value="Register Complaint">
    </form>

<div class="container mt-5">
    <table id="table" data-toolbar="#toolbar" data-search="false" data-sortable="false"
                        data-show-columns="false" data-toggle="table" data-pagination="false" class="table"
                        data-visible-search="false">
                        <thead class="table-primary">

                            <tr class="text-center">
                                <th data-field="sl.no" data-sortable="true">Sl.No</th>
                                <th data-field="name" data-sortable="true">System No</th>
                                <th data-field="no." data-sortable="true">Complaint</th>
                                <th data-field="edit">Status</th>
                            </tr>

                        </thead>
	<tbody>
	<?php 
    $this->db->select('*');
    $this->db->from('lab_complaints');
    $this->db->where('register_by',$_SESSION['u_id']);
    $sql=$this->db->get();
    $sl_no=1;
	foreach($sql->result() as $complaints_data)
	{
    ?>
		<tr class="text-center">
            <td><?php echo $sl_no; $sl_no++;?></td>
			<td><?php echo $complaints_data->sym_no ?></td>
			<td><?php echo $complaints_data->complaint ?></td>
            <td>
            <?php
            if($complaints_data->status==1)
            {
                echo "<b style='color:red;'>Not Fixed</b>";
            }
            else
            {
                echo "<b style='color:green;'>Fixed</b>";
            }  
            ?>
            </td>
	  	</tr>
	<?php		
	}
	?>
	</tbody>
    </table>
    </div>
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
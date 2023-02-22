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

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>

<div class="container p-lg-4 ">
    <?php 
if($this->session->flashdata('update_success')){
 echo '
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> Successfully Updated.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
if($this->session->flashdata('update_failed')){
    echo '
   <div class="alert alert-danger alert-dismissible fade show" role="alert">
     <strong>Failed!</strong> Something Wend wrong, please try again.
     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
       <span aria-hidden="true">&times;</span>
     </button>
   </div>';
   }
   if(isset($_SESSION['update_failed'])){
    unset($_SESSION['update_failed']);
}
if(isset($_SESSION['update_success'])){
    unset($_SESSION['update_success']);
}
?>
    <nav aria-label="breadcrumb mt-sm-5">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">View Applicants</a></li>
            <li class="breadcrumb-item active" aria-current="page">View Applications</li>
        </ol>
    </nav>

    <div id="toolbar">
			<select class="form-control">
				<option value="all">Export All</option>
				<option value="selected">Export Selected</option>
			</select>
		</div>

    <table class="text-center" id="table" data-toolbar="#toolbar" data-show-export="true" data-search="true" data-sortable="true"
                        data-show-columns="true" data-toggle="table" data-pagination="true" class="table"
                        data-visible-search="true">
        <thead class="table-primary">

            <tr>
                <th data-field="state" data-checkbox="true"></th>
                <th data-field="Application No." data-sortable="true">Application No.</th>
                <th data-field="Name" data-sortable="true">Name</th>
                <th data-field="Email" data-sortable="true">Email</th>
                <th data-field="Phone No." data-sortable="true" data-visible="false">Phone No.</th>
                <th data-field="Gender" data-sortable="true" data-visible="false">Gender</th>
                <th data-field="Department" data-sortable="true" data-visible="false">Department</th>
                <th data-field="Semester" data-sortable="true" data-visible="false">Semester</th>
                <th data-field="Course" data-sortable="true" data-visible="false">Course</th>
                <th data-field="SSLC" data-sortable="true" data-visible="false">SSLC</th>
                <th data-field="Plus Two" data-sortable="true" data-visible="false">Plus Two</th>
                <th data-field="edit">Action</th>
            </tr>

        </thead>
        <tbody>
    	<?php 
      $this->db->select('*');
      $this->db->from('offer_application');
      $this->db->join('student_data','student_data.email=offer_application.student_id');
      $this->db->join('offers',"offer_application.job_id=offers.job_id");
      $this->db->join('users','users.email=student_data.email');
      $this->db->where('status','0');
      $sql=$this->db->get();
	    foreach($sql->result() as $offer_data)
	    {
    	?>
    	<tr>
        <td class="bs-checkbox"><input data-index="<?php echo $offer_data->application_id; ?>" name="btSelectItem" type="checkbox"></td>
        <td><?php echo $offer_data->application_id; ?></td>
        <td><?php echo $offer_data->name; ?></td>
        <td><?php echo $offer_data->email; ?></td>
        <td><?php echo $offer_data->phone; ?></td>
        <td><?php echo $offer_data->gender; ?></td>
        <td><?php echo $offer_data->dept; ?></td>
        <td><?php echo $offer_data->s_sem; ?></td>
        <td><?php echo $offer_data->s_course; ?></td>
        <td><?php echo $offer_data->u_sslc; ?></td>
        <td><?php echo $offer_data->u_plustwo; ?></td>

	    <td>
            
            <a href="<?php echo base_url()?>Placement_cell/application_status?application_id=<?php echo $offer_data->application_id;?>&status=1&job_id=<?php echo $this->uri->segment(3); ?>"><input type="submit" name="complaint_btn" class="btn btn-success mt-1" value="Offered"></a>
            <a href="<?php echo base_url()?>Placement_cell/application_status?application_id=<?php echo $offer_data->application_id;?>&status=2&job_id=<?php echo $this->uri->segment(3); ?>"><input type="submit" name="complaint_btn" class="btn btn-danger mt-1" value="Rejected"></a>

        </td>
    	</tr> 
      <form class="needs-validation mt-5" novalidate method="post" action="<?php echo base_url();?>Lab_assistant/update_complaint_data">

      <div id="myModal<?php echo $offer_data->job_id ?>" class="modal fade" role="dialog">
			<div class="modal-dialog modal-dialog-centered">
			    <div class="modal-content">
					<div class="modal-header">
             <h4 class="modal-title">Details</h4>
						 <button type="button" class="close" data-dismiss="modal">&times;</button>
				    </div>
        <div class="modal-body">
            <b>Offer Id : </b><input type="text" name="job_id" id="job_id" value="<?php echo $offer_data->job_id;?>" disabled style="background:none; border:none;"><br>
            <b>Logo : </b><img src="<?php echo base_url($offer_data->c_logo); ?>" width="auto" height="40px"><br>
            <b>Company Name : </b><input type="text" name="c_name" id="c_name" value="<?php echo $offer_data->c_name;?>" disabled style="background:none; border:none;"><br>
            <b>Job Post : </b><input type="text" name="job_post" id="job_post" value="<?php echo $offer_data->job_post;?>" disabled style="background:none; border:none;"><br>
            <b>Job Location : </b><input type="text" name="job_location" id="job_location" value="<?php echo $offer_data->job_location;?>" disabled style="background:none; border:none;"><br>
            <b>Job Salary : </b><input type="text" name="job_salary" id="job_salary" value="<?php echo $offer_data->job_salary;?>" disabled style="background:none; border:none;"><br>
            <b>Job Description : </b><input type="text" name="job_description" id="job_description" value="<?php echo $offer_data->job_description;?>" disabled style="background:none; border:none;"><br>
            <b>Job Eligibility : </b><input type="text" name="job_eligibility" id="job_eligibility" value="<?php echo $offer_data->job_eligibility;?>" disabled style="background:none; border:none;"><br>
            <b>About Company : </b><input type="text" name="about_company" id="about_company" value="<?php echo $offer_data->about_company;?>" disabled style="background:none; border:none;"><br>
            <b>Last Date : </b><input type="text" name="last_date" id="last_date" value="<?php echo date('d-m-Y',strtotime($offer_data->last_date));?>" disabled style="background:none; border:none;"><br>


            <div class="modal-footer">
              <input type="button" class="btn btn-secondary" data-dismiss="modal" value="Close">
              <a href="<?php echo base_url()?>Placement_cell/applicants_page/<?php echo $offer_data->job_id;?>"><input type="submit" name="complaint_btn" class="btn btn-primary" value="Offered"></a>
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

    <script>
  
  var $table = $('#table')
  
    $(function() {
      $('#toolbar').find('select').change(function () {
        $table.bootstrapTable('destroy').bootstrapTable({
          exportDataType: $(this).val(),
          exportTypes: ['json', 'xml', 'csv', 'txt', 'sql', 'excel', 'pdf'],
          columns: [
            {
              field: 'state',
              checkbox: true,
              visible: $(this).val() === 'selected'
            }
          ]
        })  
      }).trigger('change')
    })
    
  </script>
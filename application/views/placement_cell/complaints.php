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
  <strong>Success!</strong> Complaint Fixed Successfully.
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
?>
    <nav aria-label="breadcrumb mt-sm-5">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Complaints</a></li>
            <li class="breadcrumb-item active" aria-current="page">View Complaint</li>
        </ol>
    </nav>

    <div id="toolbar">
			<select class="form-control">
				<option value="all">Export All</option>
				<option value="selected">Export Selected</option>
			</select>
		</div>

    <table class="text-center" id="table" data-toolbar="#toolbar" data-show-export="true" data-search="false" data-sortable="true"
                        data-show-columns="true" data-toggle="table" data-pagination="true" class="table"
                        data-visible-search="true">
                        <thead class="table-primary">

                            <tr>
                                <th data-field="state" data-checkbox="true"></th>
                                <th data-field="sl.no" data-sortable="true">Complaint No</th>
                                <th data-field="name" data-sortable="true">System No</th>
                                <th data-field="complaint" data-sortable="true">Complaint</th>
                                <th data-field="register_by" data-sortable="true" data-visible="false">Registered By</th>
                                <th data-field="registered_on" data-sortable="true" data-visible="false">Registered On</th>
                                <th data-field="fixed_on" data-sortable="true" data-visible="false">Fixed On</th>
                                <th data-field="edit">Status</th>
                            </tr>

                        </thead>
                        <tbody>
    	<?php 
      $this->db->select('*');
      $this->db->from('lab_complaints');
      $sql=$this->db->get();
	    foreach($sql->result() as $complaints_data)
	    {
    	?>
    	<tr>
        <td class="bs-checkbox"><input data-index="<?php echo $complaints_data->complaint_id; ?>" name="btSelectItem" type="checkbox"></td>
        <td><input disabled value="<?php echo $complaints_data->complaint_id; ?>" id="com_id" style="border:0;background:none;color:black; text-align:center;"></td>
	    	<td><?php echo $complaints_data->sym_no; ?></td>
	    	<td><?php echo $complaints_data->complaint; ?></td>
        <td><?php echo $complaints_data->register_by; ?></td>
	    	<td><?php echo date('d-m-Y',strtotime($complaints_data->registered_on)); ?></td>
        <td><?php echo $complaints_data->fixed_on; ?></td>
	    	<td>
        <?php
        if($complaints_data->status==1)
        {
          echo "<button type='button' class='btn btn-danger' data-toggle='modal' data-target='#myModal$complaints_data->complaint_id'>Fix This</button>";
        }
        else
        {
          echo "<b class='text-success'>Fixed</b>";
        }
        ?>
        </td>
    	</tr> 
      <form class="needs-validation mt-5" novalidate method="post" action="<?php echo base_url();?>Lab_assistant/update_complaint_data">

      <div id="myModal<?php echo $complaints_data->complaint_id ?>" class="modal fade" role="dialog">
			<div class="modal-dialog modal-dialog-centered">
			    <div class="modal-content">
					<div class="modal-header">
             <h4 class="modal-title">Details</h4>
						 <button type="button" class="close" data-dismiss="modal">&times;</button>
				    </div>
            <div class="modal-body">
            <b>Complaint No : </b><input type="text" name="complaint_id" id="complaint_id" value="<?php echo $complaints_data->complaint_id;?>" disabled style="background:none; border:none;"><br>
            <b>System No : </b><input type="text" name="sym_no" id="sym_no" value="<?php echo $complaints_data->sym_no;?>" disabled style="background:none; border:none;"><br>
            <b>Complaint : </b><input type="text" name="complaint" id="complaint" value="<?php echo $complaints_data->complaint;?>" disabled style="background:none; border:none;"><br>
            <b>Registered By : </b><input type="text" name="register_by" id="register_by" value="<?php echo $complaints_data->register_by;?>" disabled style="background:none; border:none;"><br>
            <b>Registered On : </b><input type="text" name="registered_on" id="registered_on" value="<?php echo date('d-m-Y',strtotime($complaints_data->registered_on));?>" disabled style="background:none; border:none;"><br>
            <div class="modal-footer">
              <input type="button" class="btn btn-secondary" data-dismiss="modal" value="Close">
              <a href="<?php echo base_url()?>Lab_assistant/update_complaint_data/<?php echo $complaints_data->complaint_id;?>"><input type="submit" name="complaint_btn" class="btn btn-success" value="Mark As Fixed"></a>
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
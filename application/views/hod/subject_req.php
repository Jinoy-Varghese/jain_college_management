

<div class="container p-lg-4 ">
<?php 
if($this->session->flashdata('insert_success')){
 echo '
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> Request sucessfully verified.
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
    <nav aria-label="breadcrumb mt-sm-5">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Requests for Porfessors</li>
    </ol>
    </nav>
    


<link href="<?php echo base_url('assets/bootstrap-table/bootstrap-table.min.css'); ?>" rel="stylesheet">

<script src="<?php echo base_url('assets/bootstrap-table/tableExport.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/bootstrap-table/jspdf.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/bootstrap-table/jspdf.plugin.autotable.js'); ?>"></script>
<script src="<?php echo base_url('assets/bootstrap-table/bootstrap-table.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/bootstrap-table/bootstrap-table-export.min.js'); ?>"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>

    

    <div class="container" class="col-sm-12">

		<div id="toolbar">
			<select class="form-control">
				<option value="all">Export All</option>
				<option value="selected">Export Selected</option>
			</select>
		</div>

<table id="table"
  data-show-export="true"
  data-toolbar="#toolbar"
  data-search="true"
  data-sortable="true"
  data-show-columns="true"
  data-toggle="table" 
  data-pagination="true"
  class="table"
  data-visible-search="true"
  >
  <thead class="table-primary">
		<tr>
			<th data-field="state" data-checkbox="true"></th>
			<th data-field="Course" data-sortable="true">Course</th>
			<th data-field="Subject" data-sortable="true">Subject</th>
			<th data-field="Semester" data-sortable="true">Semester</th>
      <th data-field="Department" data-sortable="true">Department</th>
      <th data-field="Professor" data-sortable="false">Professor</th>
			<th data-field="Date" data-sortable="true">Date & Time</th>
      <th data-field="edit">Action</th>
		</tr>
  </thead>
	<tbody>
	<?php 
	$sql=$this->db->select('*')->from('req_for_proff')->where('status','pending')->get();
	foreach($sql->result() as $req)
	{
    ?>
		<tr>
			<td class="bs-checkbox"><input data-index="<?php echo $req->req_id ?>" name="btSelectItem" type="checkbox"></td>
			<td><?php echo $req->req_course ?></td>
			<td><?php echo $req->req_subject ?></td>
			<td><?php echo $req->req_semester ?></td>
      <td><?php echo $req->req_for_dept ?></td>
      <td>
      <select class="custom-select" id="validationCustom06" required name="teacher">
                    <option selected disabled value="">Choose...</option>
                    <?php 

            $id=$_SESSION['u_id'];
            $this->db->select('*');
            $this->db->from('users');
            $this->db->join('hod_data','hod_data.email=users.email');
            $this->db->where('users.email',$id);
            $sql=$this->db->get();
            foreach($sql->result() as $user_data)
            {
            $dept=$user_data->dept;
            }



            $this->db->select('*');
            $this->db->from('users');
            $this->db->join('professor_data','professor_data.email=users.email');
            $this->db->where('professor_data.dept',$dept);
            $sql=$this->db->get();
            foreach($sql->result() as $user_data)
            {
              $mail=urlencode($user_data->email);
            echo "<option value='$req->req_id/$mail/$req->req_subject/$req->req_course/$req->req_semester/$req->req_for_dept'>$user_data->name</option>";
            }
            ?>
                </select>
      </td>
      <td><?php echo $req->date ?></td>
      <td class="text-center p-0" >
        <a href="<?php echo base_url(); ?>Hod/verify_req_success/<?php echo $req->req_id; ?>" id="href_acc"><i class="fa fa-user-check text-primary mr-3 text-success"></i></a>
        <a href="<?php echo base_url(); ?>Hod/verify_req_reject/<?php echo $req->req_id; ?>" id="href_rej"><i class="fa fa-user-times text-primary text-danger"></i></a>
      </td>
	  	</tr>
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
<script>
  $(document).ready(function() {
  $('#validationCustom06').on('change', function(){
    var proff_name = $(this).val();
    var new_href_acc='verify_req_success/'+proff_name;
    var new_href_rej='verify_req_reject/'+proff_name;
    $('#href_acc').attr('href',new_href_acc);
    $('#href_rej').attr('href',new_href_rej);
  })
});
</script>






</div>





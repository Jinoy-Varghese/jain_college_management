

<div class="container p-lg-4 ">
<?php 
if($this->session->flashdata('insert_success')){
 echo '
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong>  Attendance successfully marked.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
if($this->session->flashdata('update_success')){
  echo '
 <div class="alert alert-success alert-dismissible fade show" role="alert">
   <strong>Sucess!</strong> Book updated.
   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
     <span aria-hidden="true">&times;</span>
   </button>
 </div>';
 }
 
 
?>


<link href="<?php echo base_url('assets/bootstrap-table/bootstrap-table.min.css'); ?>" rel="stylesheet">

<script src="<?php echo base_url('assets/bootstrap-table/tableExport.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/bootstrap-table/jspdf.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/bootstrap-table/jspdf.plugin.autotable.js'); ?>"></script>
<script src="<?php echo base_url('assets/bootstrap-table/bootstrap-table.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/bootstrap-table/bootstrap-table-export.min.js'); ?>"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>

    <nav aria-label="breadcrumb mt-sm-5">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Attendance</a></li>
        <li class="breadcrumb-item active" aria-current="page">Mark Common Attendance</li>
    </ol>
    </nav>



    <div class="container" class="col-sm-12">

		<div id="toolbar">
			<select class="form-control">
				<option value="all">Export All</option>
				<option value="selected">Export Selected</option>
			</select>
		</div>
        <form method="post" action="<?php echo base_url();?>Professor/mark_attendance_process" class="needs-validation">
        
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
            <th data-field="no." data-sortable="true">no.</th>
			<th data-field="name" data-sortable="true">Name</th>

      <th data-field="edit">Action</th>
		</tr>
    
  </thead>
	<tbody>
  
  <?php  
  $id=$_SESSION['u_id'];
  $sql2=$this->db->select('*')->from('incharge_list')->where('user_incharge',$id)->limit(1)->order_by('timestamp','desc')->get();
	foreach($sql2->result() as $incharge)
	{
    $sem_charge=$incharge->semester;
  }
  $this->db->select('*');
  $this->db->from('incharge_list');
  $this->db->where('user_incharge',$id);
  $sql3=$this->db->get();
  foreach($sql3->result() as $user_data)
  {
    $sem=$user_data->semester;
    $u_dept=$user_data->incharge_dept;
  }


	$sql=$this->db->select('*')->from('student_data')->where('s_status',2)->where('s_sem',$sem_charge)->where('dept',$u_dept)->join('users','users.email=student_data.email')->get();
    $i=1;
	foreach($sql->result() as $student)
	{
      
    ?>
		<tr>
			<td class="bs-checkbox"><input data-index="<?php echo $student->student_id ?>" name="btSelectItem" type="checkbox"></td>
            <td><?php echo $i; ?></td>
			<td><?php echo $student->name; ?></td>

      <td class="p-0">
      <div class='form-row col-12 p-0'>
        <input type="hidden" name="limit" value="<?php echo $i; ?>">
        <input type="hidden" name="sid<?php echo $i; ?>" value="<?php echo $student->student_id; ?>">
        <div class='col-md-6 text-center'><input type="radio" name="<?php echo $i ?>" required value="present"> Present </div><div class='col-md-6 text-center'><input type="radio"  name="<?php echo $i ?>" required  value="absent"> Absent</div> 
      </div>
      </td>
	  	</tr>
    <?php
     $i=$i+1; 		
	}
	?>

	</tbody>
</table>

<div class="container">
<div class="row">

<div class="col-md-8 p-0">
<input type="reset" name="reset" value="Reset" class="btn btn-danger mr-2">
<input type="submit" class="btn btn-primary ">
</div>

<div class="col-md-4 p-0 mt-md-0 mt-3">
<input type="date" class="form-control col-md-7 float-right" name="date" value="<?php echo date('Y-m-d') ?>">
</div>
</div>
</div>
</form>
</div>








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

<?php
defined('BASEPATH') or exit('No direct script access allowed');
if(!isset($_SESSION['u_id']))
{
  redirect('Home/login','refresh');
}
?>

<style>
.detail-view
{
  animation:animate 0.3s linear 1;
}
@keyframes animate
{
  0%
  {
    opacity:0;
  }
  100%
  {
    opacity:1;
  }
}

.b
{
  display:inline-block;
  width:114px;
}
.colan
{
  display:inline-block;
  width:15px;
}


</style>

<link href="<?php echo base_url('assets/bootstrap-table/bootstrap-table.min.css'); ?>" rel="stylesheet">

<script src="<?php echo base_url('assets/bootstrap-table/tableExport.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/bootstrap-table/jspdf.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/bootstrap-table/jspdf.plugin.autotable.js'); ?>"></script>
<script src="<?php echo base_url('assets/bootstrap-table/bootstrap-table.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/bootstrap-table/bootstrap-table-export.min.js'); ?>"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>

    <div class="container" class="col-sm-12"><br>

    <nav aria-label="breadcrumb mt-sm-5">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">My Students</li>
    </ol>
    </nav>

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
data-detail-formatter="detailFormatter"
data-detail-view="true"


>
<thead class="table-primary" >
<tr>
    <th data-field="state" data-checkbox="true"></th>
    <th data-field="Name" data-sortable="true">Name</th>
    <th data-field="address" data-sortable="true" data-visible="false">Address</th>
    <th data-field="email" data-sortable="true" data-visible="false">E-mail</th>
    <th data-field="dept" data-sortable="true">Department</th>
    <th data-field="dob" data-sortable="true" data-visible="false">DOB</th>
    <th data-field="gender" data-sortable="true" data-visible="false">Gender</th>
    <th data-field="phone" data-visible="false">Mobile Number</th>
    <th data-field="course" >Course</th>
    <th data-field="sem" >Semester</th>
    <th data-field="image" data-visible="false">Image</th>
</tr>
</thead>
<tbody>
<?php 

$id=$_SESSION['u_id'];
$this->db->select('*');
$this->db->from('users');
$this->db->join('fees_paid','fees_paid.paid_by=users.email');
$this->db->join('student_data','student_data.email=users.email');
$this->db->where('s_status',2);
$sql=$this->db->get();
foreach($sql->result() as $user_data)
{
?>
<form name="incharge_change_form" method="post">
<tr>
    <td class="bs-checkbox"><input data-index="<?php echo $user_data->id ?>" name="btSelectItem" type="checkbox"></td>
    <td><input type="hidden" value="<?php echo $user_data->name ?>" id="cur_name" style="border:0;background:none;color:black;"><?php echo $user_data->name; ?></td>
    <td><?php echo $user_data->address ?></td>
    <td><?php echo $user_data->email ?></td>
    <td><?php echo $user_data->dept ?></td>
    <td><?php echo $user_data->dob ?></td>
    <td>
    <?php 
          if($user_data->gender=='m')
          {
            echo "Male";
          }
          elseif($user_data->gender=='f')
          {
            echo "Female";
          }
    ?>
    </td>
    
    <td><?php echo $user_data->phone ?></td>
    <td><?php echo $user_data->course ?></td>
    <td><?php echo $user_data->sem ?></td>
    <td><amp-img alt="image" src="<?php echo base_url($user_data->u_image);?>" class="img-fluid img-thumbnail" layout="responsive" height="200px" width="200px"></amp-img></td>
  </tr>
  </form>
<?php		
}
?>
</tbody>
</table>

</div>
<script>
  function detailFormatter(index, row) {
    return  '<div class="container"><div class="row mt-4 ml-md-2 ml-n5"><div class="col-9"> <div class="col-12 "><b class="b">Name  </b> <b class="colan"> : </b>'  + row.Name + '</div><div class="col-12"><b class="b">E-mail </b> <b class="colan"> : </b>' + row.email + '</div><div class="col-12"><b class="b">Phone Number </b> <b class="colan"> : </b>' + row.phone + '</div><div class="col-12"><b class="b">Address </b> <b class="colan"> : </b>' + row.address + '</div><div class="col-12"> <b class="b">Department </b> <b class="colan"> : </b>' + row.dept +' </div><div class="col-12"><b class="b">Date of Birth </b> <b class="colan"> : </b>' + row.dob + '</div><div class="col-12"> <b class="b">Gender </b> <b class="colan"> : </b>' + row.gender + '</div>  </div><div class="col-3 col-md-3">' + row.image +' </div>  </div></div>';
  }

</script>
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

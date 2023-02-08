

<div class="container p-lg-4 ">
<?php 
if($this->session->flashdata('insert_success')){
 echo '
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> New record created.
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
        <li class="breadcrumb-item"><a href="#">View User</a></li>
        <li class="breadcrumb-item active" aria-current="page">View Lab Assistant</li>
    </ol>
    </nav>

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
data-detail-formatter="detailFormatter"
data-detail-view="true"


>
<thead class="table-primary" >
<tr>
    <th data-field="state" data-checkbox="true"></th>
    <th data-field="name" data-sortable="true">Name</th>
    <th data-field="address" data-sortable="true" data-visible="false">Address</th>
    <th data-field="email" data-sortable="true">E-mail</th>
    <th data-field="dept" data-sortable="true" data-visible="false">Department</th>
    <th data-field="dob" data-sortable="true" data-visible="false">DOB</th>
    <th data-field="gender" data-sortable="true" data-visible="false">Gender</th>
    <th data-field="phone">Mobile Number</th>
    <th data-field="image" data-visible="false">Image</th>
</tr>
</thead>
<tbody>
<?php 

$this->db->select('*');
$this->db->from('users');
$this->db->join('lab_assistant_data','lab_assistant_data.email=users.email');
$this->db->where('users.role','lab assistant');
$sql=$this->db->get();
foreach($sql->result() as $lab_assistant_data)
{
?>
<form name="incharge_change_form" method="post">
<tr>
    <td class="bs-checkbox"><input data-index="<?php echo $lab_assistant_data->id ?>" name="btSelectItem" type="checkbox"></td>
    <td><?php echo $lab_assistant_data->name ?></td>
    <td><?php echo $lab_assistant_data->address ?></td>
    <td><?php echo $lab_assistant_data->email ?></td>
    <td><?php echo $lab_assistant_data->dept ?></td>
    <td><?php echo date("d-m-yy",strtotime($lab_assistant_data->dob)) ?></td>
    <td>
    <?php 
          if($lab_assistant_data->gender=='m')
          {
            echo "Male";
          }
          elseif($lab_assistant_data->gender=='f')
          {
            echo "Female";
          }
    ?>
    </td>
    
    <td><?php echo $lab_assistant_data->phone ?></td>
    <?php
    if($lab_assistant_data->u_image==null)
    {
      echo"<td><img alt='image' src='".base_url('assets/img/no-img.jpg')."' class='img-fluid img-thumbnail' layout='responsive' height='200px' width='200px'></td>";
    }
    else
    {
      echo"<td><img alt='image' src='".base_url($lab_assistant_data->u_image)."' class='img-fluid img-thumbnail' layout='responsive' height='200px' width='200px'></td>";
      
    }
   
    ?>
    </tr>
  </form>
<?php		
}
?>
</tbody>
</table>

</div>
    
</div>
<script>
  function detailFormatter(index, row) {
    return  '<div class="container"><div class="row mt-4 ml-md-2 ml-n5"><div class="col-9"> <div class="col-12 "><b class="b">Name  </b> <b class="colan"> : </b>'  + row.name + '</div><div class="col-12"><b class="b">E-mail </b> <b class="colan"> : </b>' + row.email + '</div><div class="col-12"><b class="b">Phone Number </b> <b class="colan"> : </b>' + row.phone + '</div><div class="col-12"><b class="b">Address </b> <b class="colan"> : </b>' + row.address + '</div><div class="col-12"> <b class="b">Department </b> <b class="colan"> : </b>' + row.dept +' </div><div class="col-12"><b class="b">Date of Birth </b> <b class="colan"> : </b>' + row.dob + '</div><div class="col-12"> <b class="b">Gender </b> <b class="colan"> : </b>' + row.gender + '</div>  </div><div class="col-3 col-md-3">' + row.image +' </div>  </div></div>';
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

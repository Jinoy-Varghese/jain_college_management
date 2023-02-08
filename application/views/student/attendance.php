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
<nav aria-label="breadcrumb mt-sm-5">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">View Attendance</li>
        </ol>
    </nav>
</div>


<div class="container">

<table class="text-center" data-toolbar="#toolbar" data-toggle="table" class="table" data-visible-search="true">
                        <thead class="table-primary">

                            <tr>
                                <th data-field="sl.no" data-sortable="true">Sl.No</th>
                                <th data-field="subject" data-sortable="true">Date</th>
                                <th data-field="semester" data-sortable="true">Present/Absent</th>
                            </tr>
                        </thead>
                        <tbody>
<?php 
$id=$_SESSION['u_id'];
$this->db->select('*');
$this->db->from('student_data');
$this->db->where('email',$id);
$sql=$this->db->get();
foreach($sql->result() as $user_data)
{
  $student_id=$user_data->student_id;
  $s_sem=$user_data->s_sem;
}

$this->db->select('*');
$this->db->from('attendance');
$this->db->where('s_id',$student_id);
$this->db->where('s_sem',$s_sem);
$sql=$this->db->get();
$i=1;
foreach($sql->result() as $user_data)
{
?>
<tr>
<th><?php echo $i++;?></th>
<th><?php echo date('d-m-Y',strtotime($user_data->timestamp));?></th>
<th><?php echo $user_data->s_attendance;?></th>
</tr>
  
  
<?php
}
?>
</tbody>
</table>

</div>
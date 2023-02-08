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
            <li class="breadcrumb-item active" aria-current="page">View Results</li>
        </ol>
    </nav>
</div>

<div class="container">

<table class="text-center" data-toolbar="#toolbar" data-toggle="table" class="table" data-visible-search="true">
                        <thead class="table-primary">

                            <tr>
                                <th data-field="sl.no" data-sortable="true">Sl.No</th>
                                <th data-field="subject" data-sortable="true">Subject</th>
                                <th data-field="semester" data-sortable="true">Semester</th>
                                <th data-field="date" data-sortable="true">Exam Conducted On</th>
                                <th data-field="mark" data-sortable="true">Mark Obtained</th>
                            </tr>
                        </thead>
                        <tbody>
<?php 
$id=$_SESSION['u_id'];
$this->db->select('*');
$this->db->from('parent_data');
$this->db->where('email',$id);
$sql=$this->db->get();
foreach($sql->result() as $user_data)
{
  $s_mail=$user_data->s_mail;
}

$this->db->select('*');
$this->db->from('exam_marks');
$this->db->where('student_id',$s_mail);
$sql=$this->db->get();
$i=1;
foreach($sql->result() as $user_data)
{
?>
<tr>
<th><?php echo $i++;?></th>
<th><?php echo $user_data->subject;?></th>
<th><?php echo $user_data->sem;?></th>
<th><?php echo date('d-m-Y',strtotime($user_data->date));?></th>
<th><?php echo $user_data->mark_obtained;?></th>
</tr>
  
  
<?php
}
?>
</tbody>
</table>

</div>
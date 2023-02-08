<?php
defined('BASEPATH') or exit('No direct script access allowed');
if(!isset($_SESSION['u_id']))
{
  redirect('Home/login','refresh');
}
?>
<style>
body
{
  overflow-y:hidden;
}
#top_nav
{
  background-color:black;
  height:50px;
  width:100vw;
  position:fixed;
  margin-top:-90px;"
}
@media print
{
#printpagebtn
{
    display:none;
}
}

</style>
<link href="<?php echo base_url('assets/bootstrap-table/bootstrap-table.min.css'); ?>" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url('assets/bootstrap-4.3.1/css/bootstrap.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/fontawesome-5.11.2/css/all.min.css'); ?>">

<script src="<?php echo base_url('assets/bootstrap-4.3.1/js/bootstrap.min.js') ?>"></script>
<script src="<?php echo base_url('assets/bootstrap-table/tableExport.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/bootstrap-table/jspdf.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/bootstrap-table/jspdf.plugin.autotable.js'); ?>"></script>
<script src="<?php echo base_url('assets/bootstrap-table/bootstrap-table.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/bootstrap-table/bootstrap-table-export.min.js'); ?>"></script>

<div class="container p-lg-4 ">
<nav aria-label="breadcrumb mt-sm-5">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">View Internal Mark</li>
        </ol>
    </nav>
</div>

<div class="container mt-5">
<div class="row" style="margin-top:30px;">

<div class="col-12">
<div class="col-md-12" style="overflow-x:scroll;">
<table class="table table-bordered text-center text-nowrap mt-n5" style="font-size:10px; width:80%; margin-left:-120px;">

<tr>
<th rowspan="3" class="align-middle">Candidate Code</th>
<th rowspan="3" class="align-middle">Name</th>
<th colspan="30">Name of Papers</th>
</tr>

<tr>
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
$this->db->from('student_data');
$this->db->where('email',$s_mail);
$sql=$this->db->get();
foreach($sql->result() as $user_data)
{
  $s_sem=$user_data->s_sem;
  $s_course=$user_data->s_course;
}
$s_sem=substr($s_sem,1);
$total_subject=0;
$total_theory=0;
$total_lab=0;
$subject_array=array();

$this->db->select('*');
$this->db->from('subjects');
$this->db->where('sub_sem',$s_sem);
$this->db->where('is_lab','theory');
$sql=$this->db->where('sub_course',$s_course)->get();
foreach($sql->result() as $user_data)
{
  echo '<th colspan="4">'.$user_data->sub_name.'</th>';
  $total_subject++;
  $total_theory++;
  $subject_array[$total_subject]=$user_data->sub_name;
}
$this->db->select('*');
$this->db->from('subjects');
$this->db->where('sub_sem',$s_sem);
$this->db->where('is_lab','lab');
$sql=$this->db->where('sub_course',$s_course)->get();
foreach($sql->result() as $user_data)
{
  echo '<th colspan="5">'.$user_data->sub_name.'</th>';
  $total_subject++;
  $total_lab++;
  $subject_array[$total_subject]=$user_data->sub_name;
}
?>
</tr>
<tr>



<?php 
  for($i=1;$i<=$total_theory;$i++)
  {
?>
<th>A</th>
<th>Assig</th>
<th>T</th>
<th>Total</th>
<?php
  }
for($i=1;$i<=$total_lab;$i++)
  {
?>
<th>A</th>
<th>R</th>
<th>T</th>
<th>PPS</th>
<th>Total</th>
<?php
  }
?>




</tr>

<tr>
<th></th>
<th></th>


<?php 
  for($i=1;$i<=$total_theory;$i++)
  {
?>
<th>(5)</th>
<th>(5)</th>
<th>(10)</th>
<th>(20)</th>
<?php
  }
for($i=1;$i<=$total_lab;$i++)
  {
?>
<th>(5)</th>
<th>(5)</th>
<th>(5)</th>
<th>(5)</th>
<th>(20)</th>
<?php
  }
?>

</tr>


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
      $this->db->from('users');
      $this->db->where('email',$s_mail);
      $sql=$this->db->get();
      foreach($sql->result() as $user_data)
      {
        $s_id=$user_data->id;
        $s_email=$user_data->email;

?>
<tr>



<th><?php echo $s_id; ?></th>
<th><?php echo $user_data->name; ?></th>

<?php 
for($i=1;$i<=$total_theory;$i++)
  {
?>


<th>
    <?php
      //--- attendance ---
      $this->db->select('*');
      $this->db->from('subject_attendance');
      $this->db->where('s_id',$s_mail);
      $this->db->where('subject',$subject_array[$i]);
      $sql2=$this->db->get();
      $total_attendance=$sql2->num_rows();


      $this->db->select('*');
      $this->db->from('subject_attendance');
      $this->db->where('s_id',$s_mail);
      $this->db->where('subject',$subject_array[$i]);
      $this->db->where('s_attendance','present');
      $sql2=$this->db->get();
      $total_present=$sql2->num_rows();
      
      if($total_attendance==0)
      {
        echo $attendance_average=5;
      }
      else
      {
      echo $attendance_average=round($attend_mark=($total_present*5)/$total_attendance);
      }
      //--- end attendance ---
    ?>
</th>
<th>

<?php
      //--- assignment ---
      $this->db->select('*');
      $this->db->from('assignment');
      $this->db->where('a_email',$s_mail);
      $this->db->where('a_subject',$subject_array[$i]);
      $sql2=$this->db->get();
      $total_assignment=$sql2->num_rows();

      $mark=0;
      $this->db->select('*');
      $this->db->from('assignment');
      $this->db->where('a_email',$s_mail);
      $this->db->where('a_subject',$subject_array[$i]);
      $sql2=$this->db->get();
      foreach($sql2->result() as $user_data2)
      {
        $mark=$mark+$user_data2->mark;
      }
      
      if($total_assignment==0)
      {
        echo $assignment_average=5;
      }
      else
      {
      echo $assignment_average=round(($mark/$total_assignment));
      }
      //--- end assignment ---
    ?>

</th>
<th>


<?php
      //--- testpaper/xam ---
      $this->db->select('DISTINCT(exam_id)');
      $this->db->from('exam_marks');
      $this->db->where('student_id',$s_mail);
      $this->db->where('subject',$subject_array[$i]);
      $sql2=$this->db->get();
      $total_exam=$sql2->num_rows();

      $mark=0;
      $this->db->select('*');
      $this->db->from('exam_marks');
      $this->db->where('student_id',$s_mail);
      $this->db->where('subject',$subject_array[$i]);
      $sql2=$this->db->get();
      foreach($sql2->result() as $user_data2)
      {
        $mark=$mark+$user_data2->mark_obtained;
      }
      
      if($total_exam==0)
      {
        echo $exam_average=10;
      }
      else
      {
      echo $exam_average=round(($mark/$total_exam));
      }
      //--- end testpaper/xam ---
    ?>


</th>
<th>

<?php 
  echo $exam_average+$assignment_average+$attendance_average;
?>

</th>


<?php
  }

for($i=$total_theory+1;$i<=$total_subject;$i++)
  {
?>
<th>

<?php
      //--- attendance ---
      $this->db->select('*');
      $this->db->from('subject_attendance');
      $this->db->where('s_id',$s_mail);
      $this->db->where('subject',$subject_array[$i]);
      $sql2=$this->db->get();
      $total_attendance=$sql2->num_rows();


      $this->db->select('*');
      $this->db->from('subject_attendance');
      $this->db->where('s_id',$s_mail);
      $this->db->where('subject',$subject_array[$i]);
      $this->db->where('s_attendance','present');
      $sql2=$this->db->get();
      $total_present=$sql2->num_rows();
      
      if($total_attendance==0)
      {
        echo $attendance_average=5;
      }
      else
      {
      echo $attendance_average=round($attend_mark=($total_present*5)/$total_attendance);
      }
      //--- end attendance ---
    ?>

</th>
<th>

<?php
      //--- lab_record ---
      $this->db->select('*');
      $this->db->from('lab_record');
      $this->db->where('email',$s_mail);
      $this->db->where('subject',$subject_array[$i]);
      $sql2=$this->db->get();
      $total_lab_record=$sql2->num_rows();

      $mark=0;
      $this->db->select('*');
      $this->db->from('lab_record');
      $this->db->where('email',$s_mail);
      $this->db->where('subject',$subject_array[$i]);
      $sql2=$this->db->get();
      foreach($sql2->result() as $user_data2)
      {
        $record_mark=$user_data2->mark;
      }
      
      if($total_lab_record==0)
      {
        echo $record_mark=0;
      }
      else
      {
      echo $record_mark;
      }
      //--- end lab_record ---
    ?>


</th>
<th>

<?php
      //--- testpaper/xam ---
      $this->db->select('DISTINCT(exam_id)');
      $this->db->from('exam_marks');
      $this->db->where('student_id',$s_mail);
      $this->db->where('subject',$subject_array[$i]);
      $sql2=$this->db->get();
      $total_exam=$sql2->num_rows();

      $mark=0;
      $this->db->select('*');
      $this->db->from('exam_marks');
      $this->db->where('student_id',$s_mail);
      $this->db->where('subject',$subject_array[$i]);
      $sql2=$this->db->get();
      foreach($sql2->result() as $user_data2)
      {
        $mark=$mark+$user_data2->mark_obtained;
      }
      
      if($total_exam==0)
      {
        echo $exam_average=5;
      }
      else
      {
      echo $exam_average=round(($mark/$total_exam)/2);
      }
      //--- end testpaper/xam ---
    ?>

</th>
<th>

<?php
      //--- pps_mark ---
      $this->db->select('mark');
      $this->db->from('pps_mark');
      $this->db->where('email',$s_mail);
      $this->db->where('subject',$subject_array[$i]);
      $sql2=$this->db->get();
      $total_pps_mark=$sql2->num_rows();

      $mark=0;
      $this->db->select('mark');
      $this->db->from('pps_mark');
      $this->db->where('email',$s_mail);
      $this->db->where('subject',$subject_array[$i]);
      $sql2=$this->db->get();
      foreach($sql2->result() as $user_data2)
      {
        $pps_mark=$user_data2->mark;
      }
      
      if($total_pps_mark==0)
      {
        echo $pps_mark=0;
      }
      else
      {
      echo $pps_mark;
      }
      //--- end pps_mark ---
    ?>

</th>
<th>

<?php echo $pps_mark+$exam_average+$record_mark+$attendance_average; ?>

</th>
<?php
  }
?>




</tr>

<?php
      }
?>


</table>
</div>
</div>
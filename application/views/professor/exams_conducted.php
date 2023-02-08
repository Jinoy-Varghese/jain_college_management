<?php
defined('BASEPATH') or exit('No direct script access allowed');
if(!isset($_SESSION['u_id']))
{
  redirect('Home/login','refresh');
}
if($this->session->flashdata('insert_success')){
    echo '
   <div class="alert alert-success alert-dismissible fade show" role="alert">
     <strong>Success!</strong> Answers submitted successfully.
     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
       <span aria-hidden="true">&times;</span>
     </button>
   </div>';
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
.custom-button
{

  color:#007BFF;
  text-decoration:none;

}
.custom-button:hover
{
  color:white;
  background:#007BFF;
  cursor:pointer;
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
        <li class="breadcrumb-item" aria-current="page"><a href="#">Exams</a></li>
        <li class="breadcrumb-item active" aria-current="page">Exams Conducted</li>

    </ol>
    </nav>


<table id="table"
data-show-export="false"
data-toolbar="#toolbar"
data-search="true"
data-sortable="true"
data-show-columns="true"
data-toggle="table" 
data-pagination="true"
class="table"
data-visible-search="true"
data-detail-formatter="detailFormatter"
data-detail-view="false"


>
<thead class="table-primary" >
<tr>
   
    <th data-field="id" data-sortable="true" >id</th>
    <th data-field="Exam id" data-sortable="true" >Exam id</th>
    <th data-field="Subject" data-sortable="true">Subject</th>
    <th data-field="Date" data-sortable="true" >Date</th>
    <th data-field="Action" data-sortable="false" >Action</th>

</tr>
</thead>
<tbody>
<?php 
 $i=1;
 date_default_timezone_set('Asia/Kolkata');
 $cur_datetime=date("d-m-y");
 $this->db->select('*');
 $this->db->from('exam_questions');
 $this->db->where('question_by',$_SESSION['u_id']);
 $sql=$this->db->get();
 $array=array('0');

 
  $this->db->select('DISTINCT(exam_id),subject,date');
  $this->db->from('exam_questions');
  $this->db->where_not_in('exam_id',$array);
  $this->db->where('date>=',$cur_datetime);
  $sql=$this->db->get();
  foreach($sql->result() as $user_data)
  {
  

?>
<tr>
    <td><?php echo $i;$i++; ?></td>
    <td><?php echo $user_data->exam_id ?></td>
    <td><?php echo $user_data->subject ?></td>
    <td><?php echo date('d-m-Y',strtotime($user_data->date)); ?></td>
    <td><a href="<?php echo base_url('/Professor/update_exam?exam_id=');echo $user_data->exam_id; ?>" class="btn border-primary col-12 custom-button">Update</a></td>

  </tr>

<?php		

}
?>
</tbody>
</table>

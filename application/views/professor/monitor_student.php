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
        <li class="breadcrumb-item"><a href="#">Exams</a></li>
        <li class="breadcrumb-item active" aria-current="page">Monitor Exams</li>
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
    <th data-field="#" data-sortable="true">#</th>
    <th data-field="Exam id" data-sortable="true" >Exam id</th>
    <th data-field="Subject" data-sortable="true">Subject</th>
    <th data-field="Exam Date" data-sortable="true" >Exam Date</th>
    <th data-field="Course" data-sortable="true" data-visible="false">Course</th>
    <th data-field="Semester" data-sortable="true" data-visible="false">Semester</th>
    <th data-field="Time" data-sortable="true" >Time</th>
    <th data-field="Last Date" data-sortable="true" data-visible="false">Last Date</th>

    <th data-field="Action" data-sortable="false" >Action</th>

</tr>
</thead>
<tbody>
<?php 
$i=1;


  $cur_datetime=date("Y-m-d H:i:s");
  $this->db->select('DISTINCT(exam_id),subject,scheduled_date,course,semester,last_date,time');
  $this->db->from('exam_questions');
  $this->db->where('scheduled_date<=',$cur_datetime);
  $this->db->where('last_date>=',$cur_datetime);
  $sql=$this->db->get();
  foreach($sql->result() as $user_data)
  {
  

?>
<tr>
    <td><?php echo $i;$i++; ?></td>
    <td><?php echo $user_data->exam_id ?></td>
    <td><?php echo $user_data->subject ?></td>
    <td><?php echo $user_data->scheduled_date ?></td>
    <td><?php echo $user_data->course ?></td>
    <td><?php echo $user_data->semester ?></td>
    <td><?php echo $user_data->time ?></td>
    <td><?php echo $user_data->last_date ?></td>


    <td><a href="https://mtcst.herokuapp.com/exam<?php echo $user_data->exam_id ?>" class="btn border-primary col-12 custom-button">Proctor</a></td>

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

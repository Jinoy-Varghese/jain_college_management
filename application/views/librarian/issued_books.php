

<div class="container p-lg-4 ">
<?php 
if($this->session->flashdata('book_returned')){
 echo '
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong>  Book Returned.
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
        <li class="breadcrumb-item active" aria-current="page">Issued Books</li>
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
  data-visible-search="true" 
  data-pagination="true"
  class="table">
  <thead class="table-primary">
		<tr>
			<th data-field="state" data-checkbox="true"></th>
			<th data-field="book_name" data-sortable="true">Book Name</th>
      <th data-field="borrower_name" data-sortable="true">Borrower Name</th>
			<th data-field="author" data-sortable="true">Issue date</th>
			<th data-field="copies" data-sortable="true">Return date</th>
			<th data-field="about">Status</th>
      <th data-field="edit">Action</th>
		</tr>
  </thead>
	<tbody>
	<?php 
	$sql=$this->db->select('t3.book_name,t2.name,t1.issue_date,t1.return_date,t1.status,t1.id')->from('book_issues as t1')->where('t1.status',"issued")->join('users as t2','t1.borrower_id=t2.id')->join('books as t3','t1.book_id=t3.book_id')->get();
	foreach($sql->result() as $book)
	{
    ?>
		<tr>
			<td class="bs-checkbox"><input data-index="<?php echo $book->book_id ?>" name="btSelectItem" type="checkbox"></td>
			<td><?php echo $book->book_name; ?></td>
			<td><?php echo $book->name; ?></td>
			<td><?php echo $book->issue_date; ?></td>
      <td><?php echo $book->return_date; ?></td>
      <td><?php 
      $date1=date_create(date('Y-m-d'));
      $date2=date_create($book->return_date);
      $diff=date_diff($date1,$date2);
      if($diff->format("%R%a")>0) 
      {  
      echo $diff->format("%a day to return"); 
      }
      elseif($diff->format("%R%a")==0)
      {
        echo "Return today";
      }
      else
      {
        echo $diff->format("%a day late");
      }
      ?></td>
      <td class="text-center p-0">
        <a href="<?php echo base_url(); ?>Librarian/mark_as_returned/<?php echo $book->id; ?>"><i class="fa fa-check-circle text-primary mr-1"></i>Mark as returned</a>
      </td>
	  	</tr>
	<?php		
	}
	?>
	</tbody>
</table>

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

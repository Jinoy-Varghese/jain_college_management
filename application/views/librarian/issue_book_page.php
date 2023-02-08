

<div class="container p-lg-4 ">
<?php 
$book_id=$this->uri->segment(3);


?>
    <nav aria-label="breadcrumb mt-sm-5">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item" aria-current="page"><a href="#">Add New Book</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Book</li>
    </ol>
    </nav>
    <?php 
	$sql=$this->db->get_where('books',array('book_id'=>$book_id));
	foreach($sql->result() as $book)
	{
    ?>
    <form class="needs-validation mt-5" novalidate method="post" action="<?php echo base_url();?>Librarian/issue_book_process">
    <div class="form-row">
        <div class="col-md-5 mb-3">
        <label for="validationCustom01">Book name</label>
        <input type="text" class="form-control" id="validationCustom01" name="book_name" required value="<?php echo $book->book_name; ?>" readonly>
        <input type="hidden" value="<?php echo $book->book_id; ?>" name="book_id">

        </div>
        <div class="col-md-5 mb-3">
        <label for="validationCustom02">Writer name</label>
        <input type="text" class="form-control" id="validationCustom02" name="writer_name" required value="<?php echo $book->author; ?>" readonly>

        </div>
        <div class="col-md-2 mb-3">
        <label for="validationCustom02">Copies left</label>
        <input type="number" class="form-control" id="validationCustom03" name="copies" required value="<?php echo $book->copies; ?>" readonly>

        </div>
    </div>
    <div class="form-row">
          <div class="col-md-5 mb-3">
            <label for="validationCustom03">Borrower Id</label>
            <input type="number" class="form-control" name="borrower_id" required>
          </div>
          <div class="col-md-4 mb-3">
            <label for="validationCustom03">Return date</label>
            <input type="date" class="form-control" name="return_date" required>
          </div>
    </div>
    <input type="hidden" value="<?php echo $book->book_id; ?>" name="book_id">

        <?php		
      }
      ?>
        
        <input class="btn btn-primary" type="submit" name="book_issue" value="Issue Book">

    </form>
    
</div>


<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();

</script>

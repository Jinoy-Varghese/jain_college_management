

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
    <nav aria-label="breadcrumb mt-sm-5">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Add New Book</li>
    </ol>
    </nav>
    <form class="needs-validation mt-5" novalidate method="post" action="<?php echo base_url();?>Librarian/insert_book">
    <div class="form-row">
        <div class="col-md-5 mb-3">
        <label for="validationCustom01">Book name</label>
        <input type="text" class="form-control" id="validationCustom01" name="book_name" required>
        <div class="valid-feedback">
            Looks good!
        </div>
        <div class="invalid-feedback">
            Please provide a Book Name.
        </div>
        </div>
        <div class="col-md-5 mb-3">
        <label for="validationCustom02">Writer name</label>
        <input type="text" class="form-control" id="validationCustom02" name="writer_name" required>
        <div class="valid-feedback">
            Looks good!
        </div>
        <div class="invalid-feedback">
            Please provide a Writer Name.
        </div>
        </div>
        <div class="col-md-2 mb-3">
        <label for="validationCustom02">Copies</label>
        <input type="number" class="form-control" id="validationCustom03" name="copies" required>
        <div class="valid-feedback">
            Looks good!
        </div>
        <div class="invalid-feedback">
            Please provide number of copies.
        </div>
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-12 mb-3">
        <label for="validationCustom03">About</label>
        <textarea rows="6" class="form-control" name="about"></textarea>
        </div>
    </div>

    <input class="btn btn-primary" type="submit" name="u_reg" value="Add Book">
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

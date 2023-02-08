<div class="container p-lg-4 ">

    <nav aria-label="breadcrumb mt-sm-5">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Add New Notes</a></li>
        </ol>
    </nav>






    <form class="needs-validation mt-5" novalidate method="post"
        action="<?php echo base_url();?>Professor/insert_note_process" enctype="multipart/form-data">

        <div class="form-row mt-5">



            <div class="col-md-4 mb-3">
                <label for="validationCustom06">Course</label>

                <select class="custom-select" id="validationCustom08" required name="course">
                    <option selected disabled value="">Choose...</option>
                    <?php 

            $id=$_SESSION['u_id'];
            $this->db->select('*');
            $this->db->from('users');
            $this->db->join('hod_data','hod_data.email=users.email');
            $this->db->where('users.email',$id);
            $sql=$this->db->get();
            foreach($sql->result() as $user_data)
            {
            $dept=$user_data->dept;
            }


            $this->db->distinct();
            $this->db->select('*');
            $this->db->from('subject_assigned');
            $this->db->where('teacher_id',$_SESSION['u_id']);
            $sql=$this->db->get();
            foreach($sql->result() as $subject_data)
            {
            echo "<option value='$subject_data->sub_course'>$subject_data->sub_course</option>";
            }
            ?>
                </select>
                <div class="valid-feedback">
                    Looks good!
                </div>
                <div class="invalid-feedback">
                    Please enter a Course.
                </div>
            </div>


            <div class="col-md-4 mb-3">
                <label for="validationCustom05">Semester</label>

                <select class="custom-select" id="validationCustom05" required name="semester">
                    <option selected disabled value="">Choose...</option>
                    <?php 
                        $this->db->distinct();
                        $this->db->select('*');
                        $this->db->from('subject_assigned');
                        $this->db->where('teacher_id',$_SESSION['u_id']);
                        $sql=$this->db->get();
                        foreach($sql->result() as $subject_data)
                        {
                          echo "<option value='$subject_data->sem'>$subject_data->sem</option>";
                        }
                    ?>
                </select>
                <div class="valid-feedback">
                    Looks good!
                </div>
                <div class="invalid-feedback">
                    Please enter a Semester.
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <label for="validationCustom06">Subject</label>

                <select class="custom-select" id="validationCustom06" required name="note_subject">
                    <option selected disabled value="">Choose...</option>
                    <?php 

                $this->db->distinct();
                $this->db->select('*');
                $this->db->from('subject_assigned');
                $this->db->where('teacher_id',$_SESSION['u_id']);
                $sql=$this->db->get();
                foreach($sql->result() as $subject_data)
                {
                echo "<option value='$subject_data->subject'>$subject_data->subject</option>";
                }


            ?>
                </select>
                <div class="valid-feedback">
                    Looks good!
                </div>
                <div class="invalid-feedback">
                    Please enter a Semester.
                </div>
            </div>


            <div class="col-md-4 mb-3">
                <label for="exampleInputEmail1">Heading</label>
                <input type="text" class="form-control" id="validationCustom01" name="note_heading" required>
                <div class="invalid-feedback">
                    Please provide a valid Heading.
                </div>
            </div>


            <div class="col-md-8 mb-3 speech row">
                <div class="col-10 p-0">
                    <label for="validationCustom03">Description</label>
                    <textarea rows="1" class="form-control rounded-left" name="note_desc" id="transcript"></textarea>
                </div>
                <div class="col-2 mt-4 pt-2 pl-0 ml-0 mb-1">
                    <img onclick="startDictation()" src="https://i.imgur.com/cHidSVu.gif" class=" rounded-right border-left-0 border " />
                </div>
            </div>


            <div class="col-md-4 mb-3">
                <label for="validationCustom03">File</label>
                <div class="custom-file">
                    <label for="note_file_id" class="form-control border-primary" style="height:35px;"><i
                            class="fas fa-camera"></i>&nbsp&nbspChoose File</label>
                    <input type="file" class="custom-file-input" name="note_file" id="note_file_id" required
                        style="display:none;">
                    <div class="invalid-feedback">
                        Please provide the notes.
                    </div>
                </div>
            </div>






        </div>
        <div class="form-row">
            <input class="btn btn-primary ml-1" type="submit" name="n_add" value="Submit Note">
        </div>

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
<style>
.speech {

    padding: 0;

    margin: 0
}

.speech input {}

.speech img {

    width: 37px
}
</style>
<script>
function startDictation() {

    if (window.hasOwnProperty('webkitSpeechRecognition')) {

        var recognition = new webkitSpeechRecognition();

        recognition.continuous = false;

        recognition.interimResults = false;

        recognition.lang = "en-US";

        recognition.start();

        recognition.onresult = function(e) {

            document.getElementById('transcript').value = e.results[0][0].transcript;

            recognition.stop();


        };

        recognition.onerror = function(e) {

            recognition.stop();

        }

    }

}
</script>
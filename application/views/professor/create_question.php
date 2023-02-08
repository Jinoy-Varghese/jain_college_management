<div class="container p-lg-4 ">
    <form class=" mt-5" method="post" action="<?php echo base_url();?>Professor/create_question_process">

        <input type="hidden" name="semester" value="<?php echo $_GET['semester'] ?>">
        <input type="hidden" name="course" value="<?php echo $_GET['course'] ?>">
        <input type="hidden" name="subject" value="<?php echo $_GET['subject'] ?>">
        <input type="hidden" name="limit" value="<?php echo $_GET['question_no'] ?>">
        <input type="hidden" name="time" value="<?php echo $_GET['time'] ?>">
        <input type="hidden" name="last_date" value="<?php echo $_GET['last_date'] ?>">






        <?php
for($i=1;$i<=$_GET['question_no'];$i++)
{

?>
        <div class="form-row mt-5">

            <div class="mt-2 h5"> <?php echo $i ?>. </div>
            <div class="col-11">
                <input required type="text" class="col-12 form-control" placeholder="Enter your question"
                    name="question<?php echo $i ?>">
            </div>
            <div class="col-md-5 ml-4 mt-3"><input required type="text" name="optiona<?php echo $i ?>"
                    class="form-control" placeholder="Option 1"></div>
            <div class="col-md-5 ml-4 mt-3"><input required type="text" name="optionb<?php echo $i ?>"
                    class="form-control" placeholder="Option 2"></div>
            <div class="col-md-5 ml-4 mt-3"><input required type="text" name="optionc<?php echo $i ?>"
                    class="form-control" placeholder="Option 3"></div>
            <div class="col-md-5 ml-4 mt-3"><input required type="text" name="optiond<?php echo $i ?>"
                    class="form-control" placeholder="Option 4"></div>

            <div class="mt-5 h5 ml-md-4 mb-md-5"> Choose the correct answer : </div>
            <div class="col-md-3 mt-md-5">
                <select required type="text" class="col-12 form-control" style="height:35px;"
                    name="answer<?php echo $i ?>">
                    <option disabled selected>select</option>
                    <option value="a">Option 1</option>
                    <option value="b">Option 2</option>
                    <option value="c">Option 3</option>
                    <option value="d">Option 4</option>
                </select>
            </div>
        </div>

        <?php
}
?>



        <div class="form-row mt-5 mt-md-3 pb-3 col-12 pl-0 pr-0 pl-md-4" id="schedule_date">
            <input type="datetime-local" class="col-md-3 col-12 form-control" name="scheduled_date"
                min="<?php echo $_GET['last_date'] ?>">
        </div>


        <div class="form-row mt-4 col-12 p-0">
            <input class="btn btn-primary ml-md-4 mb-3 col-md-2 col-12" type="submit" name="u_reg" value="Create Exam">
            <button type="button" class="btn ml-md-4 mb-3 col-md-2 col-12 text-primary"
                style="border:1.5px solid #007BFF;" id="set_date_button">Schedule Exam</button>

        </div>

    </form>
</div>
<script>
$('#schedule_date').hide();
$("#set_date_button").click(function() {
    $("#schedule_date").slideToggle("100");
});
</script>
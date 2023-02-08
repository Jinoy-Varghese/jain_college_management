<?php
defined('BASEPATH') or exit('No direct script access allowed');
if(!isset($_SESSION['u_id']))
{
  redirect('Home/login','refresh');
}
?>
<?php
    function get_file_extension($file_name)
    {
    return pathinfo($file_name,PATHINFO_EXTENSION);
    }
?>
<div class="container p-lg-4">
<?php 
if($this->session->flashdata('insert_note_success')){
 echo '
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> New Note Inserted.
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
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3"></div>
        <div class="col-md-4"></div>
        <div class="col-md-2 col-sm-12 mt-5 "><a href="add_notes_page" class="btn btn-primary text-light float-right w-100 mr-md-1 pt-2 pb-2" style="cursor:pointer">Add Notes</a></div>
    </div>


    <div class="row p-0 mt-4 mt-md-5">

    <?php
    $sql1=$this->db->get_where('users',array('email'=>$_SESSION["u_id"]));
    foreach($sql1->result() as $user_name)
    {
        $note_by=$user_name->name;
    }
    $this->db->select('*');
    $this->db->from('notes');
    $this->db->where('note_by',$note_by);
    $sql=$this->db->get();  
    $i=1;
    foreach($sql->result() as $note_data)
    {
    $date=date("d-m-Y",strtotime($note_data->note_date));
?>

 


        <div class="modal fade bd-example-modal-lg" id="exampleModalCenter<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle"><?php echo strtoupper($note_data->note_heading);?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              
                <div class="container">
                    <div class="row p-0">




                    <?php 
                    $file_format=get_file_extension("$note_data->note_file");
                    if($file_format=="pdf")
                    {
                      echo "<div class='col-4'><div class='col-md-12 col-12  p-0' style='height:275px;'><embed src='".base_url($note_data->note_file)."#toolbar=0' class='col-12 p-0' style='height:275px;'></div></div>";
                    }
                    elseif($file_format=="jpg" || $file_format=="png" || $file_format=="jpeg")
                    {
                      echo "<div class='col-4'><div class='col-md-12 col-12 border border-dark ' style='height:250px;'><img src='".base_url($note_data->note_file)."' class='col-12 p-0' style='height:248px;' loading='lazy'></div></div>";
                    }
                    elseif($file_format=="docx")
                    {
                      echo "<div class='col-4'><div class='col-md-12 col-12 border border-dark p-0' style='height:250px;'><img src='".base_url('assets/image/word_file.jpg')."' class='col-12 p-0' style='height:248px;' loading='lazy'></div></div>";
                    }
                    elseif($file_format=="pptx")
                    {
                      echo "<div class='col-4'><div class='col-md-12 col-12 border border-dark p-0' style='height:250px;'><img src='".base_url('assets/image/powerpoint_file.jpg')."' class='col-12 p-0' style='height:248px;' loading='lazy'></div></div>";
                    }
                    else
                    {
                      echo "<div class='col-4'><div class='col-md-12 col-12 border border-dark p-0' style='height:250px;'><img src='".base_url('assets/image/other_file.jpg')."' class='col-12 p-0' style='height:248px;' loading='lazy'></div></div>";
                    }
                    


                    ?>

                        <div class="col-8 p-0 mt-md-5">
                            <div class="col-md-12"><b>Heading :</b> <?php echo strtoupper($note_data->note_heading);?></div>
                            <div class="col-md-12"><b>Description :</b> <?php echo ($note_data->note_desc);?></div>
                            <div class="col-md-12"><b>Course :</b> <?php echo ($note_data->course);?></div>
                            <div class="col-md-12"><b>Subject :</b> <?php echo ($note_data->note_subject);?></div>
                            <div class="col-md-12"><b>Semester :</b> <?php echo($note_data->note_for);?></div>
                            <div class="col-md-12"><b>Date :</b> <?php echo date("d-m-Y",strtotime($note_data->note_date));?></div>
                        </div>
                    </div>
                </div>
              
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a href="<?php echo base_url($note_data->note_file); ?>" class="btn btn-primary text-light" download>Download</a>
              </div>
            </div>
          </div>
        </div>

    <div class="col-md-3 col-6">
      <div class="border border-dark m-md-2 rounded mb-4" data-toggle="modal" data-target="#exampleModalCenter<?php echo $i; ?>" style="cursor:pointer;">

    <?php 
    $file_format=get_file_extension("$note_data->note_file");
    if($file_format=="pdf")
    {
    echo "<div class='col-12 border  rounded-top' style='height:120px; background-image:url(".base_url('assets/image/pdf_file.jpg').");background-size:cover;background-position: center;'></div>";
    }
    elseif($file_format=="docx")
    {
        echo "<div class='col-12 border  rounded-top' style='height:120px; background-image:url(".base_url('assets/image/word_file.jpg').");background-size:cover;background-position: center;'></div>";
    }
    elseif($file_format=="pptx")
    {
        echo "<div class='col-12 border  rounded-top' style='height:120px; background-image:url(".base_url('assets/image/powerpoint_file.jpg').");background-size:cover;background-position: center;'></div>";
    }
    elseif($file_format=="jpg" || $file_format=="png" || $file_format=="jpeg")
    {
        echo "<div class='col-12 border  rounded-top' style='height:120px; background-image:url(".base_url('assets/image/jpg_file.jpg').");background-size:cover;background-position: center;'></div>";
    }
    else
    {
        echo "<div class='col-12 border rounded-top' style='height:120px; background-image:url(".base_url('assets/image/other_file.jpg').");background-size:cover;background-position: center;'></div>";
    }
    ?>
    <div class="col-12 border rounded-bottom pt-md-2" style=" font-size:85%;"><b><?php echo $i; $i++;?>.
    <?php 
    if(strlen($note_data->note_heading)>=12)
    {
        $new_head=substr($note_data->note_heading,0,16);
        echo strtoupper($new_head.'...');
    }
    else
    {
        echo strtoupper($note_data->note_heading);
    }
    ?>
    </b>
    <div class="col-md-12 col-12 ml-n2 mb-md-2" style="font-size:85%;">Upload On <?php echo $date;?></div>
    </div>    
    </div>
    </div>

    <?php
        }
    ?>
  </div>
</div>
<div class="col-md-12 mt-5"></div>



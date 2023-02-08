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
<style>
.activegrid 
    {
      background: linear-gradient(40deg, rgba(63,94,251,1) 0%, rgba(92,126,242,1) 13%, rgba(132,88,244,1) 29%, rgba(203,30,233,1) 43%, rgba(71,226,238,1) 58%, rgba(71,104,244,1) 75%, rgba(70,184,252,1) 100%);
            background-size: 400% 400%;
        animation: gradient 15s ease infinite;
        color:#fff
    }
    @keyframes gradient {
        0% {
          background-position: 0% 50%;
        }
        50% {
          background-position: 100% 50%;
        }
        100% {
          background-position: 0% 50%;
        }
      }

</style>
<div class="container p-lg-4">
<?php 
if($this->session->flashdata('insert_success')){
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


    <div class="row p-0 mt-5 col-12">
        <div class="list activegrid col-5 col-md-1 border mr-1 mt-1 mb-1 pb-2 pt-2" style="cursor:pointer;" data-filter="all">All</div>
        <?php
        $this->db->from('student_data');
        $this->db->select('s_sem');
        $sql3=$this->db->where('email',$_SESSION['u_id'])->get();
        foreach($sql3->result() as $student_data)
        {
          $student_sem=$student_data->s_sem;
        }


        $this->db->from('subject_assigned');
        $this->db->select('*');
        $sql4=$this->db->where('sem',$student_sem)->get();
        foreach($sql4->result() as $subject_data)
        {
          $subjects=$subject_data->subject;
          echo '<div class="list col-5 col-md-2 border m-1 pb-2 pt-2" data-filter="'.str_replace(' ','',$subjects).'"  style="cursor:pointer;white-space:nowrap;">'.$subjects.'</div>';
        }

        ?>
        </div>
    </div>


    <div class="row p-0 mt-4 mt-md-2">

    <?php
        $this->db->from('student_data');
        $this->db->select('s_sem');
        $sql3=$this->db->where('email',$_SESSION['u_id'])->get();
        foreach($sql3->result() as $student_data)
        {
          $student_sem=$student_data->s_sem;
        }


        $this->db->from('subject_assigned');
        $this->db->select('*');
        $sql4=$this->db->where('sem',$student_sem)->get();
        foreach($sql4->result() as $subject_data)
        {
          $subjects=$subject_data->subject;
        }
        
    $this->db->select('*');
    $this->db->from('notes');
    $this->db->where('note_for',$student_sem);
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

    <div class="col-md-3 col-6 itembox <?php echo str_replace(' ','',$note_data->note_subject);?>">
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

<script>
           $(document).ready(function(){
               $('.list').click(function(){
                   const value=$(this).attr('data-filter');
                   if(value=='all')
                   {
                       $('.itembox').show('1000');
                   }
                   else
                   {
                       $('.itembox').not('.'+value).hide('1000');
                       $('.itembox').filter('.'+value).show('1000');
                   }
               })
               $('.list').click(function(){
                   $(this).addClass('activegrid').siblings().removeClass('activegrid');
               })
           })
       </script>
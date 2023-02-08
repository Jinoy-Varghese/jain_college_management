<?php
	header("Pragma: no-cache");
	header("Cache-Control: no-cache");
	header("Expires: 0");
    

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
.detail-view {
    animation: animate 0.3s linear 1;
}

@keyframes animate {
    0% {
        opacity: 0;
    }

    100% {
        opacity: 1;
    }
}

.b {
    display: inline-block;
    width: 114px;
}

.colan {
    display: inline-block;
    width: 15px;
}

.custom-button {

    color: #007BFF;
    text-decoration: none;

}

.custom-button:hover {
    color: white;
    background: #007BFF;
    cursor: pointer;
}
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
    integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous">
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<meta name="GENERATOR" content="Evrsoft First Page">



<div class="container" class="col-sm-12"><br>

    <nav aria-label="breadcrumb mt-sm-5">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Fee Payment</li>

        </ol>
    </nav>


    <div class="row mt-5">
        <div class="vid-out mt-md-4 col-md-5">
            <video autoplay="true" id="videoElement" class=" col-md-11 mt-md-4 pl-2 pr-2 shadow"></video>
        </div>
        <div class="col-md-6 mt-md-4 pt-4">




            <table id="table" data-show-export="true" data-toolbar="#toolbar" data-search="true" data-sortable="true"
                data-show-columns="true" data-toggle="table" data-pagination="true" class="table"
                data-visible-search="true">
                <thead class="table-primary">
                    <tr>
                        <th data-field="#" data-sortable="true">#</th>
                        <th data-field="Semester" data-sortable="true">Semester</th>
                        <th data-field="Amount" data-sortable="true">Amount</th>
                        <th data-field="edit">Action</th>
                    </tr>
                </thead>
                <tbody>
<?php 
  $i=1;
  $k=1;

  $id=$_SESSION['u_id'];
  $this->db->select('*');
  $this->db->from('users');
  $this->db->join('student_data','student_data.email=users.email');
  $this->db->where('users.email',$id);
  $sql=$this->db->get();
  foreach($sql->result() as $user_data)
  {
    $current_sem=$user_data->s_sem;
    $current_course=$user_data->s_course;
  }
  $sem_array=array();

  $this->db->select('*');
  $this->db->from('fees_paid');
  $this->db->where('paid_by',$id);
  $sql=$this->db->get();
  foreach($sql->result() as $user_data)
  {
  
    $sem_array[$i]=$user_data->sem;

    $i++;
  }
  for($j=1;$j<=substr($current_sem,1,1);$j++)
  {
    $svalue='s'.$j;
    if(array_search($svalue,$sem_array,true))
    {
      
    }
    else
    {

    ?>


                    <tr>
                        <td><?php echo $k; ?></td>
                        <td><?php echo 'Sem '.$j; ?></td>
                        <td>
                            <form method="post" action="pgRedirect">


                                <div style=display:none;>
                                    <input id="ORDER_ID" tabindex="1" maxlength="20" size="20" name="ORDER_ID"
                                        autocomplete="off" value="<?php echo  "ORDS" . rand(10000,99999999)?>">
                                    <input id="CUST_ID" tabindex="2" maxlength="12" size="12" name="CUST_ID"
                                        autocomplete="off" value="<?php echo $_SESSION['u_id'] ?>">
                                    <input id="INDUSTRY_TYPE_ID" tabindex="4" maxlength="12" size="12"
                                        name="INDUSTRY_TYPE_ID" autocomplete="off" value="<?php echo $svalue ?>">
                                    <input id="CHANNEL_ID" tabindex="4" maxlength="12" size="12" name="CHANNEL_ID"
                                        autocomplete="off" value="WEB">
                                </div>


                                <?php
        error_reporting(0);
        $this->db->select('*');
        $this->db->from('fees');
        $this->db->where('course',$current_course);
        $this->db->where('sem',$svalue);
        $sql=$this->db->get();
        foreach($sql->result() as $user_data2)
        {

         $fee=$user_data2->fee;

        }
    ?>



                                <input title="TXN_AMOUNT" tabindex="10" type="number" name="TXN_AMOUNT" value="<?php 
                                if($fee==NULL)
                                {
                                    echo '0';
                                } 
                                else
                                {
                                    echo $fee;
                                }
                                ?>" placeholder=" Amount" style="border:none;" class="ml-2">





                        </td>
                        <td>


                            <input class="btn border-primary col-12 custom-button" value="Pay" type="submit">

                            </form>
                        </td>
                    </tr>
                    <?php
      $k++;
    }
  }
  ?>
                </tbody>
            </table>
        </div>

        </script>
        <style>
        #videoElement {


            height: 250px;
            padding: 0;
            background: url("<?php echo base_url("assets/image/online-payment.gif");?>");
            background-size: cover;
            background-repeat: no-repeat;
        }
        </style>
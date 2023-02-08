<?php
defined('BASEPATH') or exit('No direct script access allowed');
if(!isset($_SESSION['u_id']) OR $_SESSION['role']!="Super Admin")
{
  redirect('Home/login','refresh');
}

?>


<div class="container p-lg-4 ">
    <?php 
if($this->session->flashdata('delete_success')){
 echo '
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Success!</strong>  HOD Removed.
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
    <script src="<?php echo base_url('assets/bootstrap-table/bootstrap-table-export.min.js'); ?>">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous">
    </script>

    <nav aria-label="breadcrumb mt-sm-5">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">All
                Delete HOD
            </li>
        </ol>
    </nav>



    <div class="container" class="col-sm-12">

        <table id="table" data-show-export="true" data-toolbar="#toolbar" data-search="true" data-sortable="true"
            data-show-columns="true" data-toggle="table" data-pagination="true" class="table"
            data-visible-search="true">
            <thead class="table-primary">
                <th data-field="#" data-sortable="true">
                    #
                </th>
                <th data-field="name" data-sortable="true">
                    Name
                </th>
                <th data-field="email" data-sortable="true">
                    E-Mail
                </th>
                <th data-field="semester" data-sortable="true">
                    Department
                </th>
                <th data-field="edit">
                    Action
                </th>

                </tr>
            </thead>
            <tbody>
                <?php 
                    $j=1; 
	                  $this->db->select('*');
                    $this->db->from('hod_data');
                    $this->db->join('users','users.email=hod_data.email');
                    $this->db->where('role','hod');
                    $this->db->where('user_status',1);
                    $sql=$this->db->get();
                    foreach($sql->result() as $hod)
                    {                   
                  ?>
                <tr>
                    <td><?php echo $j;$j++; ?></td>
                    <td><?php echo $hod->name ?>
                    </td>
                    <td><?php echo $hod->email ?>
                    </td>
                    <td><?php echo $hod->dept ?>
                    </td>

                    <td class="text-center p-0">
                        <a href="<?php echo base_url(); ?>Super_admin/delete_hod/<?php echo $hod->id; ?>"><button
                                class='btn btn-danger'>Remove</button></a>
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
    $('#toolbar').find('select').change(function() {
        $table.bootstrapTable(
                'destroy'
            )
            .bootstrapTable({
                exportDataType: $(this)
                    .val(),
                exportTypes: ['json', 'xml', 'csv', 'txt',
                    'sql',
                    'excel',
                    'pdf'
                ],
                columns: [{
                    field: 'state',
                    checkbox: true,
                    visible: $(this).val() ===
                        'selected'
                }]
            })
    }).trigger('change')
})
</script>
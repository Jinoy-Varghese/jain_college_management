<div class="container p-lg-4 ">
    <?php 
if($this->session->flashdata('delete_success')){
 echo '
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Success!</strong>  Image Deleted.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}

?>
<style>
    .containert {
        position: relative;
        width: 50%;
    }

    .a_tag_change {
        cursor: pointer;
        color: inherit;
    }

    .a_tag_change:hover {
        cursor: pointer;
        text-decoration: none;
    }

    .imaget {
        opacity: 1;
        display: block;
        width: 100%;
        height: auto;
        transition: .5s ease;
        backface-visibility: hidden;
    }

    .middlet {
        transition: .5s ease;
        opacity: 0;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        text-align: center;
        cursor: pointer;
    }

    .containert:hover .imaget {
        opacity: 0.3;
    }

    .containert:hover .middlet {
        opacity: 1;
    }

    .textt {
        background-color: red;
        color: white;
        font-size: 16px;
        padding: 16px 32px;
        cursor: pointer;
    }



    .thumb {
        margin-bottom: 30px;
    }

    .page-top {
        margin-top: 85px;
    }


    img.zoom {
        width: 100%;
        height: 200px;
        border-radius: 5px;
        object-fit: cover;
        -webkit-transition: all .3s ease-in-out;
        -moz-transition: all .3s ease-in-out;
        -o-transition: all .3s ease-in-out;
        -ms-transition: all .3s ease-in-out;
    }


    .transition {
        -webkit-transform: scale(1.2);
        -moz-transform: scale(1.2);
        -o-transform: scale(1.2);
        transform: scale(1.2);
    }

    .content-item {
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.15);
        transition: 0.4s;
    }

    .content-item:hover {
        transform: translate(0, -3px);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
    }

    .a_tag_change {
        cursor: context-menu;
        color: inherit;
    }

    .a_tag_change:hover {
        cursor: context-menu;
        text-decoration: none;
    }
    </style>
    <div class="container p-lg-4 ">
        <nav aria-label="breadcrumb mt-sm-5">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">View Gallery
                </li>
            </ol>
        </nav>
        <div className="row col-12 mt-5 pt-5 ml-0 pb-4 border">
            <div class="container mt-5">
                <div class="row">
                    <?php
                        $this->db->select('*');
                        $this->db->from('gallery');
                        $sql=$this->db->get();
                        foreach($sql->result() as $image)
                        {
                    ?>

                    <div class="col-lg-3 col-md-4 col-xs-6 thumb containert">
                        <a href="<?php echo base_url($image->img_file); ?>" class="fancybox" rel="ligthbox"
                            target="_blank">
                            <img src="<?php echo base_url($image->img_file); ?>" class="zoom img-fluid imaget" alt="" />
                        </a>
                        <div class="middlet">
                            <a href="<?php echo site_url(); ?>Super_admin/delete_image/<?php echo $image->id; ?>"
                                class="a_tag_change">
                                <div class="textt rounded">Delete</div>
                            </a>
                        </div>
                    </div>

                    <?php 
                        }
                    ?>

                </div>
            </div>
        </div>
    </div>
    <script>
    $(document).ready(function() {
        $(".zoom").hover(function() {
            $(this).addClass('transition');
        }, function() {
            $(this).removeClass('transition');
        });
    });
    </script>
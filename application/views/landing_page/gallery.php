<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<h1 class="font-weight-bold text-center mt-2">GALLERY</h1>
<hr>


<div class="container p-lg-4 ">

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
        width:110%;
        top: 95%;
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
        background-color: #3c3c3c;
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
        <div className="row col-12 mt-5 pt-5 pb-4 border">
            <div class="container mt-5">
                <div class="row">
                    <?php
                        $this->db->select('*');
                        $this->db->from('gallery');
                        $sql=$this->db->get();
                        foreach($sql->result() as $image)
                        {
                    ?>

                    <div class="col-lg-3 col-md-4 col-xs-12 thumb containert">
                        <a href="<?php echo base_url($image->img_file); ?>" class="fancybox" rel="ligthbox"
                            target="_blank">
                            <img src="<?php echo base_url($image->img_file); ?>" class="zoom img-fluid imaget" alt="" />
                        </a>
                        <div class="middlet">
                                <div class="textt rounded"><?php echo $image->title;?></div>
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
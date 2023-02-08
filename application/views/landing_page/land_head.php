<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html amp lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/png" href="<?php echo base_url('assets/image/marthoma.png'); ?>" />
    <script async src="https://cdn.ampproject.org/v0.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


    <script type="application/ld+json">
    {

        "image": [
            "logo.jpg"
        ]
    }
    </script>
    <style>
    ::-webkit-scrollbar {
        display: none;
    }
    </style>
    <title>MTCST</title>
    <meta name="description" content="Mar Thoma College of Science & Technology provides a number of courses as follows : ">
    <link rel="stylesheet" href="<?php echo base_url('assets/fontawesome-5.11.2/css/all.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap-4.3.1/css/bootstrap.min.css'); ?>">
</head>
<?php date_default_timezone_set('Asia/Kolkata'); ?>
<body>
<nav class="navbar navbar-expand-lg navbar-light sticky-top bg-primary">
        <div class="row p-0 m-0 col-md-2 col-8" href="#">
        <div class="col-3 ">
            <img src="<?php echo base_url('assets/image/logo_crop.png');?>" class="pt-0 m-0" style="width:36px;height:37px" />
        </div>
            <div class="text-white h4 pt-1 pl-1 col-6 custom-font"> MTCST</div>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav  ">
                <li class="nav-item active">
                    <a class="nav-link text-white custom-font" href="<?php echo base_url('Home/'); ?>">Home</a>
                </li>
                <li class="nav-item mr-3">
                    <a class="nav-link text-white custom-font" href="<?php echo base_url('Home/login'); ?>">Login</a>
                </li>

            </ul>
            <form class="form-inline my-2 my-lg-0" method="get" action="<?php echo base_url('/Home/search'); ?>">
                <input class="form-control mr-sm-2 search-input" type="search" placeholder="Search..." aria-label="Search" name="s" />
                <button class="btn btn-outline-light my-2 my-sm-0 custom-search-outline pt-2 pb-2" type="submit"><i class="fas fa-search custom-search"></i></button>
            </form>
        </div>
    </nav>
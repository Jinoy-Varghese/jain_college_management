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


    <script type="application/ld+json">
    {

        "image": [
            "logo.jpg"
        ]
    }
    </script>
    <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
    <title>MTCST</title>
    <link href="<?php echo base_url('assets/css/loader.css'); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('assets/fontawesome-5.11.2/css/all.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap-4.3.1/css/bootstrap.min.css'); ?>">
</head>

<body>
    <div class="loader"
        style="position:absolute;z-index:10; background: #275EFE;width:100%;height:100vh;justify-content:center;align-items:center;display:flex;">
        <div class="book">
            <div class="inner">
                <div class="left"></div>
                <div class="middle"></div>
                <div class="right"></div>
            </div>
            <ul>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>
    </div>
    <?php date_default_timezone_set('Asia/Kolkata'); ?>
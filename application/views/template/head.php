<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Registro de Contratos</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
    <!--        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/app_style/bancoi.css">-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/app_style/bancoi.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/out_border.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets//bootstrap/css/font-awesome.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/datatable/css/dataTables.bootstrap.min.css">
    <!-- <link rel="stylesheet" href="<?php echo base_url() ?>assets/datepicker/datepicker3.css"> -->
    <!-- Select Multiples-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/dist-select/css/bootstrap-select.min.css') ?>">
    <!-- tableexport-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/tableexport/css/tableexport.css') ?>">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/morris/morris.css') ?>">


    <style>
        body {
            padding-top: 70px;
        }

        .toolbar,
        .toolbar1 {
            float: left;
        }

        .chart canvas {
            position: absolute;
        }

        .chart {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 160px;
            font-size: x-large;
            font-weight: bold;
            /* background: pink; */

        }

        /*            .pointer {
                            cursor: pointer;
                        }*/
        /*.toolbar,.toolbar1 { float: left;}*/
    </style>



</head>


<body>
    <div class="container-fluid">
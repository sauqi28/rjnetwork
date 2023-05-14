<!DOCTYPE html>
<html lang="en">

<head>
  <!-- <meta charset="utf-8" />
    <title> | Hyper - Responsive Bootstrap 5 Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    App favicon
    <link rel="shortcut icon" href="assets/images/favicon.ico"> -->

  <meta charset="utf-8" />
  <title>RJNetwork Manajemen Sistem</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta content="Logistic" name="description" />
  <meta content="" name="author" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />

  <!-- App favicon -->
  <link rel="shortcut icon" href="<?php echo base_url('assets/images/antares_2.png'); ?>">
  <!-- <link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.ico'); ?>"> -->
  <style>
    /* Import Ubuntu font from Google Fonts */
    @import url('https://fonts.googleapis.com/css2?family=Ubuntu&display=swap');

    /* Use Ubuntu font for all elements */
    * {
      font-family: 'Ubuntu', sans-serif;
    }
  </style>
  <link href="<?php echo base_url('assets/plugins/sweet-alert2/sweetalert2.min.css'); ?>" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url('assets/plugins/animate/animate.min.css'); ?>" rel="stylesheet" type="text/css" />

  <!-- App css -->
  <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url('assets/css/icons.min.css'); ?>" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url('assets/css/app.min.css'); ?>" rel="stylesheet" type="text/css" />
  <!-- CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css" integrity="sha512-ARJR8wbvt7irK2nnQQaX9GqhE4t4v7gugoLZt+tDZwI2Wb2UBh3A0yjj5X5B5Rc8Ovz0pYFwXdD6UwI6g67E6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js" integrity="sha512-6GUp2/ui0lo2klBb0Tpsb+JpGZO9Xb0C0uIfzBkpk6ZwY6JlU6RJM8aIBpVa6yFpd9XJH6QxU6g3U1MnBfCBBw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <style>
    .table thead {
      background-color: #FFFFFF;
      /* warna putih */
      font-weight: bold;
      /* membuat header tabel tebal */
    }

    .table td,
    .table th {
      font-size: 11px;
      padding: 5px;
      font-family: 'Ubuntu', sans-serif;
    }

    .table tr:nth-child(odd) {
      background-color: #FFFFFF;
      /* warna abu-abu muda */
    }

    .table tr:nth-child(even) {
      background-color: #F9F9F9;
      /* warna abu-abu agak muda */
    }

    .table th {
      text-align: left;
    }
  </style>




</head>

<body id="body" class="dark-sidebar">
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>
      <?php /** @var array $payload */
      echo $payload['title']; ?>
  </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="<?php echo URL_ROOT; ?>/public/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/assets/css/animate.css" />
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/assets/css/w3.css" />
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/assets/css/bootstrap-fs-modal.css" />
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/assets/css/bootstrap-select.css" />
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/assets/css/adminlte.css" />
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/assets/css/adminlte-miscellaneous.css" />
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/assets/css/box-widget.css" />
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/assets/css/datatables.min.css" />
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/assets/css/jquery.daterange.css" />
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/assets/css/jquery.fileupload-noscript.css" />
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/assets/css/jquery.fileupload.css" />
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/assets/css/font-awesome.css" />
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/assets/css/all.css" />
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/assets/css/v4-shims.min.css" />
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/assets/flaticon/flaticon.css" />
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/assets/fontastic/styles.css" />
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/assets/css/fonts.css" />
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/assets/css/pignose.calendar.css" />
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/assets/css/jquery-toast.min.css"/>
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/assets/css/jquery-toast.min.css"/>
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/assets/css/kendo/kendo.common-bootstrap.min.css"/>
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/assets/css/kendo/kendo.bootstrap.min.css"/>
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/assets/css/kendo/kendo.mobile.all.min.css"/>
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/assets/css/kendo/kendo.default.min.css"/>
    <link rel="stylesheet" href="<?php echo URL_ROOT ?>/public/assets/css/shards.min.css">
    <link rel="stylesheet"
          href="<?php echo URL_ROOT; ?>/public/custom-assets/css/custom.css?<?php echo microtime(); ?>"/>
    <link rel="stylesheet" media="print"
          href="<?php echo URL_ROOT; ?>/public/custom-assets/css/print.css?<?php echo microtime(); ?>"/>
</head>

<body class="hold-transition sidebar-mini sidebar-collapse">
<div class="wrapper" id="list-container">
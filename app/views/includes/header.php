<!DOCTYPE html>
<html title="Adamus CMS" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>
      <?php /** @var array $payload */ echo $payload['title']; ?>
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="<?php echo URL_ROOT; ?>/public/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/assets/css/animate.css" />
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/assets/css/w3.css" />
    <link rel="stylesheet" media="all" href="<?php echo URL_ROOT; ?>/public/assets/css/adminlte.css"/>
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/assets/css/bootstrap-select.css" />
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/assets/css/adminlte-miscellaneous.css" />
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/assets/css/box-widget.css" />
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/assets/css/font-awesome.css" />
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/assets/css/all.css" />
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/assets/css/v4-shims.min.css" />
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/assets/css/fonts.css" />
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
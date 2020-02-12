<?php session_start();

if (isset($_SESSION['usertype']) && $_SESSION['usertype'] == "Admin") {
  header("Location: ../_admin/dashboard.php");
  exit();
} elseif (!isset($_SESSION['usertype'])) {
  header("Location: ../index.php");
  exit();
}

$alert="";
if(isset($_SESSION['error'])){
  $alert = "
  <div class='box-body'>
    <div class='alert alert-danger alert-dismissible'>
      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
      <h4><i class='icon fa fa-warning'></i> Error!</h4>
      ".$_SESSION['error']."
    </div>
  </div>
  ";
  unset($_SESSION['error']);
}
if(isset($_SESSION['success'])){
  $alert = "
  <div class='box-body'>
    <div class='alert alert-success alert-dismissible'>
      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
      <h4><i class='icon fa fa-check'></i> Success!</h4>
      ".$_SESSION['success']."
    </div>
  </div>
  ";
  unset($_SESSION['success']);
}

include "../db.php";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Baysic Bank</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../AdminLTE/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../AdminLTE/dist/css/skins/_all-skins.min.css">
  <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"> -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap.min.css">
  
  <!-- Morris chart -->
  <!-- <link rel="stylesheet" href="bower_components/morris.js/morris.css"> -->
  <!-- jvectormap -->
  <!-- <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css"> -->
  <!-- Date Picker -->
  <!-- <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css"> -->
  <!-- Daterange picker -->
  <!-- <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css"> -->
  <!-- bootstrap wysihtml5 - text editor -->
  <!-- <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css"> -->

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="idebar-mini skin-green sidebar-collapse">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>B</b>B</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Baysic</b> Bank</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Account <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="profile.php">Profile</a></li>
            <li><a href="password.php">Change Password</a></li>
            <li class="divider"></li>
            <li><a href="../logout.php">Log Out</a></li>
          </ul>
        </li>
      </ul>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../AdminLTE/dist/img/avatar5.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?=$_SESSION['name']?></p>
          <a href="#">Last Login: <?=$_SESSION['lastlogin']?></a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li>
          <a href="dashboard.php">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li>
          <a href="accounts.php">
            <i class="fa fa-credit-card"></i> <span>Accounts</span>
          </a>
        </li>
        <li>
          <a href="transactions.php">
            <i class="fa fa-list-alt"></i> <span>Transactions</span>
          </a>
        </li>
        <li>
          <a href="benificiaries.php">
            <i class="fa fa-users"></i> <span>Benificiaries</span>
          </a>
        </li>
        <li>
          <a href="transfer.php">
            <i class="fa fa-money"></i> <span>Transfer Money</span>
          </a>
        </li>
        <li>
          <a href="bill.php">
            <i class="fa fa-bolt"></i> <span>Pay a Bill</span>
          </a>
        </li>
    </section>
    <!-- /.sidebar -->
  </aside>


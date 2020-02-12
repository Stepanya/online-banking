<?php include "_includes/header.php";?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?=$_SESSION['usertype']?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Change Password</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

<?=$alert?>
<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Change Password</h3>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
  <div class="box-body">
    <div class="row">
      <form method="POST" action="password_change.php">
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label">New Password </label>
            <input type="password" class="form-control" required name="pass">

            <label class="control-label">Confirm Password </label>
            <input type="password" class="form-control" required name="cpass">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label">Current Password </label>
            <input type="password" class="form-control" required name="curpass">
          </div>
          <input type="hidden" name="id" value="<?=$_SESSION['id']?>">
        </div>
    </div>
  </div>
  <div class="box-footer">
    <button type="submit" class="btn btn-success btn-flat" name="change"><i class="fa fa-check"></i> Change Password</button>
    </form>
  </div>
</div>

<?php include "_includes/footer.php";?>
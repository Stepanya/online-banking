<?php include "_includes/header.php";?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?=$_SESSION['usertype']?>
        <small>Dashboard</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Client registration</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

<?=$alert?>
<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Client Registration</h3>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
  <form action="registration_controller.php" method="POST" class="form-horizontal">
    <div class="box-body">
      <div class="form-group">
        <label class="col-sm-2 control-label">First Name <small><span class="label label-danger">*</span></small></label>

        <div class="col-sm-4">
          <input type="text" class="form-control" placeholder="Enter First Name" name="fname" required>
        </div>

        <label class="col-sm-2 control-label">Contact # <small><span class="label label-danger">*</span></small></label>

        <div class="col-sm-4">
          <input type="text" class="form-control" placeholder="Enter Contact Number" name="ctn" required>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Last Name <small><span class="label label-danger">*</span></small></label>

        <div class="col-sm-4">
          <input type="text" class="form-control" placeholder="Enter Last Name" name="lname" required>
        </div>

        <label class="col-sm-2 control-label">Address <small><span class="label label-danger">*</span></small></label>

        <div class="col-sm-4">
          <input type="text" class="form-control" placeholder="Enter Address" name="add" required>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Middle Initial <small><span class="label label-danger">*</span></small></label>

        <div class="col-sm-1">
          <input type="text" class="form-control" placeholder="M.I" name="mi" required>
        </div>

        <label class="col-sm-5 control-label">Date Of Birth <small><span class="label label-danger">*</span></small></label>

        <div class="col-sm-4">
          <input type="date" class="form-control" max="2000-01-01" value="2000-01-01" name="dob" required>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Username <small><span class="label label-danger">*</span></small></label>

        <div class="col-sm-4">
          <input type="text" class="form-control" placeholder="Enter Username" name="uname" required>
        </div>

        <!-- <label class="col-sm-2 control-label" >Pin Code</label>

        <div class="col-sm-2">
          <input type="text" class="form-control pin-code" readonly="" name="pin">
        </div>

        <div class="col-sm-2">
          <button type="button" class="btn btn-success gen-pin">Generate Pin</button>
        </div> -->
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Password <small><span class="label label-danger">*</span></small></label>

        <div class="col-sm-4">
          <input type="password" class="form-control" placeholder="Enter Password" name="pass" pattern=".{8,}"   required title="8 characters minimum">
        </div>
        <label class="col-sm-2 control-label">Confirm Password <small><span class="label label-danger">*</span></small></label>

        <div class="col-sm-4">
          <input type="password" class="form-control" placeholder="Confirm Password" name="cpass" pattern=".{8,}"   required title="8 characters minimum">
        </div>
      </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      <button type="submit" class="btn btn-info pull-right" name="reg-submit">Submit</button>
    </div>
    <!-- /.box-footer -->
  </form>
</div>

<?php include "_includes/footer.php";?>

<script type="text/javascript">
  $(".gen-pin").click(function() {
    var pin = Math.floor(100000 + Math.random() * 900000);

    $(".pin-code").val(pin);
  });
</script>
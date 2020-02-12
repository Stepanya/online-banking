<?php include "_includes/header.php";?>
<!-- Content Wrapper. Contains page content -->
<?php
include "../db.php";
$result = $con->query("SELECT * FROM admin WHERE id = {$_SESSION['id']}");
$row = $result->fetch_assoc();
$id = $row['id'];
$fname = $row['fname'];
$lname = $row['lname'];
$mi = $row['mi'];
$dob = $row['dob'];
$add = $row['address'];
$ctn = $row['contact'];
$uname = $row['username'];
$login = date("M d, Y h:s A", strtotime($row['lastlogin']));
?>
  <div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?=$_SESSION['usertype']?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

<?=$alert?>
<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Your Profile</h3>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
  <div class="box-body">
    <form method="POST" action="profile_edit.php">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <input type="hidden" name="id" value="<?=$id?>">
            <label class="control-label">First Name </label>
            <input type="text" class="form-control" disabled value="<?=$fname?>" id="fname" name="fname">
        
            <label class="control-label">Last Name </label>
            <input type="text" class="form-control" disabled value="<?=$lname?>" id="lname" name="lname">

            <label class="control-label">M.I </label> 
            <input type="text" class="form-control" disabled value="<?=$mi?>" id="mi" name="mi">

            <label class="control-label">Date of Birth </label> 
            <input type="date" max="2003-01-01" class="form-control" disabled value="<?=$dob?>" id="dob" name="dob">

            <label class="control-label">Contact # </label> 
            <input type="text" class="form-control" disabled value="<?=$ctn?>" id="ctn" name="ctn">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label">Address </label> 
            <textarea class="form-control" cols="5" disabled id="add" name="add"><?=$add?></textarea>

            <label class="control-label">Username </label> 
            <input type="text" class="form-control" disabled value="<?=$uname?>" id="uname" name="uname">

            <label class="control-label">Last Login </label> 
            <input type="text" class="form-control" disabled value="<?=$login?>">
          </div>

          <div class="form-group">
            <button type="button" class="btn btn-success btn-flat edit" name="edit"><i class="fa fa-check-square-o"></i> Edit</button>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>

<?php include "_includes/footer.php";?>

<script type="text/javascript">
  $(".edit").click(function() {
    if ($(this).text() == "Save Changes") {
      $('form').submit();
    }
    $(this).text("Save Changes");
    $("#fname").prop("disabled", false);
    $("#lname").prop("disabled", false);
    $("#mi").prop("disabled", false);
    $("#dob").prop("disabled", false);
    $("#ctn").prop("disabled", false);
    $("#add").prop("disabled", false);
    $("#uname").prop("disabled", false);
  });
</script>
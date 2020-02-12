<?php include "_includes/header.php";?>
<!-- Content Wrapper. Contains page content -->
<?php
include "../db.php";
$result = $con->query("SELECT * FROM users WHERE id = {$_SESSION['id']}");
$row = $result->fetch_assoc();
$fname = $row['fname'];
$lname = $row['lname'];
$mi = $row['mi'];
$dob = $row['dob'];
$add = $row['address'];
$ctn = $row['contact'];
$uname = $row['username'];
$login = date("M d, Y h:s A", strtotime($row['lastlogin']));
$stat = $row['status'];
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
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label">First Name </label>
          <input type="text" class="form-control" disabled value="<?=$fname?>">
      
          <label class="control-label">Last Name </label>
          <input type="text" class="form-control" disabled value="<?=$lname?>">

          <label class="control-label">M.I </label> 
          <input type="text" class="form-control" disabled value="<?=$mi?>">

          <label class="control-label">Date of Birth </label> 
          <input type="text" class="form-control" disabled value="<?=$dob?>">

          <label class="control-label">Contact # </label> 
          <input type="text" class="form-control" disabled value="<?=$ctn?>">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label">Address </label> 
          <textarea class="form-control" cols="5" disabled><?=$add?></textarea>

          <label class="control-label">Username </label> 
          <input type="text" class="form-control" disabled value="<?=$uname?>">

          <label class="control-label">Last Login </label> 
          <input type="text" class="form-control" disabled value="<?=$login?>">

          <label class="control-label">Status </label> 
          <input type="text" class="form-control" disabled value="<?=$stat?>">
        </div>
      </div>
    </div>
  </div>
  <div class="box-footer">
    <p class="text-red">* If the above informatoin is incorrect, please go to the nearest branch in your area.</p>
  </div>
</div>

<?php include "_includes/footer.php";?>

<script type="text/javascript">
  

</script>
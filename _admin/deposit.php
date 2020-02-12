<?php include "_includes/header.php";
      include "_includes/deposit_modal.php";?>
<!-- Content Wrapper. Contains page content -->
<?php 
include "../db.php";
$acc = $con->query("SELECT * FROM accounts WHERE user_id = {$_SESSION['id']}");
$ben = $con->query("SELECT * FROM benificiaries WHERE username = '{$_SESSION['uname']}'");

?>
  <div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?=$_SESSION['usertype']?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Deposit Money</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

<?=$alert?>
<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Deposit Money</h3>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
  <div class="box-body">
    <div class="row">
      <form id="deposit">
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label">Enter Account Number</label>
            <input type="text" class="form-control" required id="accno">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label">Deposit Amount </label>

            <div class="input-group">
              <span class="input-group-addon">&#8369;</span>
              <input type="number" class="form-control" min="100" id="famount" required>
              <span class="input-group-addon">.00</span>
            </div>
          </div>
        </div>
    </div>
  </div>
  <div class="box-footer">
    <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-money"></i> Deposit Money</button>
    </form>
  </div>
</div>

<?php include "_includes/footer.php";?>

<script type="text/javascript">
  $("#deposit").submit(function(e) {
    e.preventDefault();
    $("#acc").text($("#accno").val());
    $("#peso").text("Php "+$("#famount").val()+".00");
    $("#accno2").val($("#accno").val());
    $("#amount").val($("#famount").val());
    $("#confirm").modal('show');
  });

</script>
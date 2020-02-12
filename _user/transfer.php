<?php include "_includes/header.php";
      include "_includes/transfer_modal.php";?>
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
        <li class="active">Transfer Money</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

<?=$alert?>
<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Transfer Money</h3>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
  <div class="box-body">
    <div class="row">
      <form id="transfer">
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label">Select an Account </label>
            <select class="form-control" id="you" required>
              <option disabled>-- Select Account --</option>
              <?php 
              while ($row = $acc->fetch_assoc()) { ?>
              
              <option value="<?=$row['account_no']?>"><?=$row['type'].' - '.$row['account_no']?></option> 
               <?php } ?>
            </select>
        
            <label class="control-label">Select a Benificiary </label>
            <select class="form-control" id="ben" required>
              <option disabled>-- Select Benificiary --</option>
              <?php 
              while ($row = $ben->fetch_assoc()) { ?>
              
              <option value="<?=$row['account_no']?>"><?=$row['nickname'].' - '.$row['account_no']?></option> 
               <?php } ?>
            </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label">Transfer Amount </label>

            <div class="input-group">
              <span class="input-group-addon">&#8369;</span>
              <input type="number" class="form-control" min="100" id="famount" required>
              <span class="input-group-addon">.00</span>
            </div>

            <label class="control-label">6 Digit Pin Code</label> 
            <input type="password" class="form-control" required maxlength="6" id="code">
          </div>
        </div>
    </div>
  </div>
  <div class="box-footer">
    <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-send"></i> Send Money</button>
    </form>
  </div>
</div>

<?php include "_includes/footer.php";?>

<script type="text/javascript">
  $("#transfer").submit(function(e) {
    e.preventDefault();
    $("#acc").text($("#ben option:selected").text());
    $("#peso").text("Php "+$("#famount").val()+".00");
    $("#sender").val($("#you").val());
    $("#receiver").val($("#ben").val());
    $("#pin").val($("#code").val());
    $("#amount").val($("#famount").val());
    $("#confirm").modal('show');
  });

</script>
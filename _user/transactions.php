<?php 
include "_includes/header.php";

$accno = (isset($_GET['accno']) ? $_GET['accno'] : "");
$desc = (isset($_GET['desc']) ? $_GET['desc'] : "Funds Transfer");
$types = array('Funds Transfer', 'Bills Payment');
$bth = "";

if ($desc == "Bills Payment") {
  $bth = '<th>Bill Reference #</th>
          <th>Status</th>';
}
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?=$_SESSION['usertype']?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Transactions</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

<?=$alert?>
<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Transactions</h3><hr>
    <div class="form-group">
        <div class="col-sm-3">
          <label class="control-label">Select Account Number</label>
          <select class="form-control" id="accno">
          <?php
            $result = $con->query("SELECT * FROM accounts WHERE user_id = {$_SESSION['id']}");
            while ($row = $result->fetch_assoc()) {
            $accno = ($accno == "" ? $row['account_no'] : $accno); 
          ?> 
            <option value="<?=$row['account_no']?>" <?=($accno == $row['account_no'] ? "selected" : "")?>>
              <?=$row['account_no'].' - '.$row['type']?></option>
          <?php } ?>
          </select>  
        </div>

        <div class="col-sm-3">
          <label class="control-label">Select Transaction Type</label>
          <select class="form-control" id="desc">
          <?php foreach ($types as $val) {
            $selected = ($desc == $val ? "selected" : ""); 
            echo "<option value='$val' $selected> $val </option>";
          } ?>
          </select>  
        </div>  
        <br><br><hr>
        <div class="col-sm-1">
          <button class="btn btn-primary btn-flat fa fa-filter filter"> Filter</button>
        </div>
        <div class="col-sm-1">
          <button class="btn btn-success btn-flat fa fa-print print"> Print</button>
        </div>
      </div>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
    <div class="box-body">

      <table class="table table-bordered table-striped dataTable" role="grid">
        <thead>
          <th>Account Number</th>
          <th>Benificiary</th>
          <th>Description</th>
          <th>Amount</th>
          <th>Balance After Transaction</th>
          <th>Date</th>
          <?=$bth?>
        </thead>
        <tbody>
          <?php
          $query = "";

          if ($desc == "Bills Payment") {
            $query = "SELECT * FROM transactions 
                                WHERE description = '$desc'
                                AND account_no = '$accno'
                                ORDER BY date DESC";
          } else {
            $query = "SELECT * FROM transactions 
                                WHERE description = '$desc'
                                AND account_no = '$accno'
                                OR beneficiary = '$accno'
                                ORDER BY date DESC";
          }
          $result = $con->query($query);
          while ($row = $result->fetch_assoc()) { ?>
          
          <tr>
            <td><?=$row['account_no']?></td>
            <td><?=$row['beneficiary']?></td>
            <td><?=$row['description']?></td>
            <td><?=$row['amount']?></td>
            <td><?=($row['beneficiary'] == $accno ? $row['bal_after_to'] : $row['bal_after_from'])?></td>
            <td><?=date('M d, Y h:i A', strtotime($row['date']))?></td>
            <?=($desc == "Bills Payment" ? "<td>{$row["bill_ref"]}</td> <td>{$row["status"]}</td>" : "")?>
          </tr>

          <?php  
          } ?>
        </tbody>
      </table>
    </div>
</div>
<?php include "_includes/footer.php";?>

<script type="text/javascript">
  $(".table").dataTable();

  $('.filter').click(function(){
    var accno = $("#accno").val();
    var desc = $("#desc").val();

    window.location.href = "transactions.php?accno="+accno+"&desc="+desc;
  });

  $('.print').click(function(){
    var accno = $("#accno").val();
    var desc = $("#desc").val();

    window.open("transactions_print.php?accno="+accno+"&desc="+desc);
  });


</script>
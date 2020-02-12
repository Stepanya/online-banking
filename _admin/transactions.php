<?php 
include "_includes/header.php";

$yr = (isset($_GET['yr']) ? $_GET['yr'] : date('Y'));
$month = (isset($_GET['month']) ? $_GET['month'] : date('m'));
$accno = (isset($_GET['accno']) ? $_GET['accno'] : "");
$desc = (isset($_GET['desc']) ? $_GET['desc'] : "Funds Transfer");
$types = array('Funds Transfer', 'Bills Payment');
$bth = $title = "";

if ($desc == "Bills Payment" || isset($_GET['all'])) {
  $bth = '<th>Bill Reference #</th>
          <th>Status</th>';
}

if (isset($_GET['all'])) {
    $title = "All Transactions";
} else {
    $title = "$desc Transactions in ".date("M, Y", strtotime("$yr-$month"));
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
    <h3 class="box-title">Transactions</h3><br>
    <h3 class="box-title"><?=$title?></h3><hr>
    <div class="form-group">
        <div class="col-sm-3">
          <label class="control-label">Select Account Number</label>
          <select class="form-control" id="accno">
            <option value="">-- Do not select --</option>
          <?php
            $result = $con->query("SELECT * FROM accounts");
            while ($row = $result->fetch_assoc()) {
          ?> 
            <option value=" AND account_no = '<?=$row['account_no']?>'" <?=($accno == $row['account_no'] ? "selected" : "")?>>
              <?=$row['account_no'].' - '.$row['type'].' => '.$row['fname'].' '.$row['mi'].', '.$row['lname']?></option>
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
        <div class="col-sm-3">
          <label class="control-label">Select Month</label>
          <select class="form-control" id="month">
            <option value="01">Jan</option>
            <option value="02">Feb</option>
            <option value="03">Mar</option>
            <option value="04">Apr</option>
            <option value="05">May</option>
            <option value="06">Jun</option>
            <option value="07">Jul</option>
            <option value="08">Aug</option>
            <option value="09">Sep</option>
            <option value="10">Oct</option>
            <option value="11">Nov</option>
            <option value="12">Dec</option>
          </select>  
        </div>
        <div class="col-sm-3">
          <label class="control-label">Select Year</label>
          <select id="yr" class="form-control">
              <?php
                  for($i=2019; $i<=2065; $i++){
                    $selected = ($i==$year)?'selected':'';
                    echo "
                      <option value='".$i."' ".$selected.">".$i."</option>
                    ";
                  }
              ?>
          </select>
        </div>  
        <br><br><hr>
        <div class="col-sm-1">
          <button class="btn btn-primary btn-flat fa fa-filter filter"> Filter</button>
        </div>
        <div class="col-sm-2">
          <button class="btn btn-primary btn-flat fa fa-eye all"> Show All</button>
        </div>
        <div class="col-sm-2">
          <button class="btn btn-success btn-flat fa fa-print print"> Print Filtered</button>
        </div>
        <div class="col-sm-1">
          <button class="btn btn-success btn-flat fa fa-print printall"> Print All</button>
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

          if (isset($_GET['all'])) {
            $query = "SELECT * FROM transactions";
          } elseif ($desc == "Bills Payment") {
            $query = "SELECT * FROM transactions 
                                WHERE description = '$desc'
                                $accno
                                AND MONTH(date) = '$month'
                                AND YEAR(date) = '$yr' 
                                ORDER BY date DESC";
          } else {
            $query = "SELECT * FROM transactions 
                                WHERE description = '$desc'
                                $accno
                                AND MONTH(date) = '$month'
                                AND YEAR(date) = '$yr'
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
            <?=($desc == "Bills Payment" || isset($_GET['all']) ? "<td>{$row["bill_ref"]}</td> <td>{$row["status"]}</td>" : "")?>
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

  $('.filter').click(function() {
    var accno = $("#accno").val();
    var desc = $("#desc").val();
    var month = $("#month").val();
    var yr = $("#yr").val();

    window.location.href = "transactions.php?accno="+accno+"&desc="+desc+"&month="+month+"&yr="+yr;
  });

  $('.all').click(function() {
    window.location.href = "transactions.php?all";
  });

  $('.print').click(function() {
    var accno = $("#accno").val();
    var desc = $("#desc").val();
    var month = $("#month").val();
    var yr = $("#yr").val();

    window.open("transactions_print.php?accno="+accno+"&desc="+desc+"&month="+month+"&yr="+yr);
  });

  $('.printall').click(function() {
   window.open("transactions_print.php?all");
  });

</script>
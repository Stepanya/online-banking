<?php include "_includes/header.php";
      include "_includes/bills_modal.php";
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
        <li class="active">Accounts</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

<?=$alert?>
<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Accounts</h3>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
    <div class="box-body">
      <table class="table table-bordered table-striped dataTable" role="grid">
        <thead>
          <th>Account Name</th>
          <th>Account Number</th>
          <th>Amount</th>
          <th>Balance</th>
          <th>Biller</th>
          <th>Biller Ref #</th>
          <th>Account Status</th>
          <th>Status</th>
          <th>Date Applied</th>
          <th>Tools</th>
        </thead>
        <tbody>
          <?php
          $result = $con->query("SELECT *, t.status AS tstat, a.status AS astat, t.id AS tid
                                          FROM transactions AS t
                                          JOIN accounts AS a
                                            ON t.account_no = a.account_no        
                                          WHERE description = 'Bills Payment' 
                                          ORDER BY lname");
          while ($row = $result->fetch_assoc()) { ?>
          
          <tr>
            <td><?="{$row['fname']} {$row['mi']}, {$row['lname']}"?></td>
            <td><?=$row['account_no']?></td>
            <td><?=$row['amount']?></td>
            <td><?=$row['balance']?></td>
            <td><?=$row['beneficiary']?></td>
            <td><?=$row['bill_ref']?></td>
            <td><?=$row['astat']?></td>
            <td><?=$row['tstat']?></td>
            <td><?=$row['date']?></td>
            <td>
              <a class="btn btn-success btn-xs btn-flat approve" role="button" href="#" data-acc-no="<?=$row['account_no']?>" data-id="<?=$row['tid']?>">Approve</a>

              <a class="btn btn-danger btn-xs btn-flat deny" role="button" href="#" data-acc-no="<?=$row['account_no']?>" data-id="<?=$row['tid']?>">Deny</a>
            </td>
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

  $('.table').on('click', '.approve', function(e){
    e.preventDefault();
    $('#confirm').modal('show');
    var accno = $(this).data('acc-no');
    var id = $(this).data('id');
    $("#title").text("APPROVE BILLS PAYMENT"); 
    $("#action").val("Approved");
    $("#accnoh").val(accno);
    $("#accno").text(accno);
    $("#id").val(id);
  });

  $('.table').on('click', '.deny', function(e){
    e.preventDefault();
    $('#confirm').modal('show');
    var accno = $(this).data('acc-no');
    var id = $(this).data('id');
    $("#title").text("DENY BILLS PAYMENT");
    $("#action").val("Denied");
    $("#accnoh").val(accno);
    $("#accno").text(accno);
    $("#id").val(id);
  });

</script>
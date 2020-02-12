<?php include "_includes/header.php";
      include "_includes/accounts_modal.php";
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
  <div class="col">
    <a href="accounts_print.php" role="button" class="btn btn-primary btn-sm btn-flat fa fa-print"> Print</a>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
    <div class="box-body">
      <table class="table table-bordered table-striped dataTable" role="grid">
        <thead>
          <th>First Name</th>
          <th>M.I</th>
          <th>Last Name</th>
          <th>Account Type</th>
          <th>Account Number</th>
          <th>Balance</th>
          <th>Status</th>
          <th>Tools</th>
        </thead>
        <tbody>
          <?php
          $result = $con->query("SELECT * FROM accounts ORDER BY lname");
          while ($row = $result->fetch_assoc()) { ?>
          
          <tr>
            <td><?=$row['fname']?></td>
            <td><?=$row['mi']?></td>
            <td><?=$row['lname']?></td>
            <td><?=$row['type']?></td>
            <td><?=$row['account_no']?></td>
            <td><?=$row['balance']?></td>
            <td><?=$row['status']?></td>
            <td>
              <a class="btn btn-primary btn-xs btn-flat edit" role="button" href="#" data-id="<?=$row['id']?>">Edit</a>

              <a class="btn btn-danger btn-xs btn-flat delete" role="button" href="#" data-id="<?=$row['id']?>">Delete</a>
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

  $('.table').on('click', '.edit', function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $('.table').on('click', '.delete', function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'accounts_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(data){
      $('#id').val(data.id);
      $('#headname').text(data.fname+' '+data.mi+', '+data.lname+' - '+data.account_no);
      $('#fname').val(data.fname);
      $('#lname').val(data.lname);
      $('#mi').val(data.mi);
      $('#type').val(data.type);
      $('#accno').val(data.account_no);
      $('#bal').val(data.balance);
      $('#status').val(data.status);
      $('#del_id').val(data.id);
      $('#del_name').html(data.fname+' '+data.mi+', '+data.lname);
    }
  });
}

</script>
<?php include "_includes/header.php";
      include "_includes/clients_modal.php";
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
        <li class="active">Clients</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

<?=$alert?>
<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Clients</h3>
  </div>
  <div class="col">
    <a href="clients_print.php" role="button" class="btn btn-primary btn-sm btn-flat fa fa-print"> Print</a>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
    <div class="box-body">

      <table class="table table-bordered table-striped dataTable" role="grid">
        <thead>
          <th>First Name</th>
          <th>M.I</th>
          <th>Last Name</th>
          <th>Date of Birth</th>
          <th>Address</th>
          <th>Contact #</th>
          <th>Username</th>
          <th>Last Login</th>
          <th>Status</th>
          <th>Tools</th>
        </thead>
        <tbody>
          <?php
          $result = $con->query("SELECT * FROM users");
          while ($row = $result->fetch_assoc()) { ?>
          
          <tr>
            <td><?=$row['fname']?></td>
            <td><?=$row['mi']?></td>
            <td><?=$row['lname']?></td>
            <td><?=$row['dob']?></td>
            <td><textarea class="form-control" style="resize: none;" readonly><?=$row['address']?></textarea> </td>
            <td><?=$row['contact']?></td>
            <td><?=$row['username']?></td>
            <td><?=$row['lastlogin']?></td>
            <td><?=$row['status']?></td>
            <td>
              <a class="btn btn-success btn-xs btn-flat issue" role="button" href="#" data-id="<?=$row['id']?>">Issue Account</a>
              
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
  $(".gen-pin").click(function() {
    var pin = Math.floor(100000 + Math.random() * 900000);

    $(".pin-code").val(pin);
  });
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

  $('.table').on('click', '.issue', function(e){
    e.preventDefault();
    $('#add_account').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $(".gen-pin").click(function() {
    var pin = Math.floor(100000 + Math.random() * 900000);

    $(".pin-code").val(pin);
  });

  $(".gen-acc-no").click(function() {
    var pin = Math.floor(1000000000 + Math.random() * 9000000000);

    $(".acc-no").val(pin);
  });

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'client_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(data){
      $('#id').val(data.id);
      $('#headname').html(data.fname+' '+data.mi+', '+data.lname+' - '+data.username);
      $('#fname').val(data.fname);
      $('#lname').val(data.lname);
      $('#mi').val(data.mi);
      $('#ctn').val(data.contact);
      $('#dob').val(data.dob);
      $('#add').val(data.address);
      $('#uname').val(data.username);
      $('#status').val(data.status);
      $('#del_id').val(data.id);
      $('#del_name').html(data.fname+' '+data.mi+', '+data.lname);
      $('#acc-id').val(data.id);
      $('#acc-fname').val(data.fname);
      $('#acc-lname').val(data.lname);
      $('#acc-mi').val(data.mi);
      $('#acc-uname').val(data.username)
    }
  });
}

</script>
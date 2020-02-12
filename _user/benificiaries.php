<?php include "_includes/header.php";
      include "_includes/benificiaries_modal.php";
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
        <li class="active">Benificiaries</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

<?=$alert?>
<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Your Benificiaries</h3>
    <br>
    <button class="btn btn-success btn-sm btn-flat add">Add Benificiary</button>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
    <div class="box-body">
      <table class="table table-bordered table-striped dataTable" role="grid">
        <thead>
          <th>Nick Name</th>
          <th>Account Number</th>
          <th>Date Added</th>
          <th>Tools</th>
        </thead>
        <tbody>
          <?php
          $result = $con->query("SELECT * FROM benificiaries WHERE username = '{$_SESSION['uname']}' ORDER BY username");
          while ($row = $result->fetch_assoc()) { ?>
          
          <tr>
            <td><?=$row['nickname']?></td>
            <td><?=$row['account_no']?></td>
            <td><?=date("M d, Y h:i A", strtotime($row['date_added']))?></td>
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

  $('.add').click(function(e) {
    e.preventDefault();
    $('#add').modal('show');
  });
  
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
    url: 'benificiaries_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(data){
      $('#id').val(data.id);
      $('.accno').val(data.account_no);
      $('.nick').val(data.nickname);
      $('#del_id').val(data.id);
      $('#del_name').html(data.nickname+' - '+data.account_no);
    }
  });
}

</script>
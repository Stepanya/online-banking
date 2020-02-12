<?php include "_includes/header.php";
      include "_includes/bill_modal.php";?>
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
        <li class="active">Pay a Bill</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

<?=$alert?>
<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Pay a Bill</h3>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
  <div class="box-body">
    <div class="row">
      <form id="transfer" method="POST" action="bill_pay.php">
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label">Select an Account </label>
            <select class="form-control" id="acc" required name="accno">
              <option disabled>-- Select Account --</option>
              <?php 
              while ($row = $acc->fetch_assoc()) { ?>
              
              <option value="<?=$row['account_no']?>"><?=$row['type'].' - '.$row['account_no']?></option> 
               <?php } ?>
            </select>
        
            <label class="control-label">Select a Biller </label>
            <select class="form-control" id="biller" required name="biller">
              <option disabled>-- Select Biller --</option>
              <optgroup label="Ulitities">
                <option value="Manila Water">Manila Water</option>
                <option value="Maynilad Water Services">Maynilad Water Services</option>
                <option value="Meralco">Meralco</option>
                <option value="Subic Water">Subic Water</option>
                <option value="Visayan Electric Company">Visayan Electric Company</option>
              </optgroup>
              <optgroup label="Telephone / Pager / Cellphone">
                <option value=">Globe Handy Phone">Globe Handy Phone</option>
                <option value="ICC - Bayantel">ICC - Bayantel</option>
                <option value="Innove Globelines">Innove Globelines</option>
                <option value="Philippine long Distance TeleCommunications">Philippine long Distance TeleCommunications</option>
                <option value="PT&T">PT&T</option>
                <option value="SMART / SUN">SMART / SUN</option>
              </optgroup>
              <optgroup label="Cable TV / Internet Providers">
                <option value="Cable Link & Holdings Corp.">Cable Link & Holdings Corp.</option>
                <option value="Innove GlobeQuest (Q-Net)">Innove GlobeQuest (Q-Net)</option>
                <option value="Innove GlobeQuest (Q-Quest)">Innove GlobeQuest (Q-Quest)</option>
                <option value="Planet Cable Inc.">Planet Cable Inc</option>
                <option value="SkyCable (CCATV)">SkyCable (CCATV)</option>
              </optgroup>
              <optgroup label="Credit Card">
                <option>BDO Credit Cards</option>
                <option>Citibank (MC - Visa)</option>
                <option>EastWest Card</option>
                <option>Metrobank (Unicard - Visa)</option>
              </optgroup>
            </select>

            <label class="control-label">Reference # </label>
            <input type="text" class="form-control" required minlength="16" maxlength="16" id="ref" name="refno">

          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label">Amount </label>

            <div class="input-group">
              <span class="input-group-addon">&#8369;</span>
              <input type="number" class="form-control" min="100" id="amount" required name="amount">
              <span class="input-group-addon">.00</span>
            </div>

            <label class="control-label">6 Digit Pin Code</label> 
            <input type="password" class="form-control" required maxlength="6" id="pin" name="pin">
          </div>
        </div>
    </div>
  </div>
  <div class="box-footer">
    <button type="submit" name="pay" class="btn btn-success btn-flat"><i class="fa fa-money"></i> Pay Bill</button>
    </form>
  </div>
</div>

<?php include "_includes/footer.php";?>

<script type="text/javascript">
  $("#transfer").submit(function(e) {
    e.preventDefault();
    $("#biller2").text($("#biller option:selected").text());
    $("#amount2").text("Php "+$("#amount").val()+".00");
    $("#ref2").text($("#ref").val());
    $("#confirm").modal('show');
  });

  $(".pay").click(function() {
    $("#transfer")[0].submit();
  });

</script>
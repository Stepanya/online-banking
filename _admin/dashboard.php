<?php include "_includes/header.php";
include "../db.php";

$result = $con->query("SELECT COUNT(id) AS accs FROM accounts");
$row = $result->fetch_assoc();
$totaccs = $row['accs'];
$result = $con->query("SELECT COUNT(id) AS act FROM users WHERE status = 'Active'");
$row = $result->fetch_assoc();
$totact = $row['act'];
$result = $con->query("SELECT COUNT(id) AS inact FROM users WHERE status = 'Inactive'");
$row = $result->fetch_assoc();
$totinact = $row['inact'];
$result = $con->query("SELECT COUNT(id) AS trans FROM transactions");
$row = $result->fetch_assoc();
$tottrans = $row['trans'];

// $months = [1,2,3,4,5,6,7,8,9,10,11,12];
// $mdata = array("01" => 0, 
//                 "02" => 0,
//                 "03" => 0, 
//                 "04" => 0,
//                 "05" => 0, 
//                 "06" => 0,
//                 "07" => 0, 
//                 "08" => 0,
//                 "09" => 0, 
//                 "10" => 0,
//                 "11" => 0, 
//                 "12" => 0);
// $i=0;
// $result = $con->query("SELECT MONTH(date_issued) AS m FROM accounts");
// while ($row = $result->fetch_assoc()) {
//   echo $row['m'];
//   if ($months[$i] == $row['m']) {
//     $mdata[$i]+=1;
//   }$i++;
// } 
// echo json_encode($mdata);

$months = array();
$accs = array();

for( $m = 1; $m <= 12; $m++ ) {
  $sql = "SELECT * FROM accounts WHERE MONTH(date_issued) = '".($m < 10? "0$m": $m)."'";
  $query = $con->query($sql);
  array_push($accs, $query->num_rows);

  // $num = str_pad( $m, 2, 0, STR_PAD_LEFT );
  $month =  date('M', mktime(0, 0, 0, $m, 1));
  array_push($months, $month);
}

// $months = json_encode($months);
$accs = json_encode($accs);
?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?=$_SESSION['usertype']?>
        <small>Dashboard</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

<div class="row">
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-red">
      <div class="inner">
        <h3><?=$totinact?></h3>

        <p>Total Inactive Clients</p>
      </div>
      <div class="icon">
        <i class="ion ion-person"></i>
      </div>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-green">
      <div class="inner">
        <h3><?=$totact?></h3>

        <p>Total Active Clients</p>
      </div>
      <div class="icon">
        <i class="ion ion-person"></i>
      </div>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-yellow">
      <div class="inner">
        <h3><?=$tottrans?></h3>

        <p>Total Transactions</p>
      </div>
      <div class="icon">
        <i class="ion ion-cash"></i>
      </div>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-blue">
      <div class="inner">
        <h3><?=$totaccs?></h3>

        <p>Total Accounts</p>
      </div>
      <div class="icon">
        <i class="ion ion-card"></i>
      </div>
    </div>
  </div>
  <!-- ./col -->
</div>
<!-- /.row -->
<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Accounts Issued in 2019</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
      </button>
    </div>
  </div>
  <div class="box-body">
    <div class="chart">
      <br>
      <div id="legend" class="text-center"></div>
      <canvas id="barChart" style="height:230px"></canvas>
    </div>
  </div>
  <!-- /.box-body -->
</div>
<?php include "_includes/footer.php";?>
<!-- /.box -->
<script type="text/javascript">
$(function(){
  var barChartCanvas = $('#barChart').get(0).getContext('2d')
  var barChart = new Chart(barChartCanvas)
  var barChartData = {
    labels  : ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],
    datasets: [
      // {
      //   label               : 'Late',
      //   fillColor           : 'rgba(210, 214, 222, 1)',
      //   strokeColor         : 'rgba(210, 214, 222, 1)',
      //   pointColor          : 'rgba(210, 214, 222, 1)',
      //   pointStrokeColor    : '#c1c7d1',
      //   pointHighlightFill  : '#fff',
      //   pointHighlightStroke: 'rgba(220,220,220,1)',
      //   data                : [1,2,3,4,5,6,7,8,9,10,11,12]
      // },
      {
        label               : 'No. of Accounts',
        fillColor           : 'rgba(60,141,188,0.9)',
        strokeColor         : 'rgba(60,141,188,0.8)',
        pointColor          : '#3b8bba',
        pointStrokeColor    : 'rgba(60,141,188,1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data                : <?=$accs?>
      }
    ]
  }
  // barChartData.datasets[1].fillColor   = '#00a65a'
  // barChartData.datasets[1].strokeColor = '#00a65a'
  // barChartData.datasets[1].pointColor  = '#00a65a'
  var barChartOptions                  = {
    //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
    scaleBeginAtZero        : true,
    //Boolean - Whether grid lines are shown across the chart
    scaleShowGridLines      : true,
    //String - Colour of the grid lines
    scaleGridLineColor      : 'rgba(0,0,0,.05)',
    //Number - Width of the grid lines
    scaleGridLineWidth      : 1,
    //Boolean - Whether to show horizontal lines (except X axis)
    scaleShowHorizontalLines: true,
    //Boolean - Whether to show vertical lines (except Y axis)
    scaleShowVerticalLines  : true,
    //Boolean - If there is a stroke on each bar
    barShowStroke           : true,
    //Number - Pixel width of the bar stroke
    barStrokeWidth          : 2,
    //Number - Spacing between each of the X value sets
    barValueSpacing         : 5,
    //Number - Spacing between data sets within X values
    barDatasetSpacing       : 1,
    //String - A legend template
    legendTemplate          : '<ul style="list-style-type:none;"><% for (var i=0; i<datasets.length; i++){%><li style="background-color:<%=datasets[i].fillColor%>;" class="badge"><span ></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
    //Boolean - whether to make the chart responsive
    responsive              : true,
    maintainAspectRatio     : true
  }

  barChartOptions.datasetFill = false
  var myChart = barChart.Bar(barChartData, barChartOptions)
  document.getElementById('legend').innerHTML = myChart.generateLegend();
});
</script>

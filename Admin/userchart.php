<?php
include '../dbconnection.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html>

<head>
  <title>login chart</title>
  <link rel="icon" href="../favicon.jpg" type="image/jpeg">

  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load("current", { packages: ["corechart"] });
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['event', 'sno'],
        <?php
        $sql = "SELECT * FROM login_details";
        //echo $sql;
        $fire = mysqli_query($con, $sql);
        while ($result = mysqli_fetch_assoc($fire)) {
          echo "['" . $result['event'] . "'," . $result['sno'] . "],";
        }
        ?>
      ]);
    
      var options = {
        title: ' Daily Agents login ',
        vAxis: { title: 'Report' },
        hAxis: { title: 'state' },
        seriesType: 'bars',
        series: { 5: { type: 'line' } }
      };
      var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
      chart.draw(data, options);
    }
  </script>
</head>

<body>
  <div id="piechart_3d" style="width: 450px; height: 300px;"></div>
 
</body>

</html>
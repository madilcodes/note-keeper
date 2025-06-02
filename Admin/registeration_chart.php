<?php
include '../dbconnection.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>
<html>

<head>
  <title>Registration chart</title>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load('current', { 'packages': ['corechart'] });
    google.charts.setOnLoadCallback(drawVisualization);

    function drawVisualization() {
    
      var data = google.visualization.arrayToDataTable([
        ['state', 'registration_id'],
        <?php
        $sql = "SELECT * FROM registration_details";
        $fire = mysqli_query($con, $sql);
        while ($result = mysqli_fetch_assoc($fire)) {
          echo "['" . $result['state'] . "'," . $result['registration_id'] . "],";
        }
        ?>
      ]);

      var options = {
        title: 'Sales Analysis ',
        vAxis: { title: 'Report' },
        hAxis: { title: 'state' },
        seriesType: 'bars',
        series: { 5: { type: 'line' } }
      };

      var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    }
  </script>
</head>

<body>
  <div id="chart_div" style="width: 450px; height: 300px;"></div>
</body>

</html>
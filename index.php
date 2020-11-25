<?php

    try{
        $con=new PDO('mysql:host=localhost;dbname=userdata','root','');
    }catch(PDOException $e){
        echo $e->getMessage();
    }

    
    $sql="SELECT country,population FROM country_population";
    $stmt=$con->prepare($sql);
    $stmt->execute();
    $arr=$stmt->fetchAll(PDO::FETCH_ASSOC);

?>
 
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {
        'packages':['geochart'],
        // Note: you will need to get a mapsApiKey for your project.
        // See: https://developers.google.com/chart/interactive/docs/basic_load_libs#load-settings
        'mapsApiKey': 'AIzaSyD-9tSrke72PouQMnMX-a7eZSW0jkFMBWY'
      });
      google.charts.setOnLoadCallback(drawRegionsMap);

      function drawRegionsMap() {
        var data = google.visualization.arrayToDataTable([
          ['Country', 'Population'],
          <?php foreach($arr as $key=>$val){?>  
            ['<?php echo $val['country']?>', <?php echo $val['population']?>],
          <?php } ?>    
        ]);

        var options = {};

        var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="regions_div" style="width: 900px; height: 500px;"></div>
  </body>
</html>

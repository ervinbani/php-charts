<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js" charset="utf-8"></script>
        <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
        <link rel="stylesheet" href="charts.css">
    <title></title>
    </head>
    <body>
        <div class="chart">
            <h1><?php echo "PIMO STEP:STATISTICHE MENSILI DELLE VENDITE"; ?></h1>;
            <canvas id="myChartLine"></canvas>
            <h1><?php echo "SECONDO STEP:"; ?></h1>;
            <canvas id="myChartLine2"></canvas>
            <canvas id="myChartPie"></canvas>
            <h1><?php echo "TERZO STEP:"; ?></h1>;

        </div>
            <?php include 'data.php'; ?>
        <script type="text/javascript">
            $(document).ready(function(){
                myFirstLineChart();
                mySecondLineChart();
                myChartPie();
            });
        // primo step: creazione chartLine con chart.js
function myFirstLineChart() {
    var ctxLine = document.getElementById('myChartLine').getContext('2d');
      var chart = new Chart(ctxLine, {
          // The type of chart we want to create
          type: 'line',
          // The data for our dataset
          data: {
              labels: ["January", "February", "March", "April", "May", "June", "July","August","September","October","November","December"],
              datasets: [{
                  label: "Statistiche mensili delle vendite",
                  borderColor: 'rgb(255, 99, 132)',
                  pointBorderWidth: 3,
                  pointHoverBorderWidth: 3,

                  data: [ <?php foreach( $data as $datum){
                                    echo $datum . ", ";
                                  } ?>
                          ],
              }]
          },

      });
}
//SECONDO STEP
function mySecondLineChart() {
      // PRIMO GRAFICO STEP 1(GRAFICO LINE)
      var ctxLine = document.getElementById('myChartLine2').getContext('2d');
      var chart = new Chart(ctxLine, {
        // The type of chart we want to create
        type: 'line',
        // The data for our dataset
        data: {
            labels: ["January", "February", "March", "April", "May", "June", "July","August","September","October","November","December"],
            datasets: [{
                label: "Monthly Sales",
                backgroundColor: 'rgba(211, 140, 93, 0.3)',
                borderColor: '#00C851',
                pointBorderWidth: 5,
                pointHoverBorderWidth: 3,

                // creo un ciclo foreach per accedere ai valori .
                data: [ <?php //
                            foreach ($graphs as $key => $fatturati){
                                // var_dump($k);
                                if ( $key == "fatturato") {
                                  foreach ($fatturati as $dati) {
                                    //SECONDO CICLO FOR EACH PER ACCEDERE AI DATI DELL ARRAY BIDIMENSIONALE
                                    foreach ($dati as $datum) {
                                        // var_dump($datum);
                                        echo $datum . ", ";
                                    }
                                  }
                                }
                            }
                          ?>
                      ]
            }]
          },
        });
    }
//FUNZIONE CHE CREA UN GRAFICO A TORTA
function myChartPie() {
// array per salvare i dati
var labels = [];
      // creo un ciclo foreach e vado a prendere le mie chiavi
      <?php foreach ($graphs['fatturato_by_agent']['data'] as $key => $agent) { ?>
           labels.push(<?php echo json_encode($key); ?>);
      <?php } ?>
      console.log(labels)
var ctxPie = document.getElementById('myChartPie').getContext('2d');
var chartPie = new Chart(ctxPie, {
  // The type of chart we want to create
  type: 'pie',
  // The data for our dataset
  data: {
      labels: labels,
      datasets: [{
          label: "Statistiche mensili delle vendite",
          // backgroundColor: 'rgb(255, 99, 132)',
          borderColor: '#2E2E2E',
           backgroundColor: ['red', 'yellow', 'green', 'grey'],
          data: [ <?php
                    foreach ($graphs as $key => $fatturati) {
                      // var_dump($fatturati);
                      if ($key == "fatturato_by_agent") {
                        foreach ($fatturati['data'] as $agent) {
                          echo $agent . ", ";
                        }
                      }
                    }
                  ?>
                ],
      }]
    },
  // Configuration options go here
  options: {}
  });
}

        </script>
    </body>
</html>

@push('script')
  var perDayData = {
    labels: [<?php 
          $tgl = array();
          for($i=0;$i<date('d');$i++){
            $tgl[] = date('Y-m-d', strtotime('-'.$i.' days'));
          }
          $tgl = array_reverse($tgl);
          $TGL="";
          foreach ($tgl as $t){
            $TGL .= '"'.indo_date($t).'", ';
          }
        echo $TGL;
        ?>],
    datasets: [
      {
        label: "Produk Terjual",
        fillColor: "#00dd55",
        strokeColor: "white",
        pointColor: "rgba(210, 214, 222, 1)",
        pointStrokeColor: "#c1c7d1",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(220,220,220,1)",
        data: [<?php 
            $quantity;
            foreach ($tgl as $t){
              $quantity = 0;
              foreach ($data as $d){
                if($t==$d->day){
                  $quantity=$d->quantity; break;
                }
              }
              echo $quantity.', ';
            }
            ?>]
      },
      {
        label: "Omset",
        fillColor: "#00aadd",
        strokeColor: "white",
        pointColor: "rgba(210, 214, 222, 1)",
        pointStrokeColor: "#c1c7d1",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(220,220,220,1)",
        data: [<?php 
            $omset;
            foreach ($tgl as $t){
              $omset = 0;
              foreach ($data as $d){
                if($d->day==$t){
                  $omset = $d->omset; 
                  break;
                }
              }
              echo $omset.',';
            }
          ?>]
      },
      {
        label: "Modal",
        fillColor: "#aa0055",
        strokeColor: "white",
        pointColor: "rgba(210, 214, 222, 1)",
        pointStrokeColor: "#c1c7d1",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(220,220,220,1)",
        data: [<?php 
            $modal;
            foreach ($tgl as $t){
              $modal = 0;
              foreach ($data as $d){
                if($d->day==$t){
                  $modal = $d->modal; 
                  break;
                }
              }
              echo $modal.',';
            }
          ?>]
      },
      {
        label: "Laba",
        fillColor: "#aa00dd",
        strokeColor: "white",
        pointColor: "rgba(210, 214, 222, 1)",
        pointStrokeColor: "#c1c7d1",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(220,220,220,1)",
        data: [<?php 
            $laba;
            foreach ($tgl as $t){
              $laba = 0;
              foreach ($data as $d){
                if($d->day==$t){
                  $laba = $d->income; 
                  break;
                }
              }
              echo $laba.',';
            }
          ?>]
      }
    ]
  };
  var perMonthData = {
    labels: [<?php for($i=1;$i<=12;$i++){
          echo '"'.month_name($i).'", ';
        }?>],
    datasets: [
      {
        label: "Produk Terjual",
        fillColor: "#00dd55",
        strokeColor: "white",
        pointColor: "rgba(210, 214, 222, 1)",
        pointStrokeColor: "#c1c7d1",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(220,220,220,1)",
        data: [<?php 
            for($i=1;$i<=12;$i++){
              $quantity = 0;
              foreach ($data2 as $d2){
                if($d2->month==$i){
                  $quantity = $d2->quantity; 
                  break;
                }
              }
              echo $quantity.',';
            }
          ?>]
      },
      {
        label: "Omset",
        fillColor: "#00aadd",
        strokeColor: "white",
        pointColor: "rgba(210, 214, 222, 1)",
        pointStrokeColor: "#c1c7d1",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(220,220,220,1)",
        data: [<?php 
            $omset;
            for($i=1;$i<=12;$i++){
              $omset = 0;
              foreach ($data2 as $d2){
                if($d2->month==$i){
                  $omset = $d2->omset; 
                  break;
                }
              }
              echo $omset.',';
            }
          ?>]
      },
      {
        label: "Modal",
        fillColor: "#aa0055",
        strokeColor: "white",
        pointColor: "rgba(210, 214, 222, 1)",
        pointStrokeColor: "#c1c7d1",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(220,220,220,1)",
        data: [<?php 
            $modal;
            for($i=1;$i<=12;$i++){
              $modal = 0;
              foreach ($data2 as $d2){
                if($d2->month==$i){
                  $modal = $d2->modal; 
                  break;
                }
              }
              echo $modal.',';
            }
          ?>]
      },
      {
        label: "Laba",
        fillColor: "#aa00dd",
        strokeColor: "white",
        pointColor: "rgba(210, 214, 222, 1)",
        pointStrokeColor: "#c1c7d1",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(220,220,220,1)",
        data: [<?php 
            $income;
            for($i=1;$i<=12;$i++){
              $income = 0;
              foreach ($data2 as $d2){
                if($d2->month==$i){
                  $income = $d2->income; 
                  break;
                }
              }
              echo $income.',';
            }
          ?>]
      }
    ]
  };
  var barChartOptions = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero: true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines: false,
      //String - Colour of the grid lines
      scaleGridLineColor: "rgba(0,0,0,.05)",
      //Number - Width of the grid lines
      scaleGridLineWidth: 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines: true,
      //Boolean - If there is a stroke on each bar
      barShowStroke: false,
      //Number - Pixel width of the bar stroke
      barStrokeWidth: 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing: 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing: 0,
      //String - A legend template
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
      //Boolean - whether to make the chart responsive
      responsive: true,
      maintainAspectRatio: true
    };
  barChartOptions.datasetFill = false;
  $(document).ready(function(){
  var barChart = new Chart($("#barChart").get(0).getContext("2d"));
  barChart.Bar(perDayData, barChartOptions);
  });
  $('a[href="#tab_2-2"]').on('shown.bs.tab', function(){
  var barChart2 = new Chart($("#barChart2").get(0).getContext("2d"));
  barChart2.Bar(perMonthData, barChartOptions);
  });
  $('a[href="#tab_1-1"]').on('shown.bs.tab', function(){
  var barChart2 = new Chart($("#barChart").get(0).getContext("2d"));
  barChart2.Bar(perDayData, barChartOptions);
  });
@endpush
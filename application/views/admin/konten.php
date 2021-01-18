<div class="header-content">
  <h2><i class="fa fa-home"></i>HR Dashboard <span>dashboard &amp; statistics</span></h2>
</div>

<script src="<?php echo base_url() ?>assets/js/google-chart.js"></script>
<div class="body-content animated fadeIn">
  <div class="panel rounded shadow panel-teal">
    <div class="panel-heading">
      <div class="pull-left">
        <h3 class="panel-title">Perbandingan Karyawan Laki-laki & Perempuan</h3>
      </div>
      <div class="pull-right">
        <button class="btn btn-sm" data-action="refresh" data-toggle="tooltip" data-placement="top" data-title="Refresh" data-original-title="" title=""><i class="fa fa-refresh"></i></button>
        <button class="btn btn-sm" data-action="collapse" data-toggle="tooltip" data-placement="top" data-title="Collapse" data-original-title="" title=""><i class="fa fa-angle-up"></i></button>
      </div>
      <div class="clearfix"></div>
    </div><!-- /.panel-heading -->
    <div class="panel-body">
      <div class="row">
        <div class="col-sm-9">
          <div id="columnchart_material" style="width: 100%"></div>
          <script type="text/javascript">
            google.charts.load('current', {'packages':['corechart', 'bar']});
            google.charts.setOnLoadCallback(drawStuff);

            function drawStuff() {
              var chartDiv = document.getElementById('columnchart_material');
              var data = google.visualization.arrayToDataTable([
                ['', 'Laki-laki', 'Perempuan'],
                <?php 
                  $max = 100;
                  foreach ($chgender_div as $row) {
                    $max--;
                    echo "['$row->dvnama', $row->l, $row->p],";
                    if ($max<=0) {break;}
                  }
                ?>
                ]);

              var materialOptions = {
                legend: {position: 'none'},
                backgroundColor: 'transparent',
              };

              function drawMaterialChart() {
                var materialChart = new google.charts.Bar(chartDiv);
                materialChart.draw(data, google.charts.Bar.convertOptions(materialOptions));
              }

              drawMaterialChart();
            };
          </script>
        </div>
        <div class="col-sm-3">
          <div id="piechart" style="width: 100%"></div>
          <script type="text/javascript">
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
              var data = google.visualization.arrayToDataTable([
                ['Gender', 'Hours per Day'],
                ['Laki-laki', <?php echo $chgender_all->l ?>],
                ['Perempuan', <?php echo $chgender_all->p ?>],
              ]);

              var options = {
                chartArea:{left:15,top:15, right:15,bottom:15,width:'100%',height:'100%'},
                backgroundColor: 'transparent',
                legend: 'none',
                pieSliceText: 'label',
                is3D: true,
                slices: {  0: {offset: 0.2},
                },
              };

              var chart = new google.visualization.PieChart(document.getElementById('piechart'));

              chart.draw(data, options);
            }
          </script>
        </div>
      </div>
    </div><!-- /.panel-body -->
  </div><!-- /.panel -->

  <div class="panel rounded shadow panel-primary">
    <div class="panel-heading">
      <div class="pull-left">
        <h3 class="panel-title">Perbandingan Status Kerja Karyawan</h3>
      </div>
      <div class="pull-right">
        <button class="btn btn-sm" data-action="refresh" data-toggle="tooltip" data-placement="top" data-title="Refresh" data-original-title="" title=""><i class="fa fa-refresh"></i></button>
        <button class="btn btn-sm" data-action="collapse" data-toggle="tooltip" data-placement="top" data-title="Collapse" data-original-title="" title=""><i class="fa fa-angle-up"></i></button>
      </div>
      <div class="clearfix"></div>
    </div><!-- /.panel-heading -->
    <div class="panel-body">
      <div class="row">
        <div class="col-sm-3">
          <div id="all_sts" style="width: 100%"></div>
          <script type="text/javascript">
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
              var data = google.visualization.arrayToDataTable([
                ['Gender', 'Hours per Day'],
                ['Kontrak', <?php echo $chstatus_all->kontrak ?>],
                ['Tetap', <?php echo $chstatus_all->tetap ?>],
                ['Magang', <?php echo $chstatus_all->magang ?>],
                ['Break', <?php echo $chstatus_all->break ?>],
                ['Resign', <?php echo $chstatus_all->resign ?>],
                ['Blm Ada Kontrak', <?php echo $chstatus_all->bk ?>],
              ]);

              var options = {
                chartArea:{left:15,top:15, right:15,bottom:15,width:'100%',height:'100%'},
                backgroundColor: 'transparent',
                legend: 'none',
                pieSliceText: 'label',
                is3D: true,
                slices: {
                  1: {offset: 0.2},
                  2: {offset: 0.3},
                  3: {offset: 0.2},
                  4: {offset: 0.2},
                  5: {offset: 0.1},
                },
              };

              var chart = new google.visualization.PieChart(document.getElementById('all_sts'));

              chart.draw(data, options);
            }
          </script>
        </div>
        <div class="col-sm-9">
          <div id="chart_status" style="width: 100%"></div>
          <script type="text/javascript">
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
              var data = google.visualization.arrayToDataTable([
                ['Tahun', 'Tetap', 'Kontrak', 'Magang', 'Break', 'Resign'],
                <?php 
                  foreach ($chstatus_thn as $row) {
                    echo "['$row->tahun', $row->tetap, $row->kontrak, $row->magang, $row->break, $row->resign],";
                  }
                ?>
              ]);

              var options = {
                chartArea:{left:40,top:20, right:20,bottom:40,width:'100%',height:'100%'},
                // curveType: 'function',
                legend: { position: 'bottom' },
                backgroundColor: 'transparent',
              };
              var chart = new google.visualization.LineChart(document.getElementById('chart_status'));
              chart.draw(data, options);
            }
          </script>
        </div>
      </div>
    </div><!-- /.panel-body -->
  </div><!-- /.panel -->

</div>
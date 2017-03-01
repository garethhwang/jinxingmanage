<div class="panel panel-default">
  <div class="panel-heading">
    <div class="pull-right"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-calendar"></i> <i class="caret"></i></a>
      <ul id="range" class="dropdown-menu dropdown-menu-right">
        <li><a href="day"><?php echo $text_day; ?></a></li>
        <li><a href="week"><?php echo $text_week; ?></a></li>
        <li class="active"><a href="month"><?php echo $text_month; ?></a></li>
        <li><a href="year"><?php echo $text_year; ?></a></li>
      </ul>
    </div>
    <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> <?php echo $heading_title; ?></h3>
  </div>
  <div id="canvasparent">
    <canvas id="canvas"></canvas>
  </div>
</div>
<br>
<script type="text/javascript" src="view/javascript/jquery/flot/jquery.flot.js"></script>
<script type="text/javascript" src="view/javascript/jquery/flot/jquery.flot.resize.min.js"></script>
<script src="../system/ChartJS/dist/Chart.bundle.js"></script>
<script src="../system/ChartJS/samples/utils.js"></script>
<script type="text/javascript"><!--
    $('#range a').on('click', function(e) {
        e.preventDefault();

        $(this).parent().parent().find('li').removeClass('active');

        $(this).parent().addClass('active');

        $.ajax({
            type: 'get',
            url: 'index.php?route=extension/dashboard/chart/chart&token=<?php echo $token; ?>&range=' + $(this).attr('href'),
            dataType: 'json',
            success: function(json) {
                if (typeof json['order'] == 'undefined') { return false; }
                var config = {
                    type: 'line',
                    data: {
                        labels: json['labels'],
                        datasets: [{
                            label: json['order']['label'],
                            backgroundColor: window.chartColors.red,
                            borderColor: window.chartColors.red,
                            data: json['order']['data'],
                            fill: false,
                        }, {
                            label: json['customer']['label'],
                            fill: false,
                            backgroundColor: window.chartColors.blue,
                            borderColor: window.chartColors.blue,
                            data: json['customer']['data'],
                        }]
                    },
                    options: {
                        responsive: true,
                        title:{
                            display:false
                        },
                        tooltips: {
                            mode: 'index',
                            intersect: false,
                        },
                        hover: {
                            mode: 'nearest',
                            intersect: true
                        },
                        scales: {
                            xAxes: [{
                                display: true,
                                scaleLabel: {
                                    display: true,
                                    labelString: json['labelstring']
                                }
                            }],
                            yAxes: [{
                                display: true,
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Value'
                                }
                            }]
                        }
                    }
                };
                $('#canvas').remove();
                $('#canvasparent').append('<canvas id="canvas"></canvas>');
                var ctx = document.getElementById("canvas").getContext("2d");
                window.myLine = new Chart(ctx, config);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    });

    $('#range .active a').trigger('click');
    //--></script>

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
    <div >
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
                        labels: ["January", "February", "March", "April", "May", "June", "July"],
                        datasets: [{
                            label: "My First dataset",
                            backgroundColor: window.chartColors.red,
                            borderColor: window.chartColors.red,
                            data: [
                                randomScalingFactor(),
                                randomScalingFactor(),
                                randomScalingFactor(),
                                randomScalingFactor(),
                                randomScalingFactor(),
                                randomScalingFactor(),
                                randomScalingFactor()
                            ],
                            fill: false,
                        }, {
                            label: "My Second dataset",
                            fill: false,
                            backgroundColor: window.chartColors.blue,
                            borderColor: window.chartColors.blue,
                            data: [
                                randomScalingFactor(),
                                randomScalingFactor(),
                                randomScalingFactor(),
                                randomScalingFactor(),
                                randomScalingFactor(),
                                randomScalingFactor(),
                                randomScalingFactor()
                            ],
                        }]
                    },
                    options: {
                        responsive: true,
                        title:{
                            display:true,
                            text:'Chart.js Line Chart'
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
                                    labelString: 'Month'
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

                window.onload = function() {
                    var ctx = document.getElementById("canvas").getContext("2d");
                    window.myLine = new Chart(ctx, config);
                };
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    });

    $('#range .active a').trigger('click');
    //--></script>

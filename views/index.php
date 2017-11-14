<?php
/* @var $this yii\web\View */
$this->title = 'Dashboard';

use yii\helpers\Html;
use app\helpers\AppHelper;

?>
<div class="content">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="header-icon">
            <i class="pe-7s-tools"></i>
        </div>
        <div class="header-title">
            <h1>Welcome Aboard.</h1>
            <small>Very detailed & featured admin.</small>
            <ol class="breadcrumb">
                <li><a href="index.html"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </div>
    </div>  <!-- /.Content Header (Page header) -->
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
            <!-- statistic box -->
            <div class="statistic-box statistic-filled-1">
                <h2><span class="count-number">20</span>K <span class="slight"><i
                                class="fa fa-play fa-rotate-270 text-warning"> </i> +28%</span></h2>
                <div class="small">Visitors this Month</div>
                <i class="ti-server statistic_icon"></i>
                <div class="sparkline1 text-center"></div>
            </div> <!-- /. statistic box -->
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
            <!-- statistic box -->
            <div class="statistic-box statistic-filled-2">
                <h2><span class="count-number">21</span>M <span class="slight"><i
                                class="fa fa-play fa-rotate-90 c-white"> </i> +10%</span></h2>
                <div class="small">Total users</div>
                <i class="ti-user statistic_icon"></i>
                <div class="sparkline2 text-center"></div>
            </div>  <!-- /.statistic box -->
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
            <!-- statistic box -->
            <div class="statistic-box statistic-filled-3">
                <h2><span class="count-number">12</span>K <span class="slight"><i
                                class="fa fa-play fa-rotate-270 text-warning"> </i> +29%</span></h2>
                <div class="small">Social users</div>
                <i class="ti-world statistic_icon"></i>
                <div class="sparkline3 text-center"></div>
            </div> <!-- /.statistic box -->
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
            <!-- statistic box -->
            <div class="statistic-box statistic-filled-4">
                <h2><span class="count-number">10</span>$ <span class="slight"><i
                                class="fa fa-play fa-rotate-90 c-white"> </i> +24%</span></h2>
                <div class="small">Total Sales</div>
                <i class="ti-bag statistic_icon"></i>
                <div class="sparkline4 text-center"></div>
            </div> <!--/. statistic box -->
        </div>
    </div>

    <label for=""><h2>Chart Filter Options</h2></label>
    <?= Html::beginForm(['filter-chart'], 'post', ['enctype' => 'multipart/form-data']) ?>
    <div class="row">
        <div class="content-header">
            <div class="row">
                <div class="col-md-6">
                    <label for="">Please Select Project</label>
                    <?=
                    Html::dropDownList('project_id', '', AppHelper::getProjectsList(), [
                        'class' => 'form-control select4', 'prompt' => 'Please Select Project'
                    ]);
                    ?>
                </div>
                <div class="col-md-6">
                    <label for="">Please Select User</label>
                    <?=
                    Html::dropDownList('user_id', '', AppHelper::getUsersList(), [
                        'class' => 'form-control select4', 'prompt' => 'Please Select User'
                    ]);
                    ?>
                </div>
            </div>
        </div>

        <div class="content-header">

            <div class="row">
                <div class="col-md-4 col-sm-12 col-xs-12">
                    <label for="">Year</label>
                    <?=
                    Html::dropDownList('year', '', AppHelper::getYears(), [
                        'class' => 'form-control select4', 'prompt' => 'Please Select Years',
                        'id' => 'year-dd'
                    ]);
                    ?>
                </div>
                <div class="col-md-4 col-sm-12 col-xs-12">
                    <label for="">Month</label>
                    <?=
                    Html::dropDownList('month', '', AppHelper::getMonths(), [
                        'class' => 'form-control select4', 'prompt' => 'Please Select Month',
                        'id' => 'month-dd'
                    ]);
                    ?>
                </div>
                <div class="col-md-4 col-sm-12 col-xs-12">
                    <label for="">Day</label>
                    <select name="day" id="day-dd" class="form-control"></select>
                </div>
            </div>
        </div>
        <div class="row text-center">
            <?= Html::submitButton('Filter Chart Data', ['class' => 'submit btn']) ?>
        </div>

    </div>
    <div class="clearfix"></div>
    <div class="clearfix"></div>
    <br><br>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
            <div class="panel panel-bd ">
                <div class="panel-body">
                    <!-- amcharts -->
                    <div id="chartdiv"></div>
                </div>
            </div>
        </div>
    </div>

    <?= Html::endForm() ?>

</div> <!-- /.main content -->


<?php
$this->registerJs('

$("#month-dd").on("change",function(){
    var month = $(this).val();
    var year = $("#year-dd").val();
    var get_url = baseUrl + "/dashboard/days-by-month";
    $.ajax({
     type: "GET",
     url:  get_url,
     
     data: { 
         "month" : month,
         "year" : year
     },            
         dataType: "json",
         success: function (data) {               
            $.each(data, function(key, value) {   
         $("#day-dd")
         .append($("<option></option>")
                    .attr("value",key)
                    .text(value)); 
});
     },
         error: function (errormessage) {                
         console.log("not working ");                
     }
    });
    
});

//amchart
        var chart = AmCharts.makeChart("chartdiv", {
            "type": "serial",
            "theme": "dark",
            "dataDateFormat": "YYYY-MM-DD",
            "precision": 1,
            "valueAxes": [{
                "id": "v1",
                "title": "Tasks",
                "position": "left",
                "autoGridCount": true,
                "labelFunction": function (value) {
                    return Math.round(value);
                }
            }],
            "graphs": [{
                "id": "g3",
                "valueAxis": "v1",
                "lineColor": "#e1ede9",
                "fillColors": "#e1ede9",
                "fillAlphas": 1,
                "type": "column",
                "title": "Total Tasks",
                "valueField": "total_tasks", //sales2
                "clustered": false,
                "columnWidth": 0.5,
                "legendValueText": "[[value]]",
                "balloonText": "[[title]]<br /><b style=\'font-size: 130%\'>[[value]]</b>"
            }, {
                "id": "g4",
                "valueAxis": "v1",
                "lineColor": "#558B2F",
                "fillColors": "#558B2F",
                "fillAlphas": 1,
                "type": "column",
                "title": "Task(s) Completed",
                "valueField": "comp_tasks", //sales1
                "clustered": false,
                "columnWidth": 0.3,
                "legendValueText": "[[value]]",
                "balloonText": "[[title]]<br /><b style=\'font-size: 130%\'>[[value]]</b>"
            }, {
                "id": "g5",
                "valueAxis": "v1",
                "lineColor": "#b20007",
                "fillColors": "#b20007",
                "fillAlphas": 1,
                "type": "column",
                "title": "Task(s) Remaining",
                "valueField": "remain_tasks",
                "clustered": false,
                "columnWidth": 0.1,
                "legendValueText": "[[value]]",
                "balloonText": "[[title]]<br /><b style=\'font-size: 130%\'>[[value]]</b>"
            }],
            "chartScrollbar": {
                "graph": "g1",
                "oppositeAxis": false,
                "offset": 30,
                "scrollbarHeight": 50,
                "backgroundAlpha": 0,
                "selectedBackgroundAlpha": 0.1,
                "selectedBackgroundColor": "#888888",
                "graphFillAlpha": 0,
                "graphLineAlpha": 0.5,
                "selectedGraphFillAlpha": 0,
                "selectedGraphLineAlpha": 1,
                "autoGridCount": true,
                "color": "#AAAAAA"
            },
            "chartCursor": {
                "pan": true,
                "valueLineEnabled": true,
                "valueLineBalloonEnabled": true,
                "cursorAlpha": 0,
                "valueLineAlpha": 0.2
            },
            "categoryField": "date",
            "categoryAxis": {
                "parseDates": true,
                "dashLength": 1,
                "minorGridEnabled": true
            },
            "legend": {
                "useGraphSettings": true,
                "position": "top"
            },
            "balloon": {
                "borderThickness": 1,
                "shadowAlpha": 0
            },
            "export": {
                "enabled": true
            },
            "dataProvider": [
                {
                    "date": "2013-01-01",
                    "total_tasks": 50,
                    "comp_tasks": 40,
                    "remain_tasks": 10
                },
                {
                    "date": "2013-01-02",
                    "total_tasks": 50,
                    "comp_tasks": 40,
                    "remain_tasks": 10
                }, {
                    "date": "2013-01-03",
                    "total_tasks": 50,
                    "comp_tasks": 40,
                    "remain_tasks": 10
                }, {
                    "date": "2013-01-04",
                    "total_tasks": 50,
                    "comp_tasks": 40,
                    "remain_tasks": 10
                }, {
                    "date": "2013-02-05",
                    "total_tasks": 50,
                    "comp_tasks": 40,
                    "remain_tasks": 10
                }, {
                    "date": "2013-02-06",
                    "total_tasks": 50,
                    "comp_tasks": 40,
                    "remain_tasks": 10
                }, {
                    "date": "2013-02-07",
                    "total_tasks": 80,
                    "comp_tasks": 40,
                    "remain_tasks": 40
                }, {
                    "date": "2013-02-08",
                    "total_tasks": 60,
                    "comp_tasks": 50,
                    "remain_tasks": 10
                }, {
                    "date": "2013-03-09",
                    "total_tasks": 90,
                    "comp_tasks": 80,
                    "remain_tasks": 10
                }, {
                    "date": "2013-03-10",
                    "total_tasks": 56,
                    "comp_tasks": 50,
                    "remain_tasks": 6
                }, {
                    "date": "2013-03-11",
                    "total_tasks": 50,
                    "comp_tasks": 25,
                    "remain_tasks": 25
                }, {
                    "date": "2013-04-12",
                    "total_tasks": 60,
                    "comp_tasks": 56,
                    "remain_tasks": 4
                }, {
                    "date": "2013-04-13",
                    "total_tasks": 40,
                    "comp_tasks": 32,
                    "remain_tasks": 8
                }, {
                    "date": "2013-05-14",
                    "total_tasks": 100,
                    "comp_tasks": 80,
                    "remain_tasks": 20
                }, {
                    "date": "2013-05-15",
                    "total_tasks": 25,
                    "comp_tasks": 21,
                    "remain_tasks": 4
                }, {
                    "date": "2013-06-16",
                    "total_tasks": 30,
                    "comp_tasks": 30,
                    "remain_tasks": 0
                }, {
                    "date": "2013-06-17",
                    "total_tasks": 70,
                    "comp_tasks": 50,
                    "remain_tasks": 20
                }, {
                    "date": "2013-07-18",
                    "total_tasks": 30,
                    "comp_tasks": 25,
                    "remain_tasks": 5
                }, {
                    "date": "2013-07-19",
                    "total_tasks": 20,
                    "comp_tasks": 17,
                    "remain_tasks": 3
                }, {
                    "date": "2013-08-20",
                    "total_tasks": 12,
                    "comp_tasks": 10,
                    "remain_tasks": 2
                },]
        });

', \yii\web\View::POS_END);

$this->registerJs("
//SUBMMITING CHECKLIST FORM DATA USING AJAX

 $('body').on('beforeSubmit', 'form#checklist-form', function (e) {
   e.preventDefault();
           // var form = $(this);
          //  console.log(form);
            // return false if form still have some validation errors
            if ($(this).find('.has-error').length) 
            {
                return false;
            }
            // submit form
            $.ajax({
            url    : baseUrl + 'projects/create-checklist',
            type   : 'post',
            async:false,
            data   : $(this).serialize(),
            success: function (response) 
            {
               
                           
            },
            error  : function () 
            {
                console.log('internal server error');
            }
            });
            return false;
         }); 
     ", \yii\web\View::POS_END);

?>



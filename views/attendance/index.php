<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\editable\Editable;
use yii\bootstrap\Modal;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AttendanceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Attendances';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attendance-index content-header">
    <div class="box box-primary">
        <div class="box-body">
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <p class="pull-right">
                <?php echo Html::a('OFF', ['off'], ['class' => 'btn btn-success']) ?>
            </p>


            <?php Pjax::begin(); ?>    <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'attendance_id',
                    //'user_id',
                    [
                        'attribute' => 'username',
                        'value' => 'user.first_name'
                    ],
                    [
                        'value' => function ($model) {
                           // print_r($model); exit();
                            return $model->note;
                        },
                        'class' => \mcms\xeditable\XEditableColumn::className(),
                        'url' => 'editable',
                        'dataType' => 'text',
                        'attribute' => 'note',
                        'format' => 'raw',
                        'editable' => [
                            'validate' => new \yii\web\JsExpression('
                                            function(value) {
                                                    if($.trim(value) == "") {
                                                            return "This field is required";
                                                    }
                                            }
                                ')
                        ],
                    ],
                    'login_time',
                    //'created_at',
                     [
                        'attribute' => 'created_at',
                        'label'=> 'Day',
                        //'value' => date('Y-m-d'),
                        'filter' =>DatePicker::widget([
                            'model' => $searchModel,
                            'attribute' => 'created_at',
                           //'name' => 'created_at',
                            'value' => date('Y-m-d'),
                            'template' => '{addon}{input}',
                                'clientOptions' => [
                                    'autoclose' => true,
                                    'todayHighlight' => true,
                                    'format' => 'yyyy-mm-dd'
                                ]
                        ]),
                        //'format' => 'html',
                    ],
                    // [
                    //     'attribute' => 'created_at',
                    //     'label' => 'Day',
                    //     'filter'=>DatePicker::className(), [
                    //         'model' => $searchModel,
                    //         'inline' => true,
                    //     'clientOptions' => ['autoclose' => true,
                    //                         'format' => 'yyyy-MM-dd']
                    // ]
                    // ],
                    //'logout_time',
//                    [
//                        'attribute' => 'status',
//                        'value' => function ($model) {
//                            if ($model->status == 'P')
//                                return 'Present';
//                            else if ($model->status == 'O')
//                                return 'OFF';
//                            else if ($model->status == 'PL')
//                                return 'Paid Leave';
//                            else if ($model->status == 'LWP')
//                                return 'Leave With no pay';
//                            else
//                                return 'Uninformed Leave';
//
//                        },
//                        'format' => 'raw',
//                        'filter' => Html::activeDropDownList($searchModel, 'status2', ['P' => 'Present', 'O' => 'OFF', 'PL' => 'Paid Leave', 'LWP' => 'Leave With no pay', 'UL' => 'Uninformed Leave'], ['class' => 'form-control select2', 'prompt' => 'Filter By Status']),
//                    ],
                    [
                        'attribute' => 'status',
                        'label' => 'Change Status',
                        'value' => function ($model) {
                            return Html::dropDownList('', $model->status, ['P' => 'Present', 'O' => 'OFF', 'PL' => 'Paid Leave', 'LWP' => 'Leave With no pay', 'UL' => 'Uninformed Leave'],
                                [
                                    'class' => 'form-control',
                                    'prompt' => 'Select Status',
                                    'onchange' => 'changeStatus("' . $model->attendance_id . '",$(this).val())']);
                        },
                        'format' => 'raw',
                        'filter' => Html::activeDropDownList($searchModel, 'status', ['P' => 'Present', 'O' => 'OFF', 'PL' => 'Paid Leave', 'LWP' => 'Leave With no pay', 'UL' => 'Uninformed Leave'], ['class' => 'form-control select2', 'prompt' => 'Filter By Status']),
                    ],

                    // ['class' => 'yii\grid\ActionColumn'],
                    ['class' => 'yii\grid\ActionColumn',
                        'template' => '{info}',
                        'buttons' => [
                            'info' => function ($url, $model) {
                                return Html::a('<span class="glyphicon glyphicon-info-sign"></span>', ['work-info','user_id'=> $model->user_id], ['class' => 'btn btn-success modal-btn', 'value' => $model->user_id, 'aria-details'=>$model->created_at]);
                            }
                        ],
                       
                    ]

                ],
            ]); ?>
            <?php Pjax::end(); ?></div>
    </div>
</div>
<?php
//$this->registerJs("$('.select4').select2({placeholder: \"Please Select Users\",});", \yii\web\View::POS_END, 'select-select2');
yii\bootstrap\Modal::begin([
    'header' => '<h4>Working Hours</h4>',
    'id' => 'work_info',
]);

?>
<div id='modalContent'>
<div class="popup_overlay">
    <div class="popup container" id="user_list">
            <h1 id="user_name" style="text-transform:capitalize;"></h1>
            <h5 id="day"></h5>
            <div class="table-responsive" style="width: 50%;">
            <table border="1" class="table table-striped">
            <thead>
            <tr>
                <th>index</th>
                <th>Login</th>
                <th style="width: 50px;">Logout</th>
            </tr>
            </thead>
            <tbody id="logged-in">
            </tbody>
        </table>
            </div>
        
        <h4 id="total_working_hrs"></h4>
        <h4 for="" id="login_count"></h4>
    </div>
</div>
</div>

<?php
Modal::end();

//Change Status
$url = \yii\helpers\Url::toRoute('work-info',true);
$this->registerJs("
    $('.modal-btn').click(function(e)
    {
            console.log('this is '+$(this).attr('aria-details'));
            e.preventDefault();
            $('#work_info').modal('show');
            $.ajax({
            url: '$url',
            type: 'GET',
            data:{  user_id: $(this).attr('value'),
                    date: $(this).attr('aria-details')
                },
            success: function (obj)
            {
                console.log(obj);
                var data = jQuery.parseJSON(obj);
                var login_item;
                var user_name;
                var day;
                var onlydate;
                var effective_hrs = 0;
                var total_effective_hrs = 0;
                var start, end;
                var login_count = 0;
                $('#logged-in').html('');
                $('#user_name').text('');
                $('#day').text('');
                $.each(data, function (index, value)
                {
                    if (value['logout_time'] != null)
                    {
                        effective_hrs = workingHours(value['login_time'], value['logout_time']);
                        total_effective_hrs = (total_effective_hrs + toSeconds(effective_hrs));
                    }
                    login_count = (index + 1);
                    user_name = value['first_name'] + ' ' + value['last_name'];
                    day =  value['created_at'];
                    onlydate = day.split(' ');

                    login_item = '<tr>' +
                            '<td>' + (index + 1) + '</td>' +
                            '<td>' + value['login_time'] + '</td>' +
                            '<td>' + value['logout_time'] + '</td>' +
                            '</tr>';
                        $('#logged-in').append(login_item);
                });
                    $('#login_count').text(login_count + ' Login');
                    $('#total_working_hrs').text('Total Working Hours: ' + toHHMMSS(total_effective_hrs));

                    $('#user_name').text(user_name);
                    $('#day').text('Date :-' +onlydate[0]);

            }
            });
        });
    ", \yii\web\View::POS_END);
?>
<?php 
$this->registerJs("
     function toSeconds(time) {
            var parts = time.split(':');
            return (+parts[0]) * 60 * 60 + (+parts[1]) * 60 + (+parts[2]);
        }

        function toHHMMSS(sec) {
            var sec_num = parseInt(sec, 10); // don't forget the second parm
            var hours = Math.floor(sec_num / 3600);
            var minutes = Math.floor((sec_num - (hours * 3600)) / 60);
            var seconds = sec_num - (hours * 3600) - (minutes * 60);

            if (hours < 10) {
                hours = '0' + hours;
            }
            if (minutes < 10) {
                minutes = '0' + minutes;
            }
            if (seconds < 10) {
                seconds = '0' + seconds;
            }
            var time = hours + ':' + minutes + ':' + seconds;
            return time;
        }

        function addTime(start, end) {
            var start = toSeconds(start);
            var end = toSeconds(end);
            return total_time = (start + end);
            //return toHHMMSS(total_time);

        }
         function workingHours(start, end) {
            var ms = moment(end, 'HH:mm:ss').diff(moment(start, 'HH:mm:ss'));
            var d = moment.duration(ms);
            return Math.floor(d.asHours()) + moment.utc(ms).format(':mm:ss');
        }
    ", \yii\web\View::POS_END);
?>
<?php
$this->registerJs("
var options = {
    title: 'Status Changed Successfuly',   
    options: {
    icon: baseUrl+'images/okay.png',
    
    }
};
function changeStatus(aid,status){

 $.ajax({
     type: 'GET',
     url: '" . \yii\helpers\Url::to(['/attendance/change-status']) . "',
     data: { 
         'aid' : aid,
         'status' : status
     },            
         dataType: 'json',
         success: function (data) {               
     $('#easyNotify').easyNotify(options);
     },
         error: function (errormessage) {                
         console.log('not working ');                
     }
});
}
", \yii\web\View::POS_END);
?>
<?php
if (Yii::$app->session->hasFlash('off-msg')):
    $this->registerJs("
var options = {
    title: '" . Yii::$app->session->getFlash('off-msg') . "',   
    options: {
    icon: baseUrl+'images/okay.png',
    
    }
};
$('#easyNotify').easyNotify(options);
", \yii\web\View::POS_END);
endif;
?>

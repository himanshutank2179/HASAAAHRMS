<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\editable\Editable;

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
                    'logout_time',
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
                ],
            ]); ?>
            <?php Pjax::end(); ?></div>
    </div>
</div>
<?php
//$this->registerJs("$('.select4').select2({placeholder: \"Please Select Users\",});", \yii\web\View::POS_END, 'select-select2');

//Change Status
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

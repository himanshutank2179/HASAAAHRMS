<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProjectsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Projects';
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="projects-index content-header">
    <div class="box box-primary">
        <div class="box-body">
            <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

            <p>
                <?= Html::a('Create Projects', ['create'], ['class' => 'btn btn-success']) ?>
            </p>
            <?php //Pjax::begin(); ?>
            <?= GridView::widget([
                'id' => 'project-list',
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn', 'header' => 'Sr. No.'],

                    //'project_id',
                    'name',
                    //'short_desc:ntext',
                    'client_name',
                    [
                        'label' => 'Team',
                        'value' => function ($model) {
                            $users = [];
                            //debugPrint($model->projectUsers);
                            foreach ($model->projectUsers as $user):
                                $uname = \app\models\Users::findOne($user->user_id)->first_name;
                                array_push($users, ucfirst($uname));
                            endforeach;
                            return implode(' | ', $users);


                        }
                    ],
                    'start_date',
                    'deadline',
                    //'status',

//                    [
//                        'attribute' => 'status',
//                        'value' => function ($model) {
//                            return Html::dropDownList('', $model->status, ['None' => 'None', 'Start' => 'Start', 'In Progress' => 'In Progress', 'Completed' => 'Completed'],
//                                [
//                                    'class' => 'form-control pstatus',
//                                    'prompt' => 'Select Status',
//                                    'onchange' => 'changeStatus("' . $model->project_id . '",$(this).val())']);
//                        },
//                        'format' => 'raw',
//                        'filter' => Html::activeDropDownList($searchModel, 'status', ['None' => 'None', 'Start' => 'Start', 'In Progress' => 'In Progress', 'Completed' => 'Completed'], ['class' => 'form-control select2', 'prompt' => 'Filter By Status']),
//                    ],
                    // 'admin_id',
                    // 'is_deleted',

                  //  ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {update}',],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => \mdm\admin\components\Helper::filterActionColumn('{view}{delete}{posting}'),
                    ]
                ],
            ]); ?>
            <?php //Pjax::end(); ?></div>
    </div>
</div>
<?php
//$this->registerJs("$('.select4').select2({placeholder: \"Please Select Users\",});", \yii\web\View::POS_END, 'select-select2');
$this->registerJs("$('.datepicker').datepicker({
        autoclose: true,
        format: \"yyyy-mm-dd\",        
        todayBtn: 'linked',
        'startDate': 'today',        
        todayHighlight: true});", \yii\web\View::POS_END, 'date-picker');
$this->registerJs('$("body").on("keyup.yiiGridView", "#project-list .filters input", function(){
    $("#project-list").yiiGridView("applyFilter");
})', \yii\web\View::POS_END);


//Change Status
$this->registerJs("
var options = {
    title: 'Status Changed Successfuly',   
    options: {
    icon: baseUrl+'images/okay.png',
    
    }
};
function changeStatus(pid,status){
 $.ajax({
     type: 'GET',
     url: '" . \yii\helpers\Url::to(['/projects/change-status']) . "',
     data: { 
         'pid' : pid,
         'status' : status
     },            
         dataType: 'json',
         success: function (data) {               
       setTimeout(function () {
                            toastr.options = {
                                closeButton: true,
                                progressBar: true,
                                showMethod: 'slideDown',
                                timeOut: 4000
                                // positionClass: \"toast-top-left\"
                            };
                            toastr.success('', 'Status Changed Successfully.');

                        }, 1300);
     },
         error: function (errormessage) {                
         console.log('not working ');                
     }
});
}
", \yii\web\View::POS_END);
?>

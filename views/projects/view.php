<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use kartik\sortable\Sortable;
use app\helpers\AppHelper;
use kartik\file\FileInput;



/* @var $this yii\web\View */
/* @var $model app\models\Projects */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

//\app\helpers\AppHelper::dd($model->projectUsers);
?>

<style>
    .in-progress {
        background: #ffde4f;

    }

    .complete {
        background: #008625;
        color: #fff;
    }

    .stuck {
        background: #e00007;
        color: #fff;
    }
    input.form-control.task-status {
        margin-top: 10px;
    }

</style>

<!--Tasks Modal Ends Here-->
<div class="projects-view content-header">
    <div class="box box-primary">
        <div class="box-body">

            <p>
                <?php
                if (\mdm\admin\components\Helper::checkRoute('delete')) {
                    echo Html::a('Delete', ['delete', 'id' => $model->project_id], [
                        'class' => 'btn btn-danger',
                        'data-confirm' => 'Are you sure to delete this item?',
                        'data-method' => 'post',
                    ]);
                }
                ?>

                <?php
                if (\mdm\admin\components\Helper::checkRoute('delete')) {

                    echo Html::a('Update', ['update', 'id' => $model->project_id], ['class' => 'btn btn-primary']);
                }
                ?>



                <?= Html::a('Add Task', ['projects/create-task', 'project_id' => $model->project_id], ['class' => 'btn btn-primary modal-btn']) ?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    //'project_id',
                    'name',
                    'short_desc:ntext',
                    'client_name',
                    'deadline',
//                    [
//                        'attribute' => 'admin_id',
//                        'value' => function ($model) {
//                            return $model->users->first_name;
//                        }
//                    ],
                    //'is_deleted',
                ],
            ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <h3>Project Users</h3>
            <div class="box box-primary">

                <div class="box-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th><h3><?= ucfirst(\app\models\Users::findOne($model->admin_id)->first_name) ?> <span
                                            class="label label-success">Admin</span></h3></th>
                        </tr>
                        <?php foreach ($model->projectUsers as $user): ?>
                            <?php $u = \app\models\Users::findOne(['user_id' => $user->user_id]); ?>
                            <tr>
                                <td><label for=""><?= $u->first_name; ?></label>

                                    <br>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <?php
            $previewImg = array();
            $initialPreviewConfig = array();

            // if (!$model->isNewRecord) {

            //     $modelImage = app\models\Identity::find()->where(['user_id' => $model->user_id])->all();

            //     if (!empty($modelImage)) {

            //         foreach ($modelImage as $user_image) {
            //             $prev = Html::img(yii\helpers\BaseUrl::home() . "uploads/" . $user_image->image, ['class' => 'file-preview-image img-responsive', 'alt' => 'img']);
            //             $a = Html::hiddenInput("Users[images][]", $user_image->image, [
            //                 'id' => 'users-users_images'
            //             ]);
            //             array_push($previewImg, $prev);

            //             $b = ['url' => yii\helpers\BaseUrl::home() . "uploads/filedelete", 'key' => $user_image->identity_id];
            //             array_push($initialPreviewConfig, $b);
            //         }
            //     }
            // }

            echo '<label class="control-label">Add Attachments</label>';
            echo FileInput::widget(['model' => $model,
                                    'attribute' => 'deadline',
                                    'options' => ['multiple' => true]
                                    ]);
?>
        <div style="color: #dd4b39" id="upload_error" class="help-block"></div>
        </div>
    </div>

    <h3>Project Tasks</h3>
    <?php $tsks = \app\models\Tasks::findAll(['project_id' => $model->project_id, 'is_deleted' => 0]); ?>

    <div class="row">
        <?php foreach ($tsks as $tsk): ?>
            <?php $clist = \app\models\Checklist::find()->where(['task_id' => $tsk->task_id])->all(); ?>
            <?php $com_list = \app\models\TaskComment::findAll(['task_id' => $tsk->task_id]); ?>

            <?php // debugPrint($com_list); ?>

            <div class="col-md-4">
                <div class="box box-success">
                    <div class="box-body">


                        <div class="row task-list">
                            <div class="col-md-6"><a
                                        href="<?= \yii\helpers\Url::to(['task-desc', 'task_id' => $tsk->task_id], true); ?>"
                                        class="task-lst"><b><?= ucfirst($tsk->name); ?></b></a>
                            </div>
                            <div class="col-md-6 pull-right">
                                <?= Html::dropDownList('', $tsk->status, ['Not Started' => 'Not Started', 'In Progress' => 'In Progress', 'Complete' => 'Complete', 'Stuck' => 'Stuck'], ['class' => 'task-status form-control', 'data-slider-id' => $tsk->task_id, 'data-title' => $tsk->name]); ?>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <?= Html::textInput('','',['placeholder' => 'Description', 'class' => 'form-control task-status']) ?>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>


        <?php endforeach; ?>


    </div>

</div>


<?php
yii\bootstrap\Modal::begin([
    'header' => '<h1>Task Details</h1>',
    'headerOptions' => ['id' => 'modalHeader'],
    'id' => 'tasks-desc',
    'size' => 'modal-lg',
    //keeps from closing modal with esc key or by clicking out of the modal.
    // user must click cancel or X to close
    'clientOptions' => ['keyboard' => true]
]);
echo "<div id='modalContent'></div>";
yii\bootstrap\Modal::end();


Modal::begin([
    'header' => '<h1>Add Task</h1>',
    'id' => 'add_task',

]);
$form = \yii\widgets\ActiveForm::begin([
    'action' => ['create-task'],
]); ?>

<?= $form->field($task, 'name')->textInput(['maxlength' => true]) ?>

<?= $form->field($task, 'project_id')->hiddenInput(['value' => $model->project_id])->label(false) ?>
<div class="col-md-12">
<?= $form->field($model, 'tags')->dropDownList(AppHelper::getUsersList(), [
                        'class' => 'form-control', 'prompt' => 'Please Select User',
                        'multiple' => 'multiple',
                        'id'=>'tags'
                    ]); ?>    
</div>


<?= $form->field($task, 'status')->dropDownList(['Not Started' => 'Not Started', 'In Progress' => 'In Progress', 'Complete' => 'Complete', 'Stuck' => 'Stuck'], ['prompt' => 'Please Select task']) ?>

<?= $form->field($task, 'deadline')->textInput(['class' => 'form-control datepicker']) ?>

<div class="form-group">
    <?= Html::submitButton('Add Task', ['class' => 'btn btn-success']) ?>
</div>

<?php \yii\widgets\ActiveForm::end(); ?>
<?php
Modal::end();

$this->registerJs("$('.select4').select2({placeholder: \"Please Select Users\",});", \yii\web\View::POS_END, 'select-select2');

$this->registerJs("
 $('.task-lst').click(function(e){      
        e.preventDefault();      
        $('#tasks-desc').modal('show')
                    .find('#modalContent')
                    .load($(this).attr('href'));
      
    }); 

$('.task-status').on('change', function() {
    var status = $(this).find(\":selected\").val();
    var task_id = $(this).attr('data-slider-id');
    console.log(task_id);
    $.ajax({
    url: baseUrl + 'tasks/change-status',
    data: { 
        'status':status,
        'task_id':task_id        
    },    
    type: \"GET\",
    success: function(response) {
        if(response == 1){
            setTimeout(function () {
                        toastr.options = {
                        closeButton: true,
                        progressBar: true,
                        showMethod: 'slideDown',
                        timeOut: 4000,
                         positionClass: \"toast-top-left\"
                        };
                        toastr.success($(this).attr('data-title'), 'Status Changed Successfully.');
                    }, 1000); 
        }
    },
    error: function(xhr) {

    }
});
});

    $('.modal-btn').click(function(e){      
        e.preventDefault();
        $('#add_task').modal('show');
       
      
    });
    
    
", \yii\web\View::POS_END);

$this->registerJs("$('.datepicker').datepicker({
        autoclose: true,
        format: \"yyyy-mm-dd\",        
        todayBtn: 'linked',
        todayHighlight: true});", \yii\web\View::POS_END, 'date-picker');


?>







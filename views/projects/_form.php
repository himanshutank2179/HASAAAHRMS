<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\helpers\AppHelper;


if (!$model->isNewRecord) {
    $users = [];
    foreach ($model->projectUsers as $user) {
        array_push($users, $user->user_id);
    }
    $model->project_users = $users;
}


/* @var $this yii\web\View */
/* @var $model app\models\Projects */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="projects-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6">

        </div>
        <div class="col-md-6">

        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'client_name')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'deadline')->textInput(['class' => 'form-control datepicker']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'admin_id')->dropDownList(AppHelper::getUsersList(), ['prompt' => 'Please Select Admin', 'class' => 'form-control select2']); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?=
            $form->field($model, 'project_users')->dropDownList(AppHelper::getProjectUsers(), [
                'class' => 'form-control select4',
                'multiple' => 'multiple'
            ]);
            ?>
        </div>
    </div>

    <?= $form->field($model, 'short_desc')->textarea(['rows' => 6]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$this->registerJs("$('.select4').select2({placeholder: \"Please Select Users\",});", \yii\web\View::POS_END, 'select-select2');
$this->registerJs("$('.datepicker').datepicker({
        autoclose: true,
        format: \"yyyy-mm-dd\",        
        todayBtn: 'linked',
        'startDate': 'today',        
        todayHighlight: true});", \yii\web\View::POS_END, 'date-picker');
?>

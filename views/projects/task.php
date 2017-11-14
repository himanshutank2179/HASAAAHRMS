<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\helpers\AppHelper;



/* @var $this yii\web\View */
/* @var $model app\models\Tasks */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tasks-form">

    <?php $form = ActiveForm::begin([
        'action' => ['create-task'],
    ]); ?>


    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList(['Not Started' => 'Not Started', 'In Progress' => 'In Progress', 'Complete' => 'Complete', 'Stuck' => 'Stuck',], ['prompt' => 'Please Select task']) ?>

    <?= $form->field($model, 'tags')->dropDownList('user_id', '', AppHelper::getUsersList(), [
                        'class' => 'form-control select4', 'prompt' => 'Please Select User'
                        'multiple' => 'multiple'
                    ]); ?>

    <?= $form->field($model, 'deadline')->textInput(['class' => 'form-control datepicker']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$this->registerJs("$('.datepicker').datepicker({
        autoclose: true,
        format: \"yyyy-mm-dd\",        
        todayBtn: 'linked',
        todayHighlight: true});", \yii\web\View::POS_END, 'date-picker');
?>

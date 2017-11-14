<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\helpers\AppHelper;

//app\assets\DatePickerAsset::register($this);
//\app\assets\SelectAsset::register($this);

/* @var $this yii\web\View */
/* @var $model app\models\Notifications */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="notifications-form">

    <?php $form = ActiveForm::begin(); ?>



    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?=
    $form->field($model, 'notify_to')->dropDownList(AppHelper::getUsersList(), [
        'class' => 'form-control select4',
        'multiple' => 'multiple'
    ]);
    ?>




    <?= $form->field($model, 'is_push')->checkbox() ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$this->registerJs("$('.select4').select2({placeholder: \"Please Select Users\",});", \yii\web\View::POS_END, 'select-select2');
?>
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\helpers\AppHelper;
\app\assets\SelectAsset::register($this);
/* @var $this yii\web\View */
/* @var $model app\models\Roles */
/* @var $form yii\widgets\ActiveForm */
if (!$model->isNewRecord) {
//print_r($model->usersPermissions); exit();
    $select = [];
    if (!empty($model->usersPermissions)) {
        foreach ($model->usersPermissions as $permission) {
            array_push($select, $permission->permission_id);
        }
    }

    $model->user_permissions = $select;
}
?>

<div class="roles-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?php
            echo $form->field($model, 'user_permissions')->dropDownList(AppHelper::getPermissionList('AD', 0), [
                'class' => 'form-control select2',
                'multiple' => 'multiple'
            ]);
            ?>
        </div>
    </div>








    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$this->registerJs("$('.select2').select2({placeholder: \"Please Select\",});", \yii\web\View::POS_END, 'select-picker');
?>
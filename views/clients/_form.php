<?php

use app\helpers\AppHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use app\models\ClientMobile;

/* @var $this yii\web\View */
/* @var $model app\models\Clients */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="clients-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'account_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bank_ifsc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gstin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'flat')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
    <?= $form->field($model, 'street')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'landmark')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'area')->textInput(['maxlength' => true]) ?>



    <?= $form->field($model, 'country_id')->dropDownList(AppHelper::getCountries(), ['class' => 'form-control select4', 'prompt' => 'Please Select','onchange'=> '$.post( "'.Yii::$app->urlManager->createUrl('clients/state-list?id=').'"+$(this).val(), function( data ) {
                    $( "#clients-state_id" ).html( data );
                });
            ']) ?>


    <?= $form->field($model, 'state_id')->dropDownList(AppHelper::getStates(), ['class' => 'form-control select4', 'prompt' => 'Please Select','onchange'=> '$.post( "'.Yii::$app->urlManager->createUrl('clients/city-list?id=').'"+$(this).val(), function( data ) {
                    $( "#clients-city_id" ).html( data );
                });
            ']) ?>

    <?= $form->field($model, 'city_id')->dropDownList(AppHelper::getCity(), ['class' => 'form-control select4', 'prompt' => 'Please Select']) ?>

    <?= $form->field($model, 'statecode')->textInput(['maxlength' => true]) ?>

        </div>
        <!-- <div class="col-md-6">
        
        </div> -->
    </div>
    <div class="row">
                <div id="ajax-document">                    
                    <?php if (!$model->isNewRecord):?>
                        <?php $all_mobiles = ClientMobile::find()->where(['client_id' => $model->client_id])->all(); 
                            foreach ($all_mobiles as $key => $value) : ?>
                        <div class="animated bounceInRight create-po document-form" id="<?= $key ?>">
                            <div class="row">
                                <div class="col-md-10">
                                        <label for="clients-mobile-<?= $key ?>"> Mobile </label>
                                            <?= Html::activeTextInput($value, 'client_mobile[]', [
                                                'maxlength' => true,
                                                'class' => 'form-control',
                                                'id' => 'clients-mobile-' . $key,
                                                'required' => true,
                                                'type'=>'number',
                                                'value' => $value->client_mobile,
                                            ]); ?>
                                </div>
                                <div class="col-md-2"><br>
                                    <button class="btn btn-danger" onclick="ajaxform.removeBlankFloatForm('<?php echo $key ?>')">Remove</button>
                                </div>
                            </div>
                    </div>
                    <?php  endforeach; ?>
                    <?php endif;  ?>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <a id="add-mobile"
                       onclick="ajaxform.addFloatForm('<?= Url::to(['clients/get-float-form'], true) ?>','ajax-document')"
                       href="javascript:;"
                       class="btn btn-info col-md-12">Add More Mobile</a>
                </div>
            </div><br>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
if ($model->isNewRecord) {
$this->registerJs("
    $('#add-mobile').trigger('click');
", \yii\web\View::POS_END);
}
?>
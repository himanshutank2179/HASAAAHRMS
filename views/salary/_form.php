<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\helpers\AppHelper;

//\app\assets\SelectAsset::register($this);
/* @var $this yii\web\View */
/* @var $model app\models\Salary */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="salary-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=
    $form->field($model, 'user_id')->dropDownList(AppHelper::getSalaryUsersList(), [
        'class' => 'form-control select4', 'onchange' => 'getDaysCount($(this).val()); getCtc($(this).val());'
    ]);
    ?>

    <?= $form->field($model, 'ctc')->textInput() ?>

    <label for="gross" id="gross" class="pull-right"></label>

    <?= $form->field($model, 'tds')->textInput(['placeholder' => 'e.g. 10%']) ?>

    <label for="gross-1" id="gross-1" class="pull-right"></label>

    <?= $form->field($model, 'pt')->textInput() ?>

    <label for="gross-2" id="gross-2" class="pull-right"></label>

    <?= $form->field($model, 'pf')->textInput() ?>

    <label for="gross-3" id="gross-3" class="pull-right"></label>

    <?= $form->field($model, 'esi')->textInput() ?>

    <label for="gross-4" id="gross-4" class="pull-right"></label>

    <?= $form->field($model, 'incentive')->textInput() ?>

    <label for="gross-5" id="gross-5" class="pull-right"></label>

    <?= $form->field($model, 'bonus')->textInput() ?>

    <label for="gross-6" id="gross-6" class="pull-right"></label>

    <?= $form->field($model, 'extra_note')->textarea(['rows' => 6]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$this->registerJs("$('.select4').select2({placeholder: \"Please Select Users\",});", \yii\web\View::POS_END, 'select-select2');
if(!$model->isNewRecord):
    $this->registerJs("
     $(window).on('load', function (event) {
        var uid = $('#salary-user_id').val();
        getDaysCount(uid); 
        getCtc(uid);
    });
    ", \yii\web\View::POS_END, 'select-select2');

endif;
//Getting Present days count of Employee
$this->registerJs("


var total_present_days;
var gross = 0;
var gross1 = 0;
var gross2 = 0;
var gross3 = 0;
var gross4 = 0;
var gross5 = 0;
var gross6 = 0;
var gross7 = 0;
var tds = 0;
var pt = 0;
var pf = 0;
var esi = 0;
 console.log(gross); 
// COUNTING TOTAL PRESANT DAYS USING AJAX
function getDaysCount(uid){ 

 $.ajax({
     type: 'GET',
     url: '" . \yii\helpers\Url::to(['/salary/get-days-count']) . "',
     data: { 
         'uid' : uid,         
     },            
         dataType: 'json',
         success: function (data) {                  
          total_present_days = Number(data);;
           // console.log(data);                        
     },
         error: function (errormessage) {                
         console.log('not working ');                
     }
});

}

//GETTING USER'S CURRENT CTC

function getCtc(uid){
 $.ajax({
     type: 'GET',
     url: '" . \yii\helpers\Url::to(['/salary/get-ctc']) . "',
     data: { 
         'uid' : uid,         
     },            
         dataType: 'json',
         success: function (ctc) {   
         console.log(gross);                                                       
            $('#salary-ctc').val(ctc);                              
            gross0 = (Number(ctc) * total_present_days / total_month_days);
            gross = Math.floor(gross0);           
            $('#gross').text('Gross Amount: Rs. '+ gross);                                     
     },
         error: function (errormessage) {                
         console.log('not working ');                
     }
});
}

//CALCULATING 

$('#salary-ctc').on('keyup keydown keypress change', function (event) {      
     var salary = Number($(this).val());
     tds_value = tds / 100 * gross;
     gross0 = (Number(salary) * total_present_days / total_month_days);
     gross = Math.floor(gross0);
     $('#gross').text('Gross-1 Amount: Rs. '+ gross); 
     
});


//CALCULATING TDS

$('#salary-tds').on('keyup keydown keypress', function (event) {
    tds = Number($(this).val());
     tds_value = tds / 100 * gross;
     gross1 = Math.floor(gross - tds_value);     
     $('#gross-1').text('Gross-1 Amount: Rs. '+ gross1); 
});

//CALCULATING PT

$('#salary-pt').on('keyup keydown keypress', function (event) {
    pt = Number($(this).val());
     pt_value = (gross1 - pt);
     gross2 = Math.floor(pt_value);     
     $('#gross-2').text('Gross-2 Amount: Rs. '+ gross2); 
});


//CALCULATING PF

$('#salary-pf').on('keyup keydown keypress', function (event) {
    var pf = Number($(this).val());    
     gross3 = Math.floor(gross2 - pf);     
     $('#gross-3').text('Gross-3 Amount: Rs. '+ gross3); 
});

//CALCULATING ESI

$('#salary-esi').on('keyup keydown keypress', function (event) {
    var esi = Number($(this).val());    
     gross4 = Math.floor(gross3 - esi);     
     $('#gross-4').text('Gross-4 Amount: Rs. '+ gross4); 
}); 

//CALCULATING INCENTIVES

$('#salary-incentive').on('keyup keydown keypress', function (event) {
    var incentive = Number($(this).val());    
     gross5 = Math.floor(gross4 + incentive);     
     $('#gross-5').text('Gross-5 Amount: Rs. '+ gross5); 
}); 

//CALCULATING BONUS

$('#salary-bonus').on('keyup keydown keypress', function (event) {
    var bonus = Number($(this).val());    
     gross6 = Math.floor(gross5 + bonus);     
     $('#gross-6').text('Gross-6 Amount: Rs. '+ gross6); 
}); 
", \yii\web\View::POS_END);
?>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\helpers\AppHelper;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\Quotation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="quotation-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'client_id')->dropDownList(AppHelper::getClients(), ['class' => 'form-control select4', 'prompt' => 'Please Select']) ?>

    <?= $form->field($model, 'county_id')->dropDownList(AppHelper::getCountries(), ['class' => 'form-control select4', 'prompt' => 'Please Select','onchange'=> '$.post( "'.Yii::$app->urlManager->createUrl('clients/state-list?id=').'"+$(this).val(), function( data ) {
                    $( "#quotation-state_id" ).html( data );
                });
            ']) ?>


    <?= $form->field($model, 'state_id')->dropDownList(AppHelper::getStates(), ['class' => 'form-control select4', 'prompt' => 'Please Select','onchange'=> '$.post( "'.Yii::$app->urlManager->createUrl('clients/city-list?id=').'"+$(this).val(), function( data ) {
                    $( "#quotation-city_id" ).html( data );
                });
            ']) ?>

    <?= $form->field($model, 'city_id')->dropDownList(AppHelper::getCity(), ['class' => 'form-control select4', 'prompt' => 'Please Select']) ?>

    <?= $form->field($model, 'payment_terms')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'delivery_period')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'inquiry_remark')->textarea(['rows' => 6]) ?>

    <div class="row">

            <div id="ajax-document"></div>

            <?php if (!$model->isNewRecord): ?>
                <?php $quote_product = \app\models\QuotationProducts::find()->where(['quotation_id' => $model->quotation_id])->all(); ?>
                <?php $newProduct = new \app\models\QuotationProducts(); ?>
                <?php //debugPrint($quote_product);  ?>
                <?php foreach ($quote_product as $key => $product): ?>
                    <?php $i = $key . rand(); ?>

                    <div class="animated bounceInRight create-po document-form" id="<?= $i ?>">
                        <div class="row">

                            <div class="col-md-4">
                                <label for="quotation-products-service_id-<?= $i ?>"> Product </label>
                                <?= Html::activeDropDownList($newProduct, 'service_id[]', AppHelper::getServices(), ['value' => $product->service_id, 'class' => 'form-control select4', 'required' => true, 'prompt' => 'Please Select', 'id' => 'quotation-products-service_id-' . $i,]) ?>
                            </div>


                            <div class="col-md-4">
                                <label for="quotation-products-quantity-<?= $i ?>">Quantity </label>
                                <?= Html::activeTextInput($newProduct, 'quantity[]', [
                                    'value' => $product->quantity,
                                    'maxlength' => true,
                                    'class' => 'form-control',
                                    'id' => 'quotation-products-quantity-' . $i,
                                    'required' => true,
                                    'type' => 'number'
                                ]);
                                ?>
                            </div>

                            <div class="col-md-4">
                                <label for="quotation-products-rate-<?= $i ?>"> Rate</label>
                                <?= Html::activeTextInput($newProduct, 'rate[]', [
                                    'value' => $product->rate,
                                    'maxlength' => true,
                                    'class' => 'form-control',
                                    'id' => 'quotation-products-rate-' . $i,
                                    'required' => true,
                                    'type' => 'number'
                                ]);
                                ?>
                            </div>

                            <div class="col-md-4">
                                <label for="quotation-products-gst-<?= $i ?>">Gst Rate % </label>
                                <?= Html::activeTextInput($newProduct, 'gst[]', [
                                    'value' => $product->gst,
                                    'maxlength' => true,
                                    'dataid' => $i,
                                    'class' => 'form-control gstrate',
                                    'id' => 'quotation-products-gst-' . $i,
                                    'required' => true,
                                    'type' => 'number',
                                    'onblur' => 'gstcalculate(this)',
                                ]);
                                ?>
                            </div>

                            <div class="col-md-4">
                                <label for="quotation-products-sgst-<?= $i ?>"> SGST</label>
                                <?= Html::activeTextInput($newProduct, 'sgst[]', [
                                    'value' => $product->sgst,
                                    'maxlength' => true,
                                    'class' => 'form-control',
                                    'id' => 'quotation-products-sgst-' . $i,
                                    'required' => true,
                                    'type' => 'text',
                                    'readonly' => true,
                                ]);
                                ?>
                            </div>

                            <div class="col-md-4">
                                <label for="quotation-products-cgst-<?= $i ?>"> CGST</label>
                                <?= Html::activeTextInput($newProduct, 'cgst[]', [
                                    'value' => $product->cgst,
                                    'maxlength' => true,
                                    'class' => 'form-control',
                                    'id' => 'quotation-products-cgst-' . $i,
                                    'required' => true,
                                    'type' => 'text',
                                    'readonly' => true,
                                ]);
                                ?>
                            </div>

                            <div class="col-md-4">
                                <label for="quotation-products-igst-<?= $i ?>"> ISGT</label>
                                <?= Html::activeTextInput($newProduct, 'igst[]', [
                                    'value' => $product->igst,
                                    'maxlength' => true,
                                    'class' => 'form-control',
                                    'id' => 'quotation-products-igst-' . $i,
                                    'required' => true,
                                    'type' => 'text',
                                    'readonly' => true,
                                ]);
                                ?>
                            </div>

                            <div class="col-md-4">
                                <label for="quotation-products-total_gst-<?= $i ?>">Total GST</label>
                                <?= Html::activeTextInput($newProduct, 'total_gst[]', [
                                    'value' => $product->total_gst,
                                    'maxlength' => true,
                                    'class' => 'form-control',
                                    'id' => 'quotation-products-total_gst-' . $i,
                                    'required' => true,
                                    'type' => 'text',
                                    'readonly' => true,
                                ]);
                                ?>
                            </div>

                            <div class="col-md-4">
                                <label for="quotation-products-total_amount-<?= $i ?>"> Total Amount</label>
                                <?= Html::activeTextInput($newProduct, 'total_amount[]', [
                                    'value' => $product->total_amount,
                                    'maxlength' => true,
                                    'class' => 'form-control',
                                    'id' => 'quotation-products-total_amount-' . $i,
                                    'required' => true,
                                    'type' => 'text',
                                    'readonly' => true,
                                ]);
                                ?>
                            </div>

                            <div class="col-md-1">
                                <br>
                                <button class="btn btn-danger"
                                        onclick="ajaxform.removeBlankFloatForm('<?php echo $i ?>')">Remove
                                </button>
                            </div>


                        </div>
                    </div>
                <?php endforeach; ?>

            <?php endif; ?>

        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <a id="add-product"
                   onclick="ajaxform.addFloatForm('<?= Url::to(['quotation/get-float-form'], true) ?>','ajax-document')"
                   href="javascript:;"
                   class="btn btn-info col-md-12">Add More Product</a>
            </div>

        </div>

        <br>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
if ($model->isNewRecord) {
$this->registerJs("
    $('#add-product').trigger('click');
", \yii\web\View::POS_END);
}
?>
<?php
$this->registerJs("$('.select4').select2({placeholder: 'Please Select',});", \yii\web\View::POS_END);
?>

<?php
$this->registerJs("
    $('input[type=number]').on(
    {
        keydown: function(e)
        {
            if (e.which === 32)
                return false;
        },
        change: function()
        {
            this.value = this.value.replace(/\s/g, '');
        }
    });
    function gstcalculate(element)
    {
        //console.log($(element).attr('dataid'));
        // var id=$(this).attr('field-id');
        // alert(id);

        var id = $(element).attr('dataid');
        var qty = $('#quotation-products-quantity-'+id).val();
        var rate = $('#quotation-products-rate-'+id).val();
        //var gstrate = $('#quotation-products-gst-'+id).val();
        var gstrate = $(element).val();
        var state = $('#orderquotation-state_id').find(':selected').val();
        console.log('state'+state);
        console.log('qty'+qty);
        console.log('rate'+rate);
        console.log('gstrate'+gstrate);
        
        var ptotal = parseFloat(qty) * parseFloat(rate);
        console.log('product total:'+ptotal);
        var totalgst = (parseFloat(ptotal) * parseFloat(gstrate)) / 100;
        console.log('total gst:'+totalgst);
        if (ptotal >= 1)
        {
            if(state != '')
            {
                if(state == '12')
                {
                    var sgst= parseFloat(totalgst) / parseFloat(2);
                    var cgst= parseFloat(totalgst) / parseFloat(2);
                    console.log('total sgst:'+sgst);
                    console.log('total cgst:'+cgst);
                    $('#quotation-products-sgst-'+id).val(sgst);
                    $('#quotation-products-cgst-'+id).val(cgst);
                    $('#quotation-products-igst-'+id).val(0);
                }
                else
                {
                    $('#quotation-products-sgst-'+id).val(0);
                    $('#quotation-products-cgst-'+id).val(0);
                    $('#quotation-products-igst-'+id).val(totalgst);
                }
                var  totalamount = parseFloat(ptotal) + parseFloat(totalgst);
                console.log('total Amount with gst:'+totalamount);
                $('#quotation-products-total_gst-'+id).val(totalgst.toFixed(2));
                $('#quotation-products-total_amount-'+id).val(totalamount.toFixed(2));
            }
            else
            {
                alert('Please Select State or City First');
                $('#quotation-products-quantity-'+id).val('');
                $('#quotation-products-rate-'+id).val('');
                $('#quotation-products-gst-'+id).val('');
                $('#quotation-products-sgst-'+id).val('');
                $('#quotation-products-cgst-'+id).val('');
                $('#quotation-products-igst-'+id).val('');
                $('#quotation-products-total_gst-'+id).val('');
                $('#quotation-products-total_amount-'+id).val('');
                $('#orderquotation-state_id').focus();
            }
            
        }    
        else
        {
            alert('please input quantity or rate or Gst Rate');
            $('#quotation-products-quantity-'+id).val('');
            $('#quotation-products-rate-'+id).val('');
            $('#quotation-products-gst-'+id).val('');
            $('#quotation-products-sgst-'+id).val('');
            $('#quotation-products-cgst-'+id).val('');
            $('#quotation-products-igst-'+id).val('');
            $('#quotation-products-total_gst-'+id).val('');
            $('#quotation-products-total_amount-'+id).val('');
            $('#quotation-products-quantity-'+id).focus();
        }
    }
    
    
     $('#isQuoteIncluded').change(function() {
        if($(this).is(':checked')) {            
           $('.quotations').fadeIn(1000);
        } 
        if(!$(this).is(':checked')) {            
           $('.quotations').fadeOut();
        }
        
    });
    
    
", \yii\web\View::POS_END);
?>
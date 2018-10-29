<?php

use app\helpers\AppHelper;
use yii\helpers\Html;


?>
<div class="col-md-6">
<div class="animated bounceInRight create-po document-form" id="<?= $i ?>">
    
    <div class="row">

        <div class="col-md-10">
            <label for="clients-mobile-<?= $i ?>"> Mobile </label>
            <?= Html::activeTextInput($model, 'client_mobile[]', [
                'maxlength' => true,
                'class' => 'form-control',
                'id' => 'clients-mobile-' . $i,
                'required' => true,
                'type'=>'number'

            ]);
            ?>

        </div>

        <div class="col-md-2">
            <br>
            <button class="btn btn-danger" onclick="ajaxform.removeBlankFloatForm('<?php echo $i ?>')">Remove</button>
        </div>
    </div>
</div>
</div>

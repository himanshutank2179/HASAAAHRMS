<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\fileupload\FileUpload;
use kartik\file\FileInput;
use yii\helpers\Url;
use app\helpers\AppHelper;

//\app\assets\SelectAsset::register($this);
//app\assets\DatePickerAsset::register($this);
/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="users-form content-header">

    <?php $form = ActiveForm::begin(); ?>


    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
        </div>
    </div>


    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'dob')->textInput(['class' => 'form-control datepicker']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>
    </div>


    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
        </div>
    </div>


    <div class="row">

        <div class="col-md-6">

            <label>
                Profile Picture
            </label>
            <br/>

            <?php
            echo FileUpload::widget([
                'name' => 'Users[photo]',
                'url' => [
                    '/uploads/common?attribute=Users[photo]'
                ],
                'options' => [
                    'accept' => 'image/*',
                ],
                'clientOptions' => [
                    'dataType' => 'json',
                    'maxFileSize' => 2000000,
                ],
                'clientEvents' => [
                    'fileuploadprogressall' => "function (e, data) {
                                        var progress = parseInt(data.loaded / data.total * 100, 10);
                                        $('#progress').show();
                                        $('#progress .progress-bar').css(
                                            'width',
                                            progress + '%'
                                        );
                                     }",
                    'fileuploaddone' => 'function (e, data) {
                                        if(data.result.files.error==""){
                                            
                                            var img = \'<br/><img class="img-responsive" src="' . yii\helpers\BaseUrl::home() . 'uploads/\'+data.result.files.name+\'" alt="img" style="width:256px;"/>\';
                                            $("#profile_pic").html(img);
                                            $(".field-users-photo input[type=hidden]").val(data.result.files.name);$("#progress .progress-bar").attr("style","width: 0%;");
                                            $("#progress").hide();
                                        }
                                        else{
                                           $("#progress .progress-bar").attr("style","width: 0%;");
                                           $("#progress").hide();
                                           var errorHtm = \'<span style="color:#dd4b39">\'+data.result.files.error+\'</span>\';
                                           $("#profile_pic").html(errorHtm);
                                           setTimeout(function(){
                                               $("#profile_pic span").remove();
                                           },3000)
                                        }
                                    }',
                ],
            ]);
            ?>
            <!--                <lable class="text-info"> Image size should be 700 X 466 px</lable>-->
            <br>
            <div id="progress" class="progress" style="display: none;">
                <div class="progress-bar progress-bar-success"></div>
            </div>
            <div id="profile_pic">
                <?php
                if (!$model->isNewRecord) {
                    ?>
                    <br/><img
                            src="<?php echo yii\helpers\BaseUrl::home() ?>uploads/<?php echo $model->photo ?>"
                            alt="img" style="width:256px;"/>
                    <?php
                }
                ?>
            </div>
            <?php echo $form->field($model, 'photo')->hiddenInput()->label(false); ?>

        </div>

        <div class="row">
            <div class="col-md-6"><?= $form->field($model, 'user_role')->dropDownList(AppHelper::getUserRoles(), ['prompt' => 'Please Select Role', 'class' => 'form-control select2']); ?></div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'temp_address')->textarea(['rows' => 6]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'perm_address')->textarea(['rows' => 6]) ?>
        </div>
    </div>


    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'bank_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'account_number')->textInput() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'ifsc')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'ctc')->textInput() ?>
        </div>

    </div>

    <div class="row">
        <div class="col-md-6">

            <label>
                Passport
            </label>
            <br/>

            <?php
            echo FileUpload::widget([
                'name' => 'Users[passport]',
                'url' => [
                    'uploads/common?attribute=Users[passport]'
                ],
                'options' => [
                    'accept' => 'image/*',
                ],
                'clientOptions' => [
                    'dataType' => 'json',
                    'maxFileSize' => 2000000,
                ],
                'clientEvents' => [
                    'fileuploadprogressall' => "function (e, data) {
                                        var progress = parseInt(data.loaded / data.total * 100, 10);
                                        $('#progress').show();
                                        $('#progress .progress-bar').css(
                                            'width',
                                            progress + '%'
                                        );
                                     }",
                    'fileuploaddone' => 'function (e, data) {
                                        if(data.result.files.error==""){
                                            
                                            var img = \'<br/><img class="img-responsive" src="' . yii\helpers\BaseUrl::home() . 'uploads/\'+data.result.files.name+\'" alt="img" style="width:256px;"/>\';
                                            $("#passport").html(img);
                                            $(".field-users-passport input[type=hidden]").val(data.result.files.name);$("#progress .progress-bar").attr("style","width: 0%;");
                                            $("#progress").hide();
                                        }
                                        else{
                                           $("#progress .progress-bar").attr("style","width: 0%;");
                                           $("#progress").hide();
                                           var errorHtm = \'<span style="color:#dd4b39">\'+data.result.files.error+\'</span>\';
                                           $("#passport").html(errorHtm);
                                           setTimeout(function(){
                                               $("#passport span").remove();
                                           },3000)
                                        }
                                    }',
                ],
            ]);
            ?>
            <!--            <lable class="text-info">  Image size should be 700 X 466 px</lable><br>-->
            <div id="progress" class="progress" style="display: none;">
                <div class="progress-bar progress-bar-success"></div>
            </div>
            <div id="passport">
                <?php
                if (!$model->isNewRecord) {
                    ?>
                    <br/><img src="<?php echo yii\helpers\BaseUrl::home() ?>uploads/<?php echo $model->passport ?>"
                              alt="img" style="width:256px;"/>
                    <?php
                }
                ?>
            </div>
            <?php echo $form->field($model, 'passport')->hiddenInput()->label(false); ?>

        </div>

        <div class="col-md-6">

            <label>
                Experience Latter
            </label>
            <br/>

            <?php
            echo FileUpload::widget([
                'name' => 'Users[exp_latter]',
                'url' => [
                    'uploads/common?attribute=Users[exp_latter]'
                ],
                'options' => [
                    'accept' => 'image/*',
                ],
                'clientOptions' => [
                    'dataType' => 'json',
                    'maxFileSize' => 2000000,
                ],
                'clientEvents' => [
                    'fileuploadprogressall' => "function (e, data) {
                                        var progress = parseInt(data.loaded / data.total * 100, 10);
                                        $('#progress').show();
                                        $('#progress .progress-bar').css(
                                            'width',
                                            progress + '%'
                                        );
                                     }",
                    'fileuploaddone' => 'function (e, data) {
                                        if(data.result.files.error==""){
                                            
                                            var img = \'<br/><img class="img-responsive" src="' . yii\helpers\BaseUrl::home() . 'uploads/\'+data.result.files.name+\'" alt="img" style="width:256px;"/>\';
                                            $("#exp-latter").html(img);
                                            $(".field-users-exp_latter input[type=hidden]").val(data.result.files.name);$("#progress .progress-bar").attr("style","width: 0%;");
                                            $("#progress").hide();
                                        }
                                        else{
                                           $("#progress .progress-bar").attr("style","width: 0%;");
                                           $("#progress").hide();
                                           var errorHtm = \'<span style="color:#dd4b39">\'+data.result.files.error+\'</span>\';
                                           $("#exp-latter").html(errorHtm);
                                           setTimeout(function(){
                                               $("#exp-latter span").remove();
                                           },3000)
                                        }
                                    }',
                ],
            ]);
            ?>
            <!--            <lable class="text-info">  Image size should be 700 X 466 px</lable><br>-->
            <div id="progress" class="progress" style="display: none;">
                <div class="progress-bar progress-bar-success"></div>
            </div>
            <div id="exp-latter">
                <?php
                if (!$model->isNewRecord) {
                    ?>
                    <br/><img src="<?php echo yii\helpers\BaseUrl::home() ?>uploads/<?php echo $model->exp_latter ?>"
                              alt="img" style="width:256px;"/>
                    <?php
                }
                ?>
            </div>
            <?php echo $form->field($model, 'exp_latter')->hiddenInput()->label(false); ?>

        </div>
    </div>


    <div class="row">

        <div class="col-md-12">
            <?php
            $previewImg = array();
            $initialPreviewConfig = array();

            if (!$model->isNewRecord) {

                $modelImage = app\models\Identity::find()->where(['user_id' => $model->user_id])->all();

                if (!empty($modelImage)) {

                    foreach ($modelImage as $user_image) {
                        $prev = Html::img(yii\helpers\BaseUrl::home() . "uploads/" . $user_image->image, ['class' => 'file-preview-image img-responsive', 'alt' => 'img']);
                        $a = Html::hiddenInput("Users[images][]", $user_image->image, [
                            'id' => 'users-users_images'
                        ]);
                        array_push($previewImg, $prev);

                        $b = ['url' => yii\helpers\BaseUrl::home() . "uploads/filedelete", 'key' => $user_image->identity_id];
                        array_push($initialPreviewConfig, $b);
                    }
                }
            }

            echo $form->field($model, 'images')->widget(FileInput::classname(), [
                'options' => [
                    'accept' => 'image/*',
                    'multiple' => true,
                ],
                'pluginOptions' => [
                    'uploadUrl' => Url::to(['/uploads/identity-upload']),
                    'FileCount' => 10,
                    'initialPreview' => $previewImg,
                    'initialPreviewConfig' => $initialPreviewConfig,
                    'overwriteInitial' => false
                ],
                'pluginEvents' => [
                    'fileimageloaded' => 'function(event, previewId) {
                                    //console.log(event);
                                }'
                ]
            ])->label(Yii::t('app', 'Documents'));
            ?>
            <div style="color: #dd4b39" id="upload_error" class="help-block"></div>
        </div>

    </div>

    <?= $form->field($model, 'created_at', ['inputOptions' => ['value' => date('Y-m-d H:i:s')]])->hiddenInput()->label(false) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$this->registerJs("$('.select2').select2({placeholder: \"Please Select\",});", \yii\web\View::POS_END, 'select-picker');
$this->registerJs('$("#users-images").on("fileuploaded", function (event, data, previewId, index) {
                                                                            $("#" + previewId).append(\'<input type="hidden" name="Users[images][]" id="users-users_images" value="\'+data.response.image+\'">\');
                                                                        });', \yii\web\View::POS_END);
$this->registerJs("$('.datepicker').datepicker({
        autoclose: true,
        format: \"yyyy-mm-dd\",        
        todayBtn: 'linked',
        todayHighlight: true});", \yii\web\View::POS_END, 'date-picker');
?>


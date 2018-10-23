<?php

use dosamigos\fileupload\FileUpload;
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
            <?= $form->field($model, 'project_type_id')->dropDownList(AppHelper::getProjectTypes(), ['class' => 'form-control', 'prompt' => 'Please Select']) ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'service_id')->dropDownList(AppHelper::getServices(), ['class' => 'form-control', 'prompt' => 'Please Select']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'designing_start')->textInput(['class' => 'form-control datepicker']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'designing_end')->textInput(['class' => 'form-control datepicker']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'developing_start')->textInput(['class' => 'form-control datepicker']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'developing_end')->textInput(['class' => 'form-control datepicker']) ?>
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

        <div class="col-md-6">

            <label>
                Project Picture
            </label>
            <br/>

            <?php
            echo FileUpload::widget([
                'name' => 'Projects[image]',
                'url' => [
                    '/uploads/common?attribute=Projects[image]'
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
                                            console.log(data.result.files.name);
                                            var img = \'<br/><img class="img-responsive img-thumbnail" src="' . yii\helpers\BaseUrl::home() . 'uploads/\'+data.result.files.name+\'" alt="img" style="width:256px;"/>\';
                                            $("#profile_pic").html(img);
                                            $(".field-projects-image input[type=hidden]").val(data.result.files.name);$("#progress .progress-bar").attr("style","width: 0%;");
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
            <br> <br>
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
            <?php echo $form->field($model, 'image')->hiddenInput()->label(false); ?>

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
//        'startDate': 'today',        
        todayHighlight: true});", \yii\web\View::POS_END, 'date-picker');
?>

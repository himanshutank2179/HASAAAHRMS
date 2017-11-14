<?php

use kartik\sortable\Sortable;

/**
 * Created by PhpStorm.
 * User: himanshu
 * Date: 8/30/2017
 * Time: 3:23 PM
 */

//debugPrint($checklist);
//echo Yii::$app->session->get('project_id');
//echo  Yii::$app->getRequest()->getQueryParam('task_id');
?>
<div class="container-fluid">

    <!--    Task Check list Area-->
    <div class="col-md-6">

        <?php $form = \yii\widgets\ActiveForm::begin([
            'id' => 'checklist-form',
        ]); ?>
        <?= $form->field($clist, 'list_item')->textInput(['maxlength' => true, 'placeholder' => 'enter your check list']) ?>

        <?= $form->field($clist, 'project_id')->hiddenInput(['value' => Yii::$app->session->get('project_id')])->label(false); ?>

        <?= $form->field($clist, 'task_id')->hiddenInput(['value' => Yii::$app->getRequest()->getQueryParam('task_id')])->label(false) ?>

<!--        <input type="reset" value="Reset" class="btn btn-success">-->

        <?php \yii\widgets\ActiveForm::end(); ?>


        <div class="panel panel-bd lobidrag lobipanel lobipanel-sortable" data-inner-id="6tBo42L900" data-index="0">
            <div class="panel-heading ui-sortable-handle">
                <div class="panel-title">
                    <h4>Check List</h4>
                </div>
            </div>
            <div class="panel-body">
                <div class="dd" id="nestable3">
                    <?php
                    $itms = [];
                    foreach ($checklist as $cl):

                        $ii = ['content' => '<div class="dd-handle dd3-handle"></div>
                        <div class="dd3-content">
                        ' . $cl->list_item . '
                        </div>'];

                        array_push($itms, $ii);
                    endforeach;

                    ?>
                    <?php
                    echo Sortable::widget([
                        'type' => Sortable::TYPE_LIST,
                        'id' => 'chk-list',
                        'options' => ['class' => 'dd-list'],
                        'itemOptions' => ['class' => 'dd-item dd3-item'],
                        'items' =>
                            $itms
                    ]);
                    ?>

                </div>
            </div>
        </div>

    </div>

    <!--    Task Comments Area-->
    <div class="col-md-6">
        <?php $form = \yii\widgets\ActiveForm::begin([
            'id' => 'comment-form',
        ]); ?>
        <?= $form->field($comentModel, 'comment')->textInput(['maxlength' => true, 'placeholder' => 'enter your Comment'])->label('Place Your Comments Here'); ?>

        <?= $form->field($comentModel, 'user_id')->hiddenInput(['value' => \Yii::$app->user->getId()])->label(false); ?>

        <?= $form->field($comentModel, 'project_id')->hiddenInput(['value' => Yii::$app->session->get('project_id')])->label(false); ?>

        <?= $form->field($comentModel, 'task_id')->hiddenInput(['value' => Yii::$app->getRequest()->getQueryParam('task_id')])->label(false) ?>

        <?php \yii\widgets\ActiveForm::end(); ?>


        <div class="panel panel-bd lobidrag lobipanel lobipanel-sortable" data-inner-id="6tBo42L900" data-index="0">
            <div class="panel-heading ui-sortable-handle">
                <div class="panel-title">
                    <h4>Comments</h4>
                </div>
            </div>

            <div class="message_widgets">
                <?php foreach ($comments as $c): ?>
                    <a href="#">
                        <div class="inbox-item">
                            <div class="inbox-item-img"><img
                                        src="<?= Yii::getAlias('@web') . '/uploads/' . $c->user->photo; ?>"
                                        class="img-circle" alt=""></div>
                            <strong class="inbox-item-author"><?= $c->user->first_name ?></strong>
                            <span class="inbox-item-date">- <?php
                                $date = date_create($c->created_date);
                                echo date_format($date, "d M  h:i a");
                                ?></span>
                            <p class="inbox-item-text"><?= $c->comment ?></p>

                        </div>
                    </a>
                <?php endforeach; ?>

            </div>
        </div>
    </div>
</div>


<?php
$this->registerJs("
$('.dd-list').removeClass(\"sortable\");

//SUBMMITING CHECKLIST FORM DATA USING AJAX

 $('body').on('beforeSubmit', 'form#checklist-form', function (e) {
   e.preventDefault();
           // var form = $(this);
          //  console.log(form);
            // return false if form still have some validation errors
            if ($(this).find('.has-error').length) 
            {
                return false;
            }
            // submit form
            $.ajax({
            url    : baseUrl + 'projects/create-checklist',
            type   : 'post',
            async:false,
            data   : $(this).serialize(),
            success: function (response) 
            {
               
               if(response){   
                          
                   $('#checklist-list_item').val('');                    
                   $('ul#chk-list').append(response);         
                    setTimeout(function () {
                        toastr.options = {
                        closeButton: true,
                        progressBar: true,
                        showMethod: 'slideDown',
                        timeOut: 4000,
                         positionClass: \"toast-top-left\"
                        };
                        toastr.success('Check list Item Added', 'Checklist Added Succesully.');
                    }, 1000);                                                                    
             }               
            },
            error  : function () 
            {
                console.log('internal server error');
            }
            });
            return false;
         });               
         
         //SUBMMITING COMMENTS FORM DATA USING AJAX     
         
         $('body').on('beforeSubmit', 'form#comment-form', function (e) {
            e.preventDefault();
            var formComent = $(this);
            // return false if form still have some validation errors
            if (formComent.find('.has-error').length) 
            {
                return false;
            }
            // submit form
            $.ajax({
            url    : baseUrl + 'projects/create-task-comment',
            type   : 'post',
            async:false,
            data   : formComent.serialize(),
            success: function (response) 
            {
            
               if(response){        
                       
                   $('#taskcomment-comment').val('');
                   $('.message_widgets').append(response);         
                    setTimeout(function () {
                        toastr.options = {
                        closeButton: true,
                        progressBar: true,
                        showMethod: 'slideDown',
                        timeOut: 4000,
                         positionClass: \"toast-top-left\"
                        };
                        toastr.success('Okay', 'Your comment placed.');
                    }, 1000);                                                                    
             }               
            },
            error  : function () 
            {
                console.log('internal server error');
            }
            });
            return false;
         });         

", \yii\web\View::POS_END);
?>






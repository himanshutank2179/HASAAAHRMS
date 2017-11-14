<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-bd">
    <div class="panel-heading">
        <div class="view-header">
            <div class="header-icon">
                <i class="pe-7s-unlock"></i>
            </div>
            <div class="header-title">
                <h3>Login</h3>
                <small><strong>Please enter your credentials to login.</strong></small>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            //'layout' => 'horizontal',
            'fieldConfig' => [
                'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                'labelOptions' => ['class' => 'col-lg-1 control-label'],
            ],
        ]); ?>
        <?= $form->errorSummary($model); ?>

            <div class="form-group">
                <label class="control-label">Username</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input type="text" id="loginform-username" class="form-control" name="LoginForm[username]" placeholder="Username" aria-required="true">
                </div>
                <span class="help-block small">Your unique username to app</span>
            </div>
            <div class="form-group">
                <label class="control-label">Password</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>

                    <input type="password" id="loginform-password" class="form-control" name="LoginForm[password]" placeholder="******" aria-required="true">
                </div>
                <span class="help-block small">Your unique Password to app</span>
            </div>
            <div>
                <button class="btn btn-primary pull-right">Login</button>
                <div class="checkbox checkbox-success">
                    <?= $form->field($model, 'rememberMe')->checkbox([
                        'template' => "<div class=\"col-lg-12\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
                    ]) ?>
                </div>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
<div id="bottom_text">
    Don't have an account? <a href="register.html">Sign Up</a><br>
    Remind <a href="forget_password.html">Password</a>
</div>
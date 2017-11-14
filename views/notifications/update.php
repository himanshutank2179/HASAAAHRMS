<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Notifications */

$this->title = 'Update Notifications: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Notifications', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->notification_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="notifications-update content-header">

    <div class="box box-primary">
        <div class="box-body">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>
</div>

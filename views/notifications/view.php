<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Notifications */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Notifications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notifications-view content-header">

    <div class="box box-primary">
        <div class="box-body">

            <p>
                <?php Html::a('Update', ['update', 'id' => $model->notification_id], ['class' => 'btn btn-primary']) ?>
                <?php Html::a('Delete', ['delete', 'id' => $model->notification_id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    //'notification_id',
                    //'project_id',
                    'title',
                    'description:ntext',
                    //'action_type',
                    //'user_id',
                    'date',
                ],
            ]) ?>

        </div>
    </div>
</div>

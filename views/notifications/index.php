<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NotificationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Notifications';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notifications-index content-header">

    <div class="box box-primary">
        <div class="box-body">
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <p>
                <?= Html::a('Create Notifications', ['create'], ['class' => 'btn btn-success']) ?>
            </p>
            <?php Pjax::begin(); ?>    <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'notification_id',
                    //'project_id',
                    'title',
                    'description:ntext',
                    //'action_type',
                    // 'user_id',
                    // 'date',
                    [
                        'attribute' => 'is_push',
                        'value' => function ($model) {
                            return $model->is_push == 0 ? 'No' : 'Yes';
                        }
                    ],

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{delete}' //update,view,delete
                    ],
                ],
            ]); ?>
            <?php Pjax::end(); ?></div>
    </div>
</div>


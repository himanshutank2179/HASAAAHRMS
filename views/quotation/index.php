<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\helpers\AppHelper;
/* @var $this yii\web\View */
/* @var $searchModel app\models\QuotationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Quotations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="quotation-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Quotation', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'quotation_id',
            [
                'attribute' => 'Client',
                'value' => function ($model) {
                    return !empty($model->client->name) ? $model->client->name : '';
                },
                'filter' => Html::activeDropDownList($searchModel, 'client_id', AppHelper::getClients(), ['class' => 'form-control select','prompt' => 'Filter By Client']),
            ],
            // 'county_id',
            // 'state_id',
            // 'city_id',
            'payment_terms:ntext',
            'delivery_period',
            'inquiry_remark:ntext',
            //'is_deleted',
            //'created_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>

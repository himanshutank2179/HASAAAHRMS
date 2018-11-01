<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Quotation */

$this->title = $model->client->name;
$this->params['breadcrumbs'][] = ['label' => 'Quotations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="quotation-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->quotation_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->quotation_id], [
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
            // 'quotation_id',
            [
                'attribute' => 'client_id',

                'value' => function ($data) {
                    return $data->client->name;
                },
            ],
            [
                'attribute' => 'city_id',

                'value' => function ($data) {
                    return $data->city->name;
                },
            ],
            [
                'attribute' => 'state_id',

                'value' => function ($data) {
                    return $data->state->name;
                },
            ],
            /*'country_id',*/
            [
                'attribute' => 'country_id',

                'value' => function ($data) {
                    return $data->county->name;
                },
            ],
            'payment_terms:ntext',
            'delivery_period',
            'inquiry_remark:ntext',
            // 'is_deleted',
            'created_at',
        ],
    ]) ?>

</div>

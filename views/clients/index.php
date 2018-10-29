<?php

use kartik\export\ExportMenu;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ClientsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Clients';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clients-index">

    <h3><?= Html::encode($this->title) ?></h3>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Clients', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php
    $gridColumns = [
        'name',
        'email:email',
        'account_number',
        'bank_ifsc',
        'gstin',
        'pan',
        'flat',
        'street',
        'landmark',
        'area',
        'city',
        'state',
        'statecode',
        'country',
    ];
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            /*'client_id',*/
            'name',
            'email:email',
            'account_number',
            'bank_ifsc',
            //'gstin',
            //'pan',
            //'flat',
            //'street',
            //'landmark',
            //'area',
            //'city',
            //'state',
            //'statecode',
            //'country',
            //'is_deleted',
            //'created_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'buttons' => [
                ],
            ]
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>

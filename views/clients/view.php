<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\ClientMobile;

/* @var $this yii\web\View */
/* @var $model app\models\Clients */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Clients', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clients-view">

    <h3><?= Html::encode($this->title) ?></h3>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->client_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->client_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Print', ['print', 'id' => $model->client_id], ['class' => 'btn btn-primary', 'target' => '_blank',]); ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'client_id',
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
            // 'city',
            // 'state',
            [
                'attribute' => 'city_id',

                'value' => function ($data) {
                    return $data->city->name;
                },
                'filter' => false
            ],
            [
                'attribute' => 'state_id',

                'value' => function ($data) {
                    return $data->state->name;
                },
                'filter' => false
            ],
            'statecode',
            /*'country_id',*/
            [
                'attribute' => 'country_id',

                'value' => function ($data) {
                    return $data->country->name;
                },
                'filter' => false
            ],
            
            // 'country',
            // 'is_deleted',
            // 'created_at',
        ],
    ]) ?>

</div>
<?php
$all_mobiles = ClientMobile::find()->where(['client_id' => $model->client_id])->all();
?>
<div class="row">
    <div class="col-md-6">
        <table id="w0" class="table table-striped table-bordered detail-view" >
            <tbody>
                <?php foreach ($all_mobiles as $mobile): ?>
                <tr>
                    <th>Mobile</th>
                    <td><?= $mobile->client_mobile  ?></td>
                </tr>
                <?php endforeach; ?>    
            </tbody>    
        </table>
    </div>
</div>
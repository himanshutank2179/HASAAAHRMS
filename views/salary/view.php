<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Salary */

$this->title = $model->salary_id;
$this->params['breadcrumbs'][] = ['label' => 'Salaries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="salary-view">

    <div class="box box-primary">
        <div class="box-body">

            <p>
                <?= Html::a('Update', ['update', 'id' => $model->salary_id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->salary_id], [
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
                    
                    [
                        'attribute'=>'user_id',
                        'value'=> function($model){
                                return $model->user->first_name;
                        }                        
                    ],
                    'ctc',
                    'tds',
                    'pt',
                    'pf',
                    'esi',
                    'incentive',
                    'bonus',
                    'extra_note:ntext',
                    'created_date',
                ],
            ]) ?>
        </div>
    </div>
</div>

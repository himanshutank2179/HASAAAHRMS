<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="users-view ">

    <div class="box box-primary">
        <div class="box-body">

            <p>
                <?= Html::a('Update', ['update', 'id' => $model->user_id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->user_id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>
            <?= Html::img(\yii\helpers\Url::to(['uploads/' . $model->photo], false), ['style' => 'max-width: 200px;']) ?>
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    //'user_id',
                    'username',
                    'email:email',
                    'dob',
                    'phone',
                    'mobile',
                    'temp_address:ntext',
                    'perm_address:ntext',
                    'bank_name',
                    'account_number',
                    'ifsc',

                    [
                        'attribute' => 'ctc',
                        'value' => function ($model) {
                            return number_format($model->ctc);
                        }
                    ],
                    'created_at',

//                    [
//                        'attribute' => 'role_id',
//                        'value' => function ($model) {
//                            return $model->roles->name;
//                        }
//                    ],
                    [
                        'attribute' => 'login_time',
                        'value' => !empty($model->login_time) ? $model->login_time : "No Data Available!"
                    ],

                    [
                        'attribute' => 'logout_time',
                        'value' => !empty($model->logout_time) ? $model->logout_time : "No Data Available!"
                    ],
                    [
                        'attribute' => 'passport',
                        'format' => 'raw',
                        'value' => Html::img(\yii\helpers\Url::to(['uploads/' . $model->passport], false), ['style' => 'max-width: 200px;'])
                    ],
                    [
                        'attribute' => 'exp_latter',
                        'format' => 'raw',
                        'value' => Html::img(\yii\helpers\Url::to(['uploads/' . $model->exp_latter], false), ['style' => 'max-width: 200px;'])
                    ],
                    [
                        'label' => 'Identity Images',
                        'value' => function ($model) {
                            $imgs='';
                            foreach ($model->identities as $img) {

                               $imgs .= Html::img(yii\helpers\BaseUrl::home() . 'uploads/' . $img->image, ['class' => ['pack-img', 'img-responsive']]);

                            }
                            return $imgs;
                        },
                        'format' => 'raw'
                    ]
                    //'is_deleted',
                ],
            ]) ?>

        </div>
    </div>



</div>


<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\helpers\AppHelper;
/* @var $this yii\web\View */
/* @var $searchModel app\models\SearchUsers */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-index">

    <div class="box box-primary content-header">
        <div class="box-body">
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <p>
                <?= Html::a('Create Users', ['create'], ['class' => 'btn btn-success']) ?>
            </p>
            <?php Pjax::begin(); ?>    <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'user_id',
                    'username',
                    [
                        'attribute' => 'photo',
                        'format' => 'html',
                        'value' => function ($data) {
                            return Html::img(Yii::getAlias('@web') . '/uploads/' . $data['photo'],
                                ['width' => '90px']);
                        },
                    ],
                    'email:email',
//                    [
//                        //'label' => 'Is Admin',
//                        'attribute' => 'role_id',
//                        'value' => function ($model) {
//                            return !empty($model->roles->name) ? $model->roles->name : '';
//                        },
//                        'filter' => Html::activeDropDownList($searchModel, 'role_id', AppHelper::getRoles(), ['class' => 'form-control select2', 'prompt' => 'Filter By Role']),
//                        //'visible' => (Yii::$app->getRequest()->getQueryParam('type') != 'admins') ? true : "",
//                    ],
                    //'dob',
                    // 'phone',
                    // 'mobile',
                    // 'temp_address:ntext',
                    // 'perm_address:ntext',
                    // 'bank_name',
                    // 'account_number',
                    // 'ifsc',
                    // 'identity_proof_id',
                    // 'passport',
                    // 'exp_latter',
                    // 'created_at',
                    // 'is_admin',
                    // 'login_time',
                    // 'logout_time',
                    // 'is_deleted',

                  //  ['class' => 'yii\grid\ActionColumn'],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => \mdm\admin\components\Helper::filterActionColumn('{view}{delete}{posting}'),
                    ]
                ],
            ]); ?>
            <?php Pjax::end(); ?></div>
    </div>
</div>

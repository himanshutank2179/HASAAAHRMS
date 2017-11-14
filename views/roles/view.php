<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Roles */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="roles-view">

    <div class="box box-primary">
        <div class="box-body">

            <p>
                <?= Html::a('Update', ['update', 'id' => $model->role_id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->role_id], [
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
                    //'role_id',
                    'name',
                    // 'is_deleted',
                ],
            ]) ?>

        </div>
    </div>

    <div class="box-body box-primary box col-md-4">
        <div class="col-md-4 bottom-20">
            <h4>Users Permissions</h4>
            <ul>
                <?php foreach ($model->usersPermissions as $perm): ?>

                    <li><label for=""><?= \app\models\Permissions::findOne($perm->permission_id)->name ?></label></li>
                <?php endforeach; ?>

            </ul>

        </div>
    </div>


</div>

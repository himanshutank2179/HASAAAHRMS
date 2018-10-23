<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProjectType */

$this->title = 'Update Project Type: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Project Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->project_type_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="project-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

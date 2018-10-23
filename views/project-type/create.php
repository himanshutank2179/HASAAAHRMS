<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProjectType */

$this->title = 'Create Project Type';
$this->params['breadcrumbs'][] = ['label' => 'Project Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

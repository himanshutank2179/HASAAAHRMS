<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Salary */

$this->title = 'Create Salary';
$this->params['breadcrumbs'][] = ['label' => 'Salaries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="salary-create content-header">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>

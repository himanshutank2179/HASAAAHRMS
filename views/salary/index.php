<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SalarySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Salaries';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="salary-index content-header">

    <div class="box box-primary">
        <div class="box-body">
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <p>
                <?= Html::a('Create Salary', ['create'], ['class' => 'btn btn-success popup']) ?>
            </p>
            <?php Pjax::begin(); ?>    <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    [
                        'attribute' => 'username',
                        'value' => 'user.first_name',
                    ],
                    'ctc',
//                    'tds',
//                    'pt',
//                    'pf',
//                    'esi',
//                    'incentive',
//                    'bonus',
                    //'extra_note:ntext',

                    [
                        'attribute' => 'created_date',
                        'value' => function ($model) {
                            $date = date_create($model->created_date);
                            return date_format($date, "d-m-Y");

                        }
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view} {update} {print}',
                        'buttons' => [
                            'print' => function ($url, $model) {
                                return Html::a('<span class="glyphicon glyphicon-print"></span>', \yii\helpers\Url::to(['salaryslip', 'id' => $model->salary_id]), ['target' => '_blank', 'data-pjax' => "0"]);
                            },
                        ],
                    ]
                ],
            ]); ?>
            <?php Pjax::end(); ?></div>
    </div>
</div>
<?php

\yii\bootstrap\Modal::begin([
    'id' => 'pModal',
    'size' => 'modal-md',
    'header' => '<h2>Create Salary</h2>',


]);

echo '<div id="modalContent"></div>';
\yii\bootstrap\Modal::end();

$this->registerJs("
var total_month_days = Number('" . date('t') . "');
$('.popup').click(function(e){
       e.preventDefault();      
       $('#pModal').modal('show')
                  .find('#modalContent')
                  .load($(this).attr('href')); 
                  $('#pModal').removeAttr('tabindex'); 
   });
   
//   $('.update').click(function(e){
//       e.preventDefault();      
//       $('#pModal').modal('show')
//                  .find('#modalContent')
//                  .load($(this).attr('href')); 
//                  $('#pModal').removeAttr('tabindex'); 
//   });
", \yii\web\View::POS_END);
?>

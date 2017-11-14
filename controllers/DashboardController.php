<?php

namespace app\controllers;

use app\helpers\AppHelper;
use app\models\Projects;
use app\models\Tasks;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\components\AccessRule;
use app\components\UserIdentity;
use yii\helpers\ArrayHelper;

class DashboardController extends \yii\web\Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        if ($action->id == 'filter-chart') {

            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }

    public function actionIndex()
    {

        return $this->render('index');
    }

    public function actionDaysByMonth($month)
    {
        if ($month) {
            $days = cal_days_in_month(CAL_GREGORIAN, $month, date('Y'));
        } else {
            $days = 30;
        }

        $d = array();
        for ($i = 1; $i <= $days; $i++)
            $d[] = $i;

        return json_encode($d);
    }

    public function getTaskCountById($project_id)
    {
        return Tasks::find()->where(['project_id' => $project_id, 'is_deleted' => 0])->count();
    }

    public function getCompletedTask($project_id)
    {
        return Tasks::find()->where(['project_id' => $project_id, 'is_deleted' => 0, 'status' => 'Complete'])->count();
    }

    public function getRemainingTask($project_id)
    {
        return Tasks::find()
            ->where(['project_id' => $project_id, 'is_deleted' => 0, 'status' => ['Not Started', 'Stuck', 'In Progress']])
            ->count();
    }

    public function actionFilterChart()
    {

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $request = Yii::$app->request->bodyParams;
         //debugPrint($request);
        // if (!empty($request)) {

        // }

        $projects = Projects::find()->where(['is_deleted' => 0]);

        if (isset($request['project_id']) && $request['project_id'] != "") {
            $projects->andWhere(['projects.project_id' => $request['project_id']]);
        }
        if (isset($request['user_id']) && $request['user_id'] != "") {
            $projects->join('left join', 'project_users', 'projects.project_id=project_users.project_id')
                ->andWhere(['project_users.user_id' => $request['user_id']]);
        }
        if (isset($request['year']) && $request['year'] != "") {
            //echo $request['year'];
            $projects->andWhere(['=', 'YEAR(deadline)', $request['year']]);
        }
        if (isset($request['month']) && $request['month'] != "") {
            $projects->andWhere(['MONTH(deadline)' => $request['month']]);
        }
        if (isset($request['day']) && $request['day'] != "") {
            $projects->andWhere(['DAY(deadline)' => $request['day']]);
        }

        $projects = $projects->all();

        if (!empty($projects)) {
            $data = array();
            foreach ($projects as $project) {
                //debugPrint($this->getTaskCountById($task->project_id));
                $d['date'] = date('Y-m-d', strtotime($project->deadline));
                $d['total_tasks'] = $this->getTaskCountById($project->project_id);
                $d['comp_tasks'] = $this->getCompletedTask($project->project_id);
                $d['remain_tasks'] = $this->getRemainingTask($project->project_id);
                array_push($data, $d);
            }
            return $data;
        } else {
            return [];
        }


    }

}

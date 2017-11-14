<?php

namespace app\controllers;

use app\helpers\AppHelper;
use app\models\Notified;
use app\models\Users;
use Yii;
use app\models\Notifications;
use app\models\NotificationsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * NotificationsController implements the CRUD actions for Notifications model.
 */
class NotificationsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Notifications models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NotificationsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Notifications model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Notifications model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Notifications();

        if ($model->load(Yii::$app->request->post())) {
            $model->date = date('Y-m-d H:i:s');

            //AppHelper::dd($model->notify_to);
            if ($model->save(false)) {
                if (empty($model->notify_to)) {
                    $users = Users::findAll(['is_deleted' => 0]);
                    foreach ($users as $u):
                        $notified = new \app\models\Notified();
                        $notified->user_id = $u->user_id;
                        $notified->notification_id = $model->notification_id;
                        $notified->date = date('Y-m-d H:i:s');
                        $notified->save();
                    endforeach;
                } else {
                    $users = $model->notify_to;
                    foreach ($users as $u):
                        $notified = new \app\models\Notified();
                        $notified->user_id = $u;
                        $notified->notification_id = $model->notification_id;
                        $notified->date = date('Y-m-d H:i:s');
                        $notified->save();
                    endforeach;
                }


            }
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Notifications model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->notification_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Notifications model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Notifications model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Notifications the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Notifications::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    // RealTime Notification System

    public function actionUpdateNotific()
    {


        $notifications = \app\models\Notified::find()->where(['is_read' => '0', 'user_id' => \Yii::$app->session['user_id']])->all();
        foreach ($notifications as $notification) {
            $notification->is_read = '1';
            //  $notification->read_date = date('Y-m-d H:i:s');
            if (!$notification->update(false)) {
                return print_r($notification->getErrors());
            }
        }
    }

    public function actionNotifyCount()
    {
        //complete

        return \app\models\Notified::find()
            //->join('left join', 'projects', 'notified.project_id = projects.project_id')
            ->join('left join', 'notifications', 'notified.notification_id = notifications.notification_id')
            ->where(['is_read' => '0', 'notified.user_id' => \Yii::$app->session['user_id']])->count();
        // ->andWhere(['!=', 'notifications.user_id', \Yii::$app->session['user_id']])->count();
    }

    public function actionGetRecentNotifications()
    {
        //complete
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;


//        return $notification = \app\models\Notifications::find()
//                        ->join('left join', 'projects', 'notifications.project_id = projects.project_id')
//                        ->join('left join', 'notified', 'notifications.notification_id = notified.notification_id')
//                        ->where(['projects.is_deleted' => 0, 'projects.is_published' => 1])
//                        ->andWhere(['!=', 'notifications.contractor_id', \Yii::$app->session['contractorId']])
//                        ->orderBy(['read_date' => SORT_DESC])->all();

        return \app\models\Notifications::find()
            ->join('left join', 'notified', 'notifications.notification_id = notified.notification_id')
            //  ->join('left join', 'projects', 'notifications.project_id = projects.project_id')
            ->where(['projects.is_deleted' => 0, 'notified.user_id' => \Yii::$app->session['user_id']])
            ->andWhere(['!=', 'notifications.user_id', \Yii::$app->session['user_id']])
            ->orderBy(['date' => SORT_DESC])->limit(4)->all();
    }


    public function actionTry()
    {
        $rr = \app\models\Notifications::find()
            ->join('left join', 'notified', 'notifications.notification_id = notified.notification_id')
            // ->join('left join', 'projects', 'notifications.project_id = projects.project_id')
            ->where(['notified.user_id' => \Yii::$app->session['user_id']])
            //->andWhere(['!=', 'notifications.user_id', \Yii::$app->session['user_id']])

            ->orderBy(['date' => SORT_DESC])->limit(4)->all();

        print_r($rr);
        exit();


    }

    public function actionGetNotifications()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;


//        return $notification = \app\models\Notifications::find()
//                        ->join('left join', 'projects', 'notifications.project_id = projects.project_id')
//                        ->where(['projects.is_deleted' => 0, 'projects.is_published' => 1, 'notifications.read' => 'N'])
//                        ->andWhere(['!=', 'notifications.contractor_id', \Yii::$app->session['contractorId']])
//                        ->orderBy(['read_date' => SORT_DESC])->all();

        return \app\models\Notifications::find()
            ->join('left join', 'notified', 'notifications.notification_id = notified.notification_id')
            //->join('left join', 'projects', 'notifications.project_id = projects.project_id')
            ->where(['notified.user_id' => \Yii::$app->session['user_id']])
            //->andWhere(['!=', 'notifications.user_id', \Yii::$app->session['user_id']])
            ->orderBy(['date' => SORT_DESC])->limit(4)->all();
    }

    public function actionGetPushNotifications()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;


//        return $notification = \app\models\Notifications::find()
//                        ->join('left join', 'projects', 'notifications.project_id = projects.project_id')
//                        ->where(['projects.is_deleted' => 0, 'projects.is_published' => 1, 'notifications.read' => 'N'])
//                        ->andWhere(['!=', 'notifications.contractor_id', \Yii::$app->session['contractorId']])
//                        ->orderBy(['read_date' => SORT_DESC])->all();

        return \app\models\Notifications::find()
            ->join('left join', 'notified', 'notifications.notification_id = notified.notification_id')
            //->join('left join', 'projects', 'notifications.project_id = projects.project_id')
            ->where(['is_read' => '0', 'notified.user_id' => \Yii::$app->session['user_id']])
            //->andWhere(['!=', 'notifications.user_id', \Yii::$app->session['user_id']])
            ->orderBy(['date' => SORT_DESC])->limit(4)->all();
    }


    public function actionAllNotifications()
    {

        // $this->layout = 'site_main';
        $query = \app\models\Notifications::find()
            ->join('left join', 'notified', 'notifications.notification_id = notified.notification_id')
            //->join('left join', 'projects', 'notifications.project_id = projects.project_id')
            ->where(['projects.is_deleted' => 0, 'notified.user_id' => \Yii::$app->session['user_id']])
            ->andWhere(['!=', 'notifications.user_id', \Yii::$app->session['user_id']])
            ->orderBy(['date' => SORT_DESC]);


        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $pages->pageSize = 10;
        $model = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('all-notifications', ['model' => $model, 'pages' => $pages]);
    }

    public function actionRemoveNotification($id)
    {
        $is_del = \app\models\Notified::find()->where(['notification_id' => $id, 'user_id' => \Yii::$app->session['user_id']])->one();

        if ($is_del->delete())
            return 1;
        else
            return 0;
    }

}

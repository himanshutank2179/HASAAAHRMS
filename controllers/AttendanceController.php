<?php

namespace app\controllers;

use app\models\Users;
use Yii;
use app\models\Attendance;
use app\models\AttendanceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AttendanceController implements the CRUD actions for Attendance model.
 */
class AttendanceController extends Controller
{
    public function actions()
    {
        return [
            'editable' => [
                'class' => 'mcms\xeditable\XEditableAction',
                'modelclass' => Attendance::className(),
            ],
        ];
    }

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
     * Lists all Attendance models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AttendanceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Attendance model.
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
     * Creates a new Attendance model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Attendance();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->attendance_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Attendance model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->attendance_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Attendance model.
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
     * Finds the Attendance model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Attendance the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Attendance::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionChangeStatus($aid, $status)
    {
        $attendance = Attendance::findOne(['attendance_id' => $aid]);
        $attendance->status = $status;
        if ($attendance->save(false)) {
            return true;
        }
        return false;
    }

    public function actionOff()
    {

        $users = Users::find()->where(['is_deleted' => 0])->all();
        $is_off_made = Attendance::find()->where('DATE(login_time)>=CURDATE()')->andWhere('=', ['status', 'O']);
        if (!$is_off_made) {
            foreach ($users as $user):
                $attendance = new Attendance();
                $attendance->user_id = $user->user_id;
                $attendance->login_time = date('Y-m-d H:i:s');
                $attendance->logout_time = date('Y-m-d H:i:s');
                $attendance->status = 'O';
                $attendance->save();
            endforeach;
            Yii::$app->session->setFlash('off-msg', "Off Declared successfully");
        } else {
            Yii::$app->session->setFlash('off-msg', "Off already Declared.");
        }
        return $this->redirect('index');


    }


//    public function actionEditNote() {
//        $request = Yii::$app->request->bodyParams;
//        if (!empty($request)) {
//            $model = $this->findModel($request['pk']);
//            if (\Yii::$app->session['_butiqatAuth'] == 2 || \Yii::$app->session['_butiqatAuth'] == 4) {
//                if (Yii::$app->user->identity->boutique_id != $model->boutique_id) {
//                    return json_encode([
//                        'msg' => 'You are not authorized to view this page.'
//                    ]);
//                }
//            }
//
//            $model->final_price = $request['value'];
//            if ($model->save()) {
//                return json_encode([
//                    'status' => true,
//                    'data' => $model->final_price . ' ' . $model->baseCurrency->code
//                ]);
//            } else {
//                return json_encode([
//                    'status' => false,
//                    'msg' => $model->errors['regular_price'][0],
//                ]);
//            }
//        }
//    }

}

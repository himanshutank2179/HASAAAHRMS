<?php

namespace app\controllers;

use Yii;
use app\models\Clients;
use app\models\ClientMobile;
use app\models\ClientsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\States;
use app\models\Cities;

/**
 * ClientsController implements the CRUD actions for Clients model.
 */
class ClientsController extends Controller
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
     * Lists all Clients models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ClientsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Clients model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Clients model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Clients();

        if ($model->load(Yii::$app->request->post()))
        {
            $data = Yii::$app->request->post();
            // echo "<pre>";
            // print_r($data);
            // exit();
            $model->created_at = date('Y-m-d H:i:s');
            if ($model->save())
            {
                $size = $data['ClientMobile']['client_mobile'];
                $sizecount = sizeof($size);
                for ($i = 0; $i < $sizecount; $i++)
                {
                    $model1 = new ClientMobile();
                    $model1->client_id = $model->client_id;
                    $model1->client_mobile = $data['ClientMobile']['client_mobile'][$i];
                    if (!$model1->save())
                    {
                        print_r($model1->errors);
                        exit();
                    } 
                }
            }
            else
            {
                print_r($model->errors);
                exit();
            }
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Clients model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()))
        {
             $request = Yii::$app->request->post();
            if($model->save())
            {
                if (isset($request['ClientMobile']['client_mobile']) && !empty($request['ClientMobile']['client_mobile']))
                {
                    \app\models\ClientMobile::deleteAll("client_id = '" . $model->client_id . "'");
                    $size = $request['ClientMobile']['client_mobile'];
                    $sizecount = sizeof($size);
                    for ($i = 0; $i < $sizecount; $i++)
                    {
                        $model1 = new ClientMobile();
                        $model1->client_id = $model->client_id;
                        $model1->client_mobile = $request['ClientMobile']['client_mobile'][$i];
                        if (!$model1->save())
                        {
                            print_r($model1->errors);
                            exit();
                        } 
                    }
                }
            }
            else
            {
                print_r($model->errors);
                exit();
            }
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Clients model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Clients model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Clients the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Clients::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionGetFloatForm($i = 0)
    {
        $model = new ClientMobile();
        return $this->renderAjax('_mobile', [
            'model' => $model,
            'i' => $i,
        ]);
    }


    public function actionPrint($id)
    {
        $model = Clients::findOne($id);
        $content = $this->renderPartial('_print_client', ['clients' => $model]);
        $pdf = Yii::$app->pdf;
        $pdf->content = $content;
        return $pdf->render();
    }

    public function actionCityList($id)
    {
        $cities = Cities::find()
            ->where(['state_id' => $id])
            ->all();

        if (!empty($cities)) {
            foreach ($cities as $city) {
                echo "<option value='" . $city->id . "'>" . $city->name . "</option>";
            }
        } else {
            echo "<option>-</option>";
        }

    }

    public function actionStateList($id)
    {
        $data = States::find()
            ->where(['country_id' => $id])
            ->all();

        if (!empty($data)) {
            foreach ($data as $s) {
                echo "<option value='" . $s->id . "'>" . $s->name . "</option>";
            }
        } else {
            echo "<option>-</option>";
        }

    }
}

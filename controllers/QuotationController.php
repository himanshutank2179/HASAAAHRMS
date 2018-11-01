<?php

namespace app\controllers;

use Yii;
use app\models\Quotation;
use app\models\QuotationSearch;
use app\models\QuotationProducts;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * QuotationController implements the CRUD actions for Quotation model.
 */
class QuotationController extends Controller
{
    /**
     * {@inheritdoc}
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
     * Lists all Quotation models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new QuotationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Quotation model.
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
     * Creates a new Quotation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        // $model = new Quotation();

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->quotation_id]);
        // }

        $model = new Quotation();

        if ($model->load(Yii::$app->request->post()))
        {
            $data = Yii::$app->request->bodyParams;
            $model->created_at = date('Y-m-d H:i:s');
            if($model->save())
            {
                if (isset($data['QuotationProducts']['service_id'])) {
                    $size = sizeof($data['QuotationProducts']['service_id']);
                    for ($i = 0; $i < $size; $i++) {
                        $qproduct = new QuotationProducts();

                        $qproduct->service_id = $data['QuotationProducts']['service_id'][$i];
                        $qproduct->quotation_id = $model->quotation_id;
                        $qproduct->quantity = $data['QuotationProducts']['quantity'][$i];
                        $qproduct->rate = $data['QuotationProducts']['rate'][$i];
                        $qproduct->gst = $data['QuotationProducts']['gst'][$i];
                        $qproduct->sgst = $data['QuotationProducts']['sgst'][$i];
                        $qproduct->cgst = $data['QuotationProducts']['cgst'][$i];
                        $qproduct->igst = $data['QuotationProducts']['igst'][$i];
                        $qproduct->total_gst = $data['QuotationProducts']['total_gst'][$i];
                        $qproduct->total_amount = $data['QuotationProducts']['total_amount'][$i];
                        $qproduct->save();
                        if (!$qproduct) {
                            print_r($qproduct->errors);
                            exit();
                        }

                    }

                }
                return $this->redirect('index');
            }
            else
            {
                print_r($model->errors);
                exit();
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Quotation model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $data = Yii::$app->request->bodyParams;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            if (isset($data['QuotationProducts']['service_id'])) {
                QuotationProducts::deleteAll(['quotation_id' => $model->quotation_id]);
                $size = sizeof($data['QuotationProducts']['service_id']);
                    for ($i = 0; $i < $size; $i++) {
                        $qproduct = new QuotationProducts();

                        $qproduct->service_id = $data['QuotationProducts']['service_id'][$i];
                        $qproduct->quotation_id = $model->quotation_id;
                        $qproduct->quantity = $data['QuotationProducts']['quantity'][$i];
                        $qproduct->rate = $data['QuotationProducts']['rate'][$i];
                        $qproduct->gst = $data['QuotationProducts']['gst'][$i];
                        $qproduct->sgst = $data['QuotationProducts']['sgst'][$i];
                        $qproduct->cgst = $data['QuotationProducts']['cgst'][$i];
                        $qproduct->igst = $data['QuotationProducts']['igst'][$i];
                        $qproduct->total_gst = $data['QuotationProducts']['total_gst'][$i];
                        $qproduct->total_amount = $data['QuotationProducts']['total_amount'][$i];
                        $qproduct->save();
                        if (!$qproduct) {
                            print_r($qproduct->errors);
                            exit();
                        }

                    }
            }
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Quotation model.
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
     * Finds the Quotation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Quotation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Quotation::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionGetFloatForm($i = 0)
    {
        $model = new QuotationProducts();
        return $this->renderAjax('_product', [
            'model' => $model,
            'i' => $i,
        ]);
    }
}

<?php

namespace app\controllers;

use app\helpers\AppHelper;
use app\models\UserPermission;
use Yii;
use app\models\Users;
use app\models\SearchUsers;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\components\UserIdentity;
use app\components\AccessRule;


/**
 * UsersController implements the CRUD actions for Users model.
 */
class UsersController extends Controller
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
     * Lists all Users models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchUsers();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Users model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Users model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    public function actionTry()
    {
        echo Yii::$app->security->generatePasswordHash('123456');
    }

    public function actionCreate()
    {
        $model = new Users();

        if ($model->load(Yii::$app->request->post())) {

            $model->username = $model->first_name . date_format(date_create($model->dob), "dmy");
            $password = Yii::$app->getSecurity()->generateRandomString(10);
            $model->raw_password = $password;
            $model->password = Yii::$app->security->generatePasswordHash($password);

            //debugPrint($model->user_role);
            $role = $model->user_role;
            if ($model->save()) {
                $auth = Yii::$app->authManager;
                $roleObject = $auth->getRole($role);
                if (!$roleObject) {
                    throw new InvalidParamException("There is no role \"$role\".");
                }
                $auth->assign($roleObject, $model->user_id);

                Yii::$app->mail->compose('@app/mail/user-info', ['info' => $model])
                    ->setFrom('no-reply@vytech.co')
                    ->setTo('himanshutank1111@gmail.com')
                    ->setSubject("User login information")
                    ->send();

                //Sending Mail To User for username and password
//                Yii::$app->mailer->compose()
//                    ->setFrom(['no-reply@vytechenterprise.com' => 'VY Tech Enterprise'])
//                    ->setTo($model->email)
//                    ->setSubject('User Access For VYtech')
//                    ->setTextBody('Name:' . $model->first_name)
//                    ->setHtmlBody("Hello, " . $model->first_name . "<br><br>Your Username and Password is :<br><br>" . "Username: " . $model->username . "<br><br>" . "Password: " . $password . "<br><br>")
//                    ->send();


                if (!empty($model->user_permissions)) {
                    foreach ($model->user_permissions as $perm) {
                        $userPermission = new UserPermission();
                        $userPermission->user_id = $model->user_id;
                        $userPermission->permission_id = $perm;
                        $userPermission->save();
                    }
                }


                if (!empty($_POST['Users']['images'])) {
                    foreach ($_POST['Users']['images'] as $img) {
                        $identity_proof = new \app\models\Identity();
                        $identity_proof->image = $img;
                        $identity_proof->user_id = $model->user_id;
                        $identity_proof->save();
                    }
                }


            } else {
                return print_r($model->getErrors());
            }
            return $this->redirect(['view', 'id' => $model->user_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Users model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            //AppHelper::dd($model->user_permissions);
            if ($model->save()) {

                if (!empty($_POST['Users']['images'])) {
                    //\app\models\Identity::deleteAll("package_id = '" . $model->package_id . "'");
                    foreach ($_POST['Users']['images'] as $img) {
                        $identity_proof = new \app\models\Identity();
                        $identity_proof->image = $img;
                        $identity_proof->user_id = $model->user_id;
                        $identity_proof->save();
                    }
                }
            }
            return $this->redirect(['view', 'id' => $model->user_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Users model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->is_deleted = 1;
        $model->save();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Users model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Users the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Users::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


}

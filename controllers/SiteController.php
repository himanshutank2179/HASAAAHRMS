<?php

namespace app\controllers;

use app\models\Attendance;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'update', 'create', 'view'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->redirect('dashboard');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */

    public function actionLogin()
    {
        $this->layout = 'main-login';

        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['/dashboard/index']);
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $is_already_login = Attendance::find()->where(['user_id' => Yii::$app->user->identity->user_id])
                ->andWhere('DATE(login_time)>=CURDATE()')->all();

            if (empty($is_already_login)) {
                $attendance = new Attendance();
                $attendance->user_id = Yii::$app->user->identity->user_id;
                $attendance->login_time = date('Y-m-d H:i:s');
                $attendance->save();
            }

            return $this->redirect(['/dashboard/index']);
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }


    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {


        $attendance = Attendance::findOne(['user_id' => Yii::$app->user->identity->user_id, 'logout_time' => null]);
        if (Yii::$app->user->logout()) {
            if (empty($attendance)) {
                return $this->redirect('login');
            }
            $attendance->logout_time = date('Y-m-d H:i:s');
            $attendance->save();
            return $this->redirect('login');
        }
    }

    public function actionSendMail()
    {

        Yii::$app->mail->compose('@app/mail/test')
            ->setFrom('no-reply@vytech.co')
            ->setTo('himanshutank1111@gmail.com')
            ->setSubject("User login information")
            ->send();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}

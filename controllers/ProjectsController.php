<?php

namespace app\controllers;

use app\components\DController;
use app\helpers\AppHelper;
use app\models\Checklist;
use app\models\Notifications;
use app\models\TaskComment;
use Codeception\Step\Comment;
use phpDocumentor\Reflection\Project;
use Yii;
use app\models\Projects;
use app\models\ProjectsSearch;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Tasks;
use yii\filters\AccessControl;
use app\models\AllProjectsSearch;
use yii\web\Response;
use app\models\TaskTags;

/**
 * ProjectsController implements the CRUD actions for Projects model.
 */
class ProjectsController extends Controller
{
    public function beforeAction($action)
    {
        if ($action->id == 'create-checklist') {
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
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
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionTry()
    {
        return Yii::$app->security->generatePasswordHash('Vy@s250994');
    }

    /**
     * Lists all Projects models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProjectsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAllProjects()
    {
        $searchModel = new AllProjectsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('all-projects', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Projects model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $task = new Tasks();
        $ckecklist = new Checklist();
        $comment = new TaskComment();
        Yii::$app->session->set('project_id', $id);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'task' => $task,
            'ckecklist' => $ckecklist,
            'comment' => $comment
        ]);
    }

    public function actionCreateChecklist()
    {
        $model = new Checklist();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
           // debugPrint(Yii::$app->request->post());
            // return $this->redirect(['view', 'id' => $model->project_id]);
            // \Yii::$app->response->format = Response::FORMAT_JSON;
            return '<li class="dd-item dd3-item" role="option" aria-grabbed="false" draggable="true"><div class="dd-handle dd3-handle"></div>
                        <div class="dd3-content">
                        ' . $model->list_item . '
                        </div></li>';
        }
    }

    public function actionCreateTaskComment()
    {
        $model = new TaskComment();
        if ($model->load(Yii::$app->request->post())) {
            $model->created_date = date('Y-m-d H:i:s');
            $date = date_create($model->created_date);
            $ddate = date_format($date, "d M  h:i a");
            if ($model->save()) {
                return '<a href="#">
                                <div class="inbox-item">
                                    <div class="inbox-item-img"><img src=' . Yii::getAlias('@web') . '/uploads/' . $model->user->photo . ' class="img-circle" alt=""></div>
                                    <strong class="inbox-item-author">' . $model->user->first_name . '</strong>
                                    <span class="inbox-item-date">- ' . $ddate . '</span>
                                    <p class="inbox-item-text">' . $model->comment . '</p>

                                </div>
                            </a>';
            }
            //return $this->redirect(['view', 'id' => $model->project_id]);
        }
    }


    public function actionCreateTask()
    {
        $model = new Tasks();
            $request = Yii::$app->request->bodyParams;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //debugPrint($request['Projects']['tags']);
            foreach ($request['Projects']['tags'] as $user) {
                $tag_user = new TaskTags();
                $tag_user->task_id = $model->task_id;
                $tag_user->user_id = $user;
                $tag_user->save();
            }
            return $this->redirect(['view', 'id' => $model->project_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }


    /**
     * Creates a new Projects model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (\Yii::$app->user->can('admin')) {
            $model = new Projects();
            $model->start_date = date('Y-m-d H:i:s');
            if ($model->load(Yii::$app->request->post())) {
                if ($model->save()) {
                    if (!empty($model->project_users)) {
                        //SENDING NOTIFICATIONS TO SELECTED USERS FOR PROJECT
                        $notification = new Notifications();
                        $notification->project_id = $model->project_id;
                        $notification->title = 'Your Are Selected for' . $model->name . ' Project.';
                        $notification->description = '';
                        $notification->action_type = 'Assigned';
                        $notification->is_push = 1;
                        $notification->date = date('Y-m-d H:i:s');
                        if ($notification->save()) {
                            $users = $model->project_users;
                            foreach ($users as $u):
                                $notified = new \app\models\Notified();
                                $notified->user_id = $u;
                                $notified->notification_id = $model->notification_id;
                                $notified->date = date('Y-m-d H:i:s');
                                $notified->save();
                            endforeach;
                        }
                    }
                    //STORING SELECTED PROJECT USERS
                    if (!empty($_POST['Projects']['project_users'])) {
                        foreach ($_POST['Projects']['project_users'] as $pusers) {
                            $project_user = new \app\models\ProjectUsers();
                            $project_user->project_id = $model->project_id;
                            $project_user->user_id = $pusers;
                            $project_user->save();
                        }
                    }
                }
                return $this->redirect(['view', 'id' => $model->project_id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        } else {
            throw new ForbiddenHttpException();
        }

    }

    /**
     * Updates an existing Projects model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            if ($model->save()) {
                if (!empty($_POST['Projects']['project_users'])) {
                    \app\models\ProjectUsers::deleteAll(['project_id' => $model->project_id]);
                    foreach ($_POST['Projects']['project_users'] as $pusers) {
                        $project_user = new \app\models\ProjectUsers();
                        $project_user->project_id = $model->project_id;
                        $project_user->user_id = $pusers;
                        $project_user->save();
                    }
                }
            }


            return $this->redirect(['view', 'id' => $model->project_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Projects model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
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
     * Finds the Projects model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Projects the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Projects::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionChangeStatus($pid, $status)
    {
//        echo $pid . '/////' . $status; exit();
        $project = Projects::findOne(['project_id' => $pid, 'is_deleted' => 0]);
        $project->status = $status;
        if ($project->save()) {
            return true;
        }
        return false;

    }


    public function actionTaskDesc($task_id)
    {
        $task = new Tasks();
        $clist = new Checklist();
        $comentModel = new TaskComment();
        $checklist = \app\models\Checklist::find()->where(['task_id' => $task_id])->all();
        $comments = \app\models\TaskComment::findAll(['task_id' => $task_id]);
        return $this->renderAjax('task-desc', ['checklist' => $checklist, 'comments' => $comments, 'clist' => $clist, 'comentModel' => $comentModel]);
    }

    public function actionGetComments($task_id)
    {
        return \app\models\TaskComment::findAll(['task_id' => $task_id]);
    }
}

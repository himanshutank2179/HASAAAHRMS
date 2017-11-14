<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tasks".
 *
 * @property string $task_id
 * @property integer $project_id
 * @property string $name
 * @property string $status
 * @property string $deadline
 * @property integer $is_deleted
 *
 * @property Checklist[] $checklists
 * @property TaskComment[] $taskComments
 * @property Projects $project
 */
class Tasks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tasks';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id', 'name', 'deadline'], 'required'],
            [['project_id', 'is_deleted'], 'integer'],
            [['status','description'], 'string'],
            [['deadline'], 'safe'],
            [['name'], 'string', 'max' => 200],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Projects::className(), 'targetAttribute' => ['project_id' => 'project_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'task_id' => 'Task ID',
            'project_id' => 'Project ID',
            'name' => 'Name',
            'status' => 'Status',
            'deadline' => 'Task Date',
            'is_deleted' => 'Is Deleted',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChecklists()
    {
        return $this->hasMany(Checklist::className(), ['task_id' => 'task_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaskComments()
    {
        return $this->hasMany(TaskComment::className(), ['task_id' => 'task_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Projects::className(), ['project_id' => 'project_id']);
    }
}

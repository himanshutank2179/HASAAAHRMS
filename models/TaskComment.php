<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "task_comment".
 *
 * @property string $task_comment_id
 * @property string $task_id
 * @property string $user_id
 * @property string $comment
 *
 * @property Tasks $task
 * @property Users $user
 */
class TaskComment extends \yii\db\ActiveRecord
{
    public $project_id;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'task_comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['task_id', 'comment','created_date'], 'required'],
            [['task_id', 'user_id', 'project_id'], 'integer'],
            [['comment'], 'string'],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tasks::className(), 'targetAttribute' => ['task_id' => 'task_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'user_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'task_comment_id' => 'Task Comment ID',
            'task_id' => 'Task ID',
            'user_id' => 'User ID',
            'comment' => 'Comment',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Tasks::className(), ['task_id' => 'task_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['user_id' => 'user_id']);
    }
}

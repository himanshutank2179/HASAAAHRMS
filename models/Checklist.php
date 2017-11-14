<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "checklist".
 *
 * @property string $checklist_id
 * @property string $task_id
 * @property string $list_item
 *
 * @property Tasks $task
 */
class Checklist extends \yii\db\ActiveRecord
{
    public $project_id;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'checklist';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['task_id', 'list_item'], 'required'],
            [['task_id','project_id'], 'integer'],
            [['list_item'], 'string', 'max' => 200],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tasks::className(), 'targetAttribute' => ['task_id' => 'task_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'checklist_id' => 'Checklist ID',
            'task_id' => 'Task ID',
            'list_item' => 'Add Your Check List',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Tasks::className(), ['task_id' => 'task_id']);
    }
}

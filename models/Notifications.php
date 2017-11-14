<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "notifications".
 *
 * @property integer $notification_id
 * @property integer $project_id
 * @property string $title
 * @property string $description
 * @property string $action_type
 * @property integer $user_id
 * @property integer $is_push
 * @property string $date
 */
class Notifications extends \yii\db\ActiveRecord
{
    public $notify_to;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notifications';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id', 'user_id', 'is_push', 'notify_to'], 'integer'],
            [['title', 'description', 'date'], 'required'],
            [['description', 'action_type'], 'string'],
            [['date', 'notify_to'], 'safe'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'notification_id' => 'Notification ID',
            'project_id' => 'Project ID',
            'title' => 'Title',
            'description' => 'Description',
            'action_type' => 'Action Type',
            'user_id' => 'User ID',
            'is_push' => 'Send Push?',
            'date' => 'Date',
        ];
    }
}

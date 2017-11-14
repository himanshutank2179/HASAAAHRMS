<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "notified".
 *
 * @property integer $notified_id
 * @property integer $notification_id
 * @property integer $project_id
 * @property integer $user_id
 * @property string $is_read
 * @property string $date
 */
class Notified extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notified';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['notification_id', 'user_id', 'date'], 'required'],
            [['notification_id', 'project_id', 'user_id'], 'integer'],
            [['is_read'], 'string'],
            [['date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'notified_id' => 'Notified ID',
            'notification_id' => 'Notification ID',
            'project_id' => 'Project ID',
            'user_id' => 'User ID',
            'is_read' => 'Is Read',
            'date' => 'Date',
        ];
    }
}

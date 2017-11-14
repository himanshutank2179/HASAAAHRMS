<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "attendance".
 *
 * @property integer $attendance_id
 * @property string $user_id
 * @property string $login_time
 * @property string $logout_time
 *
 * @property Users $user
 */
class Attendance extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'attendance';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
           // [['user_id', 'login_time', 'logout_time'], 'required'],
            [['user_id'], 'integer'],
            [['login_time', 'logout_time','status','note'], 'safe'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'user_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'attendance_id' => 'Attendance ID',
            'user_id' => 'Username',
            'login_time' => 'Login Time',
            'logout_time' => 'Logout Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['user_id' => 'user_id']);
    }
}

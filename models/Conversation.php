<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "conversation".
 *
 * @property integer $id
 * @property integer $user_one
 * @property integer $user_two
 */
class Conversation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'conversation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_one', 'user_two'], 'required'],
            [['user_one', 'user_two'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_one' => 'User One',
            'user_two' => 'User Two',
        ];
    }
}

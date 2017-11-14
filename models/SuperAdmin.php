<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "super_admin".
 *
 * @property string $super_admin_id
 * @property string $username
 * @property string $password
 * @property integer $is_deleted
 */
class SuperAdmin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'super_admin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            [['is_deleted'], 'integer'],
            [['username'], 'string', 'max' => 100],
            [['password'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'super_admin_id' => 'Super Admin ID',
            'username' => 'Username',
            'password' => 'Password',
            'is_deleted' => 'Is Deleted',
        ];
    }
}

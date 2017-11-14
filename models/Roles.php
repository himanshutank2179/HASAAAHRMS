<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "roles".
 *
 * @property integer $role_id
 * @property string $name
 * @property integer $is_deleted
 */
class Roles extends \yii\db\ActiveRecord
{
    public $user_permissions;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'roles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'user_permissions'], 'required'],
            [['is_deleted'], 'integer'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'role_id' => 'Role ID',
            'name' => 'Name',
            'is_deleted' => 'Is Deleted',
        ];
    }
    public function getUsersPermissions()
    {
        return $this->hasMany(UserPermission::className(), ['role_id' => 'role_id']);
    }
}

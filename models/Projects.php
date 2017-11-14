<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "projects".
 *
 * @property integer $project_id
 * @property string $name
 * @property string $short_desc
 * @property string $client_name
 * @property string $deadline
 * @property integer $admin_id
 * @property integer $is_deleted
 *
 * @property ProjectUsers[] $projectUsers
 */
class Projects extends \yii\db\ActiveRecord
{
    public $project_users;
    public $tags;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'projects';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'short_desc', 'client_name', 'deadline', 'admin_id'], 'required'],
            [['short_desc'], 'string'],
            [['deadline','start_date','status'], 'safe'],
            [['admin_id', 'is_deleted','tags'], 'integer'],
            [['name', 'client_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'project_id' => 'Project ID',
            'name' => 'Project Name',
            'short_desc' => 'Short Desc',
            'client_name' => 'Client Name',
            'deadline' => 'Deadline',
            'admin_id' => 'Admin',
            'is_deleted' => 'Is Deleted',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectUsers()
    {
        return $this->hasMany(ProjectUsers::className(), ['project_id' => 'project_id']);
    }




    public function getUsers()
    {
        return $this->hasOne(Users::className(), ['user_id' => 'admin_id']);
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "services".
 *
 * @property int $service_id
 * @property int $project_type_id
 * @property string $name
 * @property string $price
 *
 * @property ProjectType $projectType
 */
class Services extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'services';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_type_id', 'name'], 'required'],
            [['project_type_id'], 'integer'],
            [['price'], 'safe'],
            [['name','duration',], 'string', 'max' => 255],
            [['project_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProjectType::className(), 'targetAttribute' => ['project_type_id' => 'project_type_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'service_id' => 'Service',
            'project_type_id' => 'Project Type',
            'name' => 'Name',
            'duration' => 'Duration'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectType()
    {
        return $this->hasOne(ProjectType::className(), ['project_type_id' => 'project_type_id']);
    }
}

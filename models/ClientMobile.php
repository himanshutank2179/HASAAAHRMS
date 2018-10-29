<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "client_mobile".
 *
 * @property int $client_mobile_id
 * @property int $client_id
 * @property string $client_mobile
 *
 * @property Clients $client
 */
class ClientMobile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'client_mobile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['client_id', 'client_mobile'], 'required'],
            [['client_id'], 'integer'],
            [['client_mobile'], 'string', 'max' => 255],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => Clients::className(), 'targetAttribute' => ['client_id' => 'client_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'client_mobile_id' => 'Client Mobile ID',
            'client_id' => 'Client ID',
            'client_mobile' => 'Client Mobile',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Clients::className(), ['client_id' => 'client_id']);
    }
}

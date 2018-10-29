<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "clients".
 *
 * @property int $client_id
 * @property string $name
 * @property string $email
 * @property string $account_number
 * @property string $bank_ifsc
 * @property string $gstin
 * @property string $pan
 * @property string $flat
 * @property string $street
 * @property string $landmark
 * @property string $area
 * @property string $city
 * @property string $state
 * @property string $statecode
 * @property string $country
 * @property int $is_deleted
 * @property string $created_at
 */
class Clients extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'clients';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'account_number', 'bank_ifsc', 'gstin', 'pan', 'flat', 'street', 'landmark', 'area', 'city_id', 'state_id', 'statecode', 'country_id', 'created_at'], 'required'],
            [['is_deleted','city_id', 'state_id', 'statecode', 'country_id'], 'integer'],
            [['created_at'], 'safe'],
            [['name', 'email', 'account_number', 'bank_ifsc', 'gstin', 'pan', 'flat', 'street', 'landmark', 'area',], 'string', 'max' => 255],
            [['state_id'], 'exist', 'skipOnError' => true, 'targetClass' => States::className(), 'targetAttribute' => ['state_id' => 'id']],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cities::className(), 'targetAttribute' => ['city_id' => 'id']],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Countries::className(), 'targetAttribute' => ['country_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'client_id' => 'Client ID',
            'name' => 'Name',
            'email' => 'Email',
            'account_number' => 'Account Number',
            'bank_ifsc' => 'Bank Ifsc',
            'gstin' => 'Gstin',
            'pan' => 'Pan',
            'flat' => 'Flat',
            'street' => 'Street',
            'landmark' => 'Landmark',
            'area' => 'Area',
            'city_id' => 'City',
            'state_id' => 'State',
            'statecode' => 'Statecode',
            'country_id' => 'Country',
            // 'is_deleted' => 'Is Deleted',
            // 'created_at' => 'Created At',
        ];
    }

    public function getState()
    {
        return $this->hasOne(States::className(), ['id' => 'state_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(Cities::className(), ['id' => 'city_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Countries::className(), ['id' => 'country_id']);
    }
    public function getClientMobiles()
    {
        return $this->hasMany(ClientMobile::className(), ['client_id' => 'client_id']);
    }
}

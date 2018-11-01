<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "quotation".
 *
 * @property int $quotation_id
 * @property int $client_id
 * @property int $county_id
 * @property int $state_id
 * @property int $city_id
 * @property string $payment_terms
 * @property string $delivery_period
 * @property string $inquiry_remark
 * @property int $is_deleted
 * @property string $created_at
 *
 * @property Clients $client
 * @property Countries $county
 * @property States $state
 * @property Cities $city
 * @property QuotationProducts[] $quotationProducts
 */
class Quotation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'quotation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['client_id', 'county_id', 'state_id', 'city_id', 'payment_terms', 'delivery_period', 'inquiry_remark', 'created_at'], 'required'],
            [['client_id', 'county_id', 'state_id', 'city_id', 'is_deleted'], 'integer'],
            [['payment_terms', 'inquiry_remark'], 'string'],
            [['created_at'], 'safe'],
            [['delivery_period'], 'string', 'max' => 255],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => Clients::className(), 'targetAttribute' => ['client_id' => 'client_id']],
            [['county_id'], 'exist', 'skipOnError' => true, 'targetClass' => Countries::className(), 'targetAttribute' => ['county_id' => 'id']],
            [['state_id'], 'exist', 'skipOnError' => true, 'targetClass' => States::className(), 'targetAttribute' => ['state_id' => 'id']],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cities::className(), 'targetAttribute' => ['city_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'quotation_id' => 'Quotation ID',
            'client_id' => 'Client',
            'county_id' => 'County',
            'state_id' => 'State',
            'city_id' => 'City',
            'payment_terms' => 'Payment Terms',
            'delivery_period' => 'Delivery Period',
            'inquiry_remark' => 'Inquiry Remark',
            'is_deleted' => 'Is Deleted',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Clients::className(), ['client_id' => 'client_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCounty()
    {
        return $this->hasOne(Countries::className(), ['id' => 'county_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
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
    public function getQuotationProducts()
    {
        return $this->hasMany(QuotationProducts::className(), ['quotation_id' => 'quotation_id']);
    }
}

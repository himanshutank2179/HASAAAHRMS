<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "quotation_products".
 *
 * @property int $quotation_service_id
 * @property int $service_id
 * @property int $quotation_id
 * @property int $quantity
 * @property double $rate
 * @property double $sgst
 * @property double $cgst
 * @property double $igst
 * @property double $gst
 * @property double $total_amount
 * @property double $total_gst
 *
 * @property Quotation $quotation
 * @property Services $service
 */
class QuotationProducts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'quotation_products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['service_id', 'quotation_id', 'quantity'], 'integer'],
            [['rate', 'sgst', 'cgst', 'igst', 'gst', 'total_amount', 'total_gst'], 'number'],
            [['quotation_id'], 'exist', 'skipOnError' => true, 'targetClass' => Quotation::className(), 'targetAttribute' => ['quotation_id' => 'quotation_id']],
            [['service_id'], 'exist', 'skipOnError' => true, 'targetClass' => Services::className(), 'targetAttribute' => ['service_id' => 'service_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'quotation_service_id' => 'Quotation Service ID',
            'service_id' => 'Service ID',
            'quotation_id' => 'Quotation ID',
            'quantity' => 'Quantity',
            'rate' => 'Rate',
            'sgst' => 'Sgst',
            'cgst' => 'Cgst',
            'igst' => 'Igst',
            'gst' => 'Gst',
            'total_amount' => 'Total Amount',
            'total_gst' => 'Total Gst',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuotation()
    {
        return $this->hasOne(Quotation::className(), ['quotation_id' => 'quotation_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getService()
    {
        return $this->hasOne(Services::className(), ['service_id' => 'service_id']);
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "salary".
 *
 * @property integer $salary_id
 * @property string $user_id
 * @property integer $ctc
 * @property integer $tds
 * @property integer $pt
 * @property integer $pf
 * @property integer $esi
 * @property integer $incentive
 * @property integer $bonus
 * @property string $extra_note
 * @property string $created_date
 *
 * @property Users $user
 */
class Salary extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'salary';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'ctc', 'tds', 'pt', 'pf', 'esi', 'incentive', 'bonus', 'created_date'], 'required'],
            [['user_id', 'ctc', 'tds', 'pt', 'pf', 'esi', 'incentive', 'bonus'], 'integer'],
            [['extra_note'], 'string'],
            [['created_date', 'extra_note'], 'safe'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'user_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'salary_id' => 'Salary ID',
            'user_id' => 'User',
            'ctc' => 'CTC',
            'tds' => 'TDS',
            'pt' => 'PT',
            'pf' => 'PF',
            'esi' => 'ESI',
            'incentive' => 'Incentive',
            'bonus' => 'Bonus',
            'extra_note' => 'Extra Note',
            'created_date' => 'Created Date',
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

<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Users;

/**
 * SearchUsers represents the model behind the search form about `app\models\Users`.
 */
class SearchUsers extends Users
{
    public $status;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'account_number', 'identity_proof_id', 'role_id', 'is_deleted'], 'integer'],
            [['username', 'email', 'dob', 'phone', 'mobile', 'temp_address', 'perm_address', 'bank_name', 'ifsc', 'passport', 'exp_latter', 'created_at', 'login_time', 'logout_time','status'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Users::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'user_id' => $this->user_id,
            'dob' => $this->dob,
            'account_number' => $this->account_number,
            // 'identity_proof_id' => $this->identity_proof_id,
            'created_at' => $this->created_at,
            //'role_id' => Yii::$app->getRequest()->getQueryParam('type') == 'admins' ? 1 : 0,
            'login_time' => $this->login_time,
            'logout_time' => $this->logout_time,
            'role_id' => $this->role_id,
            'is_deleted' => 0,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            // ->andFilterWhere(['like', 'photo', $this->photo])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'temp_address', $this->temp_address])
            ->andFilterWhere(['like', 'perm_address', $this->perm_address])
            ->andFilterWhere(['like', 'bank_name', $this->bank_name])
            ->andFilterWhere(['like', 'ifsc', $this->ifsc])
            ->andFilterWhere(['like', 'passport', $this->passport])
            ->andFilterWhere(['like', 'exp_latter', $this->exp_latter]);

        return $dataProvider;
    }
}

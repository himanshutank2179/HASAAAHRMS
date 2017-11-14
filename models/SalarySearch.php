<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Salary;

/**
 * SalarySearch represents the model behind the search form about `app\models\Salary`.
 */
class SalarySearch extends Salary
{
    public $username;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'ctc', 'tds', 'pt', 'pf', 'esi', 'incentive', 'bonus'], 'integer'],
            [['extra_note', 'created_date', 'username'], 'safe'],
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
        $query = Salary::find();

        // add conditions that should always apply here

        $query->joinWith(['user']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['username'] = [
            'asc' => ['users.first_name' => SORT_ASC],
            'desc' => ['users.first_name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'user_id' => $this->user_id,
            'ctc' => $this->ctc,
            'tds' => $this->tds,
            'pt' => $this->pt,
            'pf' => $this->pf,
            'esi' => $this->esi,
            'incentive' => $this->incentive,
            'bonus' => $this->bonus,
            'created_date' => $this->created_date,
        ]);

        $query->andFilterWhere(['like', 'extra_note', $this->extra_note]);
        $query->andFilterWhere(['like', 'users.first_name', $this->username]);

        return $dataProvider;
    }
}

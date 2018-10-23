<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Attendance;

/**
 * AttendanceSearch represents the model behind the search form about `app\models\Attendance`.
 */
class AttendanceSearch extends Attendance
{
    public $username, $status2;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['attendance_id', 'user_id'], 'integer'],
            [['login_time', 'logout_time', 'username', 'status', 'note', 'status2', 'created_at'], 'safe'],
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
        // $query = Attendance::find()->select(['companyID','providerID', 'customerID'])->distinct();
        //$query = Attendance::find()->select('attendance.user_id');
        //$query= Attendance::find()->select(['attendance.user_id','attendance.note','attendance.login_time','attendance.created_at'])->distinct();

        $query = Attendance::find()
            ->groupBy(['user_id'])->orderBy(['user_id' => SORT_DESC]);

        // add conditions that should always apply here
        $query->joinWith(['user']);


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProvider->sort->attributes['username'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
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
            /*'attendance_id' => $this->attendance_id,*/
            // 'user_id' => $this->user_id,
            //'attendance.login_time' => $this->login_time,
            'logout_time' => $this->logout_time,
            'Date(attendance.created_at)' => empty($this->created_at) ? date('Y-m-d') : $this->created_at,
            'status' => $this->status,
            // 'status' => $this->status2,
        ]);

        $query->andFilterWhere(['like', 'users.first_name', $this->username]);
        $query->andFilterWhere(['like', 'note', $this->note]);
        $query->andFilterWhere(['like', 'attendance.login_time', $this->login_time]);

        return $dataProvider;
    }

}

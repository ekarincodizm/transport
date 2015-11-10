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
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'salary'], 'integer'],
            [['employee', 'year', 'month', 'date_salary'], 'safe'],
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

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'salary' => $this->salary,
            'date_salary' => $this->date_salary,
        ]);

        $query->andFilterWhere(['like', 'employee', $this->employee])
            ->andFilterWhere(['like', 'year', $this->year])
            ->andFilterWhere(['like', 'month', $this->month]);

        return $dataProvider;
    }
}

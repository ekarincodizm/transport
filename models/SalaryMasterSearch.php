<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SalaryMaster;

/**
 * SalaryMasterSearch represents the model behind the search form about `app\models\SalaryMaster`.
 */
class SalaryMasterSearch extends SalaryMaster
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'salary', 'active'], 'integer'],
            [['employee', 'update_salary'], 'safe'],
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
        $query = SalaryMaster::find();

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
            'update_salary' => $this->update_salary,
            'active' => $this->active,
        ]);

        $query->andFilterWhere(['like', 'employee', $this->employee]);

        return $dataProvider;
    }
}

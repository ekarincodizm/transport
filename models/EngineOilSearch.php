<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EngineOil;

/**
 * EngineOilSearch represents the model behind the search form about `app\models\EngineOil`.
 */
class EngineOilSearch extends EngineOil
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'car_id','now_mile','next_mile', 'price'], 'integer'],
            [[ 'license_plate', 'create_date'], 'safe'],
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
        $query = EngineOil::find();

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
            'now_mile' => $this->now_mile,
            'next_mile' => $this->next_mile,
            'car_id' => $this->car_id,
            'price' => $this->price,
            'create_date' => $this->create_date,
        ]);

        $query->andFilterWhere(['like', 'license_plate', $this->license_plate]);

        return $dataProvider;
    }
}

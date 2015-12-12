<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MapTruck;

/**
 * MapTruckSearch represents the model behind the search form about `app\models\MapTruck`.
 */
class MapTruckSearch extends MapTruck
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['car_id'], 'integer'],
            [['truck_1', 'truck_2', 'create_date'], 'safe'],
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
        $query = MapTruck::find();

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
            'car_id' => $this->car_id,
            'create_date' => $this->create_date,
        ]);

        $query->andFilterWhere(['like', 'truck_1', $this->truck_1])
            ->andFilterWhere(['like', 'truck_2', $this->truck_2]);

        return $dataProvider;
    }
}

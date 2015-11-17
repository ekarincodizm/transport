<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Truck;

/**
 * TruckSearch represents the model behind the search form about `app\models\Truck`.
 */
class TruckSearch extends Truck
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'period', 'type_id','delete_flag'], 'integer'],
            [['license_plate', 'brand', 'model', 'color', 'date_buy', 'date_supply'], 'safe'],
            [['price', 'down', 'period_price'], 'number'],
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
        $query = Truck::find();

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
            'date_buy' => $this->date_buy,
            'price' => $this->price,
            'down' => $this->down,
            'period_price' => $this->period_price,
            'period' => $this->period,
            'date_supply' => $this->date_supply,
            'type_id' => $this->type_id,
        ]);

        $query->andFilterWhere(['like', 'license_plate', $this->license_plate])
            ->andFilterWhere(['like', 'brand', $this->brand])
            ->andFilterWhere(['like', 'model', $this->model])
            ->andFilterWhere(['like', 'color', $this->color]);
        $query->andWhere(['delete_flag' => '0']);
        return $dataProvider;
    }
}

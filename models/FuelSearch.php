<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Fuel;

/**
 * FuelSearch represents the model behind the search form about `app\models\Fuel`.
 */
class FuelSearch extends Fuel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'oil', 'gas'], 'integer'],
            [['order_id', 'create_date'], 'safe'],
            [['oil_unit', 'oil_price', 'gas_unit', 'gas_price'], 'number'],
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
        $query = Fuel::find();

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
            'oil' => $this->oil,
            'oil_unit' => $this->oil_unit,
            'oil_price' => $this->oil_price,
            'gas' => $this->gas,
            'gas_unit' => $this->gas_unit,
            'gas_price' => $this->gas_price,
            'create_date' => $this->create_date,
        ]);

        $query->andFilterWhere(['like', 'order_id', $this->order_id]);

        return $dataProvider;
    }
}

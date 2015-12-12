<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Assign;

/**
 * AssignSearch represents the model behind the search form about `app\models\Assign`.
 */
class AssignSearch extends Assign
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'car_id', 'driver1', 'driver2', 'oil_set', 'oil', 'gas', 'product_up', 'product_down', 'changwat_start', 'changwat_end', 'product_type', 'weigh', 'type_calculus'], 'integer'],
            [['order_id', 'assign_id', 'order_date_start', 'order_date_end', 'employer', 'old_mile', 'now_mile', 'distance', 'distance_collect', 'avg_oil', 'compensate', 'transport_date', 'cus_start', 'cus_end', 'allowance_driver1', 'allowance_driver2', 'message', 'create_date'], 'safe'],
            [['oil_unit', 'oil_price', 'gas_unit', 'gas_price', 'unit_price', 'per_times', 'income'], 'number'],
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
        $query = Assign::find();

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
            'order_date_start' => $this->order_date_start,
            'order_date_end' => $this->order_date_end,
            'car_id' => $this->car_id,
            'driver1' => $this->driver1,
            'driver2' => $this->driver2,
            'oil_set' => $this->oil_set,
            'oil' => $this->oil,
            'oil_unit' => $this->oil_unit,
            'oil_price' => $this->oil_price,
            'gas' => $this->gas,
            'gas_unit' => $this->gas_unit,
            'gas_price' => $this->gas_price,
            'product_up' => $this->product_up,
            'product_down' => $this->product_down,
            'transport_date' => $this->transport_date,
            'changwat_start' => $this->changwat_start,
            'changwat_end' => $this->changwat_end,
            'product_type' => $this->product_type,
            'weigh' => $this->weigh,
            'type_calculus' => $this->type_calculus,
            'unit_price' => $this->unit_price,
            'per_times' => $this->per_times,
            'income' => $this->income,
            'create_date' => $this->create_date,
        ]);

        $query->andFilterWhere(['like', 'order_id', $this->order_id])
            ->andFilterWhere(['like', 'assign_id', $this->assign_id])
            ->andFilterWhere(['like', 'employer', $this->employer])
            ->andFilterWhere(['like', 'old_mile', $this->old_mile])
            ->andFilterWhere(['like', 'now_mile', $this->now_mile])
            ->andFilterWhere(['like', 'distance', $this->distance])
            ->andFilterWhere(['like', 'distance_collect', $this->distance_collect])
            ->andFilterWhere(['like', 'avg_oil', $this->avg_oil])
            ->andFilterWhere(['like', 'compensate', $this->compensate])
            ->andFilterWhere(['like', 'cus_start', $this->cus_start])
            ->andFilterWhere(['like', 'cus_end', $this->cus_end])
            ->andFilterWhere(['like', 'allowance_driver1', $this->allowance_driver1])
            ->andFilterWhere(['like', 'allowance_driver2', $this->allowance_driver2])
            ->andFilterWhere(['like', 'message', $this->message]);

        return $dataProvider;
    }
}

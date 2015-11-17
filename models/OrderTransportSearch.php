<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\OrdersTransport;

/**
 * OrderTransportSearch represents the model behind the search form about `app\models\OrdersTransport`.
 */
class OrderTransportSearch extends OrdersTransport {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'truck1', 'truck2', 'driver1', 'driver2', 'oil_set','employer'], 'integer'],
            [['order_id', 'order_date_start', 'order_date_end', 'create_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
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
    public function search($params) {
        $query = OrdersTransport::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'attributes' => ['order_id'],
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'employer' => $this->employer,
            'order_date_start' => $this->order_date_start,
            'order_date_end' => $this->order_date_end,
            'truck1' => $this->truck1,
            'truck2' => $this->truck2,
            'driver1' => $this->driver1,
            'driver2' => $this->driver2,
            'create_date' => $this->create_date,
        ]);

        $query->andFilterWhere(['like', 'order_id', $this->order_id]);
        $query->andWhere(['delete_flag' => 0]);

        return $dataProvider;
    }

}

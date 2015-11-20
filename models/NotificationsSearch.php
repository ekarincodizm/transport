<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Notifications;

/**
 * NotificationsSearch represents the model behind the search form about `app\models\Notifications`.
 */
class NotificationsSearch extends Notifications
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'driver_license', 'truck_act', 'truck_period'], 'integer'],
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
        $query = Notifications::find();

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
            'driver_license' => $this->driver_license,
            'truck_act' => $this->truck_act,
            'truck_period' => $this->truck_period,
        ]);

        return $dataProvider;
    }
}

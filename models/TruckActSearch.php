<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TruckAct;

/**
 * TruckActSearch represents the model behind the search form about `app\models\TruckAct`.
 */
class TruckActSearch extends TruckAct
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['license_plate', 'act_start', 'act_end', 'create_date'], 'safe'],
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
        $query = TruckAct::find();

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
            'act_start' => $this->act_start,
            'act_end' => $this->act_end,
            'create_date' => $this->create_date,
        ]);

        $query->andFilterWhere(['like', 'license_plate', $this->license_plate]);

        return $dataProvider;
    }
}

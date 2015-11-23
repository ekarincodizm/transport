<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Annuities;

/**
 * AnnuitiesSearch represents the model behind the search form about `app\models\Annuities`.
 */
class AnnuitiesSearch extends Annuities
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'period'], 'integer'],
            [['license_plate', 'month', 'year', 'create_date'], 'safe'],
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
        $query = Annuities::find();

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
            'period' => $this->period,
            'create_date' => $this->create_date,
        ]);

        $query->andFilterWhere(['like', 'license_plate', $this->license_plate])
            ->andFilterWhere(['like', 'month', $this->month])
            ->andFilterWhere(['like', 'year', $this->year]);

        return $dataProvider;
    }
}

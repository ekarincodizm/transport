<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Affiliated;

/**
 * AffiliatedSearch represents the model behind the search form about `app\models\Affiliated`.
 */
class AffiliatedSearch extends Affiliated
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['company_id', 'company', 'tax_number', 'address', 'tel', 'create_date'], 'safe'],
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
        $query = Affiliated::find();

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
            'create_date' => $this->create_date,
        ]);

        $query->andFilterWhere(['like', 'company_id', $this->company_id])
            ->andFilterWhere(['like', 'company', $this->company])
            ->andFilterWhere(['like', 'tax_number', $this->tax_number])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'tel', $this->tel]);

        return $dataProvider;
    }
}

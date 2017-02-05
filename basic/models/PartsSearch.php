<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Parts;

/**
 * PartsSearch represents the model behind the search form about `app\models\Parts`.
 */
class PartsSearch extends Parts
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'parts_groups_id', 'created_at', 'updated_at'], 'integer'],
            [['pnc', 'oem', 'required', 'period', 'name', 'applicability', 'price'], 'safe'],
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
        $query = Parts::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'parts_groups_id' => $this->parts_groups_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'pnc', $this->pnc])
            ->andFilterWhere(['like', 'oem', $this->oem])
            ->andFilterWhere(['like', 'required', $this->required])
            ->andFilterWhere(['like', 'period', $this->period])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'applicability', $this->applicability])
            ->andFilterWhere(['like', 'price', $this->price]);

        return $dataProvider;
    }
}

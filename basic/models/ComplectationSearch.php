<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Complectation;

/**
 * ComplectationSearch represents the model behind the search form about `app\models\Complectation`.
 */
class ComplectationSearch extends Complectation
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'frame_id', 'created_at', 'updated_at'], 'integer'],
            [['complectation', 'engine', 'engine_title', 'period', 'body', 'body_title', 'grade', 'grade_title', 'transm', 'transm_title'], 'safe'],
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
        $query = Complectation::find();

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
            'frame_id' => $this->frame_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'complectation', $this->complectation])
            ->andFilterWhere(['like', 'engine', $this->engine])
            ->andFilterWhere(['like', 'engine_title', $this->engine_title])
            ->andFilterWhere(['like', 'period', $this->period])
            ->andFilterWhere(['like', 'body', $this->body])
            ->andFilterWhere(['like', 'body_title', $this->body_title])
            ->andFilterWhere(['like', 'grade', $this->grade])
            ->andFilterWhere(['like', 'grade_title', $this->grade_title])
            ->andFilterWhere(['like', 'transm', $this->transm])
            ->andFilterWhere(['like', 'transm_title', $this->transm_title]);

        return $dataProvider;
    }
}

<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Questions;

/**
 * QuestionsSearch represents the model behind the search form of `app\models\Questions`.
 */
class QuestionsSearch extends Questions
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'tests_names_id', 'answer_option'], 'integer'],
            [['option_A', 'option_B', 'option_C', 'option_D'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Questions::find();

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
            'tests_names_id' => $this->tests_names_id,
            'answer_option' => $this->answer_option,
        ]);

        $query->andFilterWhere(['like', 'option_A', $this->option_A])
            ->andFilterWhere(['like', 'option_B', $this->option_B])
            ->andFilterWhere(['like', 'option_C', $this->option_C])
            ->andFilterWhere(['like', 'option_D', $this->option_D]);

        return $dataProvider;
    }
}

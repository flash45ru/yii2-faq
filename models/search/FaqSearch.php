<?php

namespace usesgraphcrt\faq\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use usesgraphcrt\faq\models\Faq;

/**
 * FaqSearch represents the model behind the search form about `usesgraphcrt\faq\models\Faq`.
 */
class FaqSearch extends Faq
{

    public function rules()
    {
        return [
            [['id','category_id'], 'integer'],
            [['title', 'text'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Faq::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'category_id' => $this->category_id,
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'text', $this->text]);

        return $dataProvider;
    }
}

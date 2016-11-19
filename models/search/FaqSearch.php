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
            [['faq_id','faq_category_id'], 'integer'],
            [['faq_title', 'faq_text'], 'safe'],
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
            'faq_category_id' => $this->faq_category_id,
            'faq_id' => $this->faq_id,
        ]);

        $query->andFilterWhere(['like', 'faq_title', $this->faq_title])
            ->andFilterWhere(['like', 'faq_text', $this->faq_text]);

        return $dataProvider;
    }
}

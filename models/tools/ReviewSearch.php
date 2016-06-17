<?php
namespace pistol88\review\models\tools;

use yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use pistol88\review\models\Review;

class ReviewSearch extends Review
{
    public function rules()
    {
        return [
            [['id', 'user_id', 'item_id', 'vote'], 'integer'],
            [['text', 'pluses', 'minuses', 'active', 'date'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Review::find()->orderBy('date DESC, id DESC');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'item_id' => $this->item_id,
            'active' => $this->active,
            'vote' => $this->vote,
        ]);

        $query->andFilterWhere(['like', 'text', $this->text])
                ->andFilterWhere(['like', 'pluses', $this->pluses])
                ->andFilterWhere(['like', 'minuses', $this->minuses])
                ->andFilterWhere(['like', 'date', $this->date]);

        return $dataProvider;
    }
}

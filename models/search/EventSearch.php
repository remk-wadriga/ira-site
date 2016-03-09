<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 09.03.2016
 * Time: 15:58
 */

namespace models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use models\Event;

/**
 * EventSearch represents the model behind the search form about `models\Event`.
 */
class EventSearch extends Event
{
    public function rules()
    {
        return [

        ];
    }

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
        $query = Event::find();

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
            'owner_id' => $this->owner_id,
            'members_count' => $this->members_count,
            'price' => $this->price,
            'profit' => $this->profit,
            'cost' => $this->cost,
            'date_start' => $this->date_start,
            'date_end' => $this->date_end,
            'in_main_slider' => $this->in_main_slider,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'owner_name', $this->owner_name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
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
    public $searchText;
    public $filterType;
    public $pageSize = 20;

    public function rules()
    {
        return [
            [['searchText'], 'string', 'max' => 126],
            ['filterType', 'in', 'range' => self::$_types],
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
        $query = Event::find()
            ->with(['mainImage']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC],
            ],
            'pagination' => [
                'pageSize' => $this->pageSize,
            ],
        ]);

        $this->load($params);

        if (!$this->filterType) {
            $this->filterType = null;
        }

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $query->andFilterWhere([
            'type' => $this->filterType,
        ]);

        $query->andFilterWhere(['like', 'name', $this->searchText]);

        return $dataProvider;
    }
}
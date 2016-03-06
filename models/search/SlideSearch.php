<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 06.03.2016
 * Time: 2:18
 */

namespace models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use models\Slide;

/**
 * SlideSearch represents the model behind the search form about `models\Slide`.
 */
class SlideSearch extends Slide
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
        $query = Slide::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'text', $this->text])
            ->andFilterWhere(['like', 'link_url', $this->link_url])
            ->andFilterWhere(['like', 'link_text', $this->link_text])
            ->andFilterWhere(['like', 'link_title', $this->link_title])
            ->andFilterWhere(['like', 'img_url', $this->img_url])
            ->andFilterWhere(['like', 'img_file', $this->img_file])
            ->andFilterWhere(['like', 'img_alt', $this->img_alt])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
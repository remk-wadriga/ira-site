<?php

namespace models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use models\MailDelivery;

/**
 * MailDeliverySearch represents the model behind the search form about `models\MailDelivery`.
 */
class MailDeliverySearch extends MailDelivery
{
    public function rules()
    {
        return [
            [['id', 'authorID'], 'integer'],
            [['name', 'title', 'message', 'dateCreate', 'dateSend', 'status'], 'safe'],
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
        $query = MailDelivery::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'author_id' => $this->authorID,
            'date_create' => $this->dateCreate,
            'date_send' => $this->dateSend,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'message', $this->message])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}

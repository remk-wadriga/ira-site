<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 14.03.2016
 * Time: 1:22
 */

namespace models\search;

use Yii;
use yii\base\Model;
use models\UserClick;
use yii\data\ActiveDataProvider;
use models\User;
use yii\db\Query;

/**
 * UserSearch represents the model behind the search form about `models\User`.
 */
class UserSearch extends User
{
    /**
     * @var \abstracts\ModelAbstract
     */
    public $userClickModel;
    public $userClickType;

    public function rules()
    {
        return [
            [['userClickType'], 'safe'],
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
        $query = User::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC],
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
        ]);

        $query->andFilterWhere(['like', 'email', $this->email]);

        if ($clickModel = $this->userClickModel) {
            $clickCommand = (new Query())
                ->select('user_id')
                ->from(UserClick::tableName())
                ->where([
                    'entity_class' => $clickModel::className(),
                    'entity_id' => $clickModel->getID(),
                    'type' => $this->userClickType,
                ])
                ->createCommand();

            $query
                ->andWhere("id IN({$clickCommand->sql})")
                ->addParams($clickCommand->params);
        }

        return $dataProvider;
    }
}
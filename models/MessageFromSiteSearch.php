<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MessageFromSite;

/**
 * MessageFromSiteSearch represents the model behind the search form of `app\models\MessageFromSite`.
 */
class MessageFromSiteSearch extends MessageFromSite
{

    /**
     * @var 
     */
    public $search;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'updated_at'], 'integer'],
            [['search'], 'trim'],
            [['title', 'name', 'phone', 'email', 'message', 'page'], 'safe'],
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
        $query = MessageFromSite::find();

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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere([
            'or',
            ['like', 'email', $this->search],
            ['like', 'name', $this->search],
            ['like', 'title', $this->search],
            ['like', 'phone', str_replace([' ', '(', ')', '+', '-'], '', $this->search)],
            ['like', 'message', $this->search]
        ]);

        return $dataProvider;
    }
}

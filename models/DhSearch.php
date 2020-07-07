<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Dh;

/**
 * DhSearch represents the model behind the search form of `app\models\Dh`.
 */
class DhSearch extends Dh
{
    /**
     * @var string
     */
    public $search;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'port', 'created_at', 'updated_at'], 'integer'],
            [['search'], 'trim'],
            [['name', 'host', 'comment', 'login_ftp', 'password_ftp', 'login_panel', 'password_panel'], 'safe'],
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
        $query = Dh::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> [
                'attributes' => ['name'],
                'defaultOrder' => ['name' => SORT_ASC]
            ]
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
            ['like', 'name', $this->search],
            ['like', 'host', $this->search],
            ['like', 'login_ftp', $this->search],
            ['like', 'password_ftp', $this->search],
            ['like', 'login_panel', $this->search],
            ['like', 'password_panel', $this->search],
            ['like', 'comment', $this->search]
        ]);

        return $dataProvider;
    }
}

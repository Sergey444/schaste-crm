<?php

namespace app\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

use app\models\Customer;

/**
 * CustomerSearch represents the model behind the search form of `app\models\Customer`.
 */
class CustomerSearch extends Customer
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
            [['id', 'created_at', 'updated_at'], 'integer'],
            [['search'], 'trim'],
            [['child_name', 'parents_name', 'phone', 'email', 'comment', 'truncateComment', 'birthday', 'search'], 'safe'],
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
        // $query = Customer::find();
        $query = Customer::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'attributes' => ['child_name', 'parents_name', 'email', 'birthday', 'phone', 'comment'],
                'defaultOrder'=>['child_name' => SORT_ASC]
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'or',
            ['like', 'email', $this->search],
            ['like', 'child_name', $this->search],
            ['like', 'parents_name', $this->search],
            ['like', 'phone', str_replace([' ', '(', ')', '+', '-'], '', $this->search)],
            ['like', 'comment', $this->search]
        ]);

        return $dataProvider;
    }
}

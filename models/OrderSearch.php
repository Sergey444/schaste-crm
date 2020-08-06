<?php

namespace app\models;

use Yii;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Order;

/**
 * OrderSearch represents the model behind the search form of `app\models\Order`.
 */
class OrderSearch extends Order
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
            [['id', 'count', 'unit_price', 'sum', 'status', 'date_start', 'date_end', 'program_id', 'customer_id', 'created_at', 'updated_at'], 'integer'],
            [['search'], 'trim'],
            [['name'], 'string'],
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
        $query = Order::find()->joinWith( ['customer', 'program', 'teacher', 'payment_in'] );

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> [
                'attributes' => ['name', 'customer.child_name', 'payment_in.date_of_payment', 'count', 'unit_price', 'sum', 'status', 'date_start', 'date_end', 'program_id', 'customer_id', 'created_at', 'updated_at'],
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                    'payment_in.date_of_payment' => SORT_DESC,
                ]
            ],
            'pagination' => [
                'pageSize' => 9,
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
            ['like', 'order.name', $this->search],
            ['like', 'customer.child_name', $this->search],
            ['like', 'program.name', $this->search],
        ]);

        return $dataProvider;
    }
}

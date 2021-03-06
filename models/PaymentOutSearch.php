<?php

namespace app\models;

use Yii;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PaymentOut;

/**
 * PaymentOutSearch represents the model behind the search form of `app\models\PaymentOut`.
 */
class PaymentOutSearch extends PaymentOut
{
    /**
     * @var
     */
    public $total;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id','sum', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'safe'],
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
        $arFilter = $this->getTime($params);
        
        $query = PaymentOut::find()->where( $arFilter )->joinWith(['profile']);
        // add conditions that should always apply here
        $this->total = $query->sum('sum') ?? 0;

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> [
                'attributes' => ['name','sum', 'date_of_payment', 'salary', 'type_of_pay', 'profile.surname'],
                'defaultOrder' => ['date_of_payment' => SORT_DESC]
            ],
            'pagination' => [
                'pageSize' => 10,
            ],
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
            'name' => $this->name,
            'sum' => $this->sum,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'sum', $this->sum]);

        return $dataProvider;
    }

    /**
     * Switch GET params time by month 
     * @param array $params
     * @return array
     */
    private function getTime($params) {
        switch ($params['time']) {
            case 'all-time':
                return [];
            case 'last-month':
                return ['and', 'date_of_payment>='.mktime(0,0,0, date('m') - 1, 1, date('Y')), 'date_of_payment<='.mktime(0,0,0, date('m'), 1, date('Y'))];
            default:
                return ['>=','date_of_payment', mktime(0,0,0, date('m'), 1, date('Y'))];
        }
    }
}

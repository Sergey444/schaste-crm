<?php

namespace app\models;

use Yii;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PaymentIn;

/**
 * PaymentInSearch represents the model behind the search form of `app\models\PaymentIn`.
 */
class PaymentInSearch extends PaymentIn
{

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
        
        $query = PaymentIn::find()->joinWith('customer')->where($arFilter); 
        // add conditions that should always apply here
        $this->total = $query->sum('sum') ?? 0;

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> [
                'attributes' => ['name', 'date_of_payment', 'sum', 'customer.child_name', 'type_of_pay'],
                'defaultOrder' => [
                    'date_of_payment' => SORT_DESC,
                ]
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

<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Profile;

/**
 * ProfileSearch represents the model behind the search form of `app\models\Profile`.
 */
class ProfileSearch extends Profile
{
    /** 
     * @var string
     */
    public $search;

    /**
     * {@inheritdoc}
     */
    public function attributes()
    {
        return array_merge( parent::attributes(), ['username'] );
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'date_of_birthday', 'position_id', 'phone', 'created_at', 'updated_at'], 'integer'],
            [['search'], 'trim'],
            [['surname', 'name', 'secondname', 'username', 'search'], 'safe'],
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
        $query = Profile::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['attributes' => ['username', 'color', 'position_id', 'position.name', 'name', 'secondname', 'surname', 'date_of_birthday', 'user_id','id','phone','created_at','updated_at']]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->joinWith( ['user', 'position'] );

        $query->andFilterWhere([
            'or',
            ['like', 'surname', $this->search],
            ['like', 'name', $this->search],
            ['like', 'phone', $this->search]
        ]);

        return $dataProvider;
    }
}

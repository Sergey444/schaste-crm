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
            [['id', 'user_id', 'date_of_birthday', 'phone', 'created_at', 'updated_at'], 'integer'],
            [['surname', 'name', 'secondname', 'username'], 'safe'],
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

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' =>  ['attributes' => ['username', 'name', 'secondname', 'surname', 'date_of_birthday', 'user_id','id','phone','created_at','updated_at',]]
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
            'user_id' => $this->user_id,
            'date_of_birthday' => $this->date_of_birthday,
            'phone' => $this->phone,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->joinWith( ['user'] );

        $query->andFilterWhere([
            'or',
            ['like', 'surname', $this->name],
            ['like', 'name', $this->name],
            ['like', 'phone', $this->name]
        ]);
        // ->andFilterWhere(['like', 'name', $this->name])
        // ->andFilterWhere(['like', 'username', $this->username])
        // ->andFilterWhere(['like', 'secondname', $this->secondname]);
            
        // $query->andFilterWhere(['like', 'surname', $this->name])
        //     ->andFilterWhere(['like', 'name', $this->name])
        //     ->andFilterWhere(['like', 'username', $this->username])
        //     ->andFilterWhere(['like', 'secondname', $this->secondname]);

        return $dataProvider;
    }
}

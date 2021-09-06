<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Guru;

/**
 * CariGuru represents the model behind the search form about `backend\models\Guru`.
 */
class CariGuru extends Guru
{
    public $pencarian;

    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['nuptk', 'nama', 'tempat_lahir', 'alamat', 'telepon', 'pencarian'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Guru::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['or',
            ['like', 'nuptk', $this->pencarian],
            ['like', 'nama', $this->pencarian],
            ['like', 'tempat_lahir', $this->pencarian],
        ]);

        return $dataProvider;
    }
}

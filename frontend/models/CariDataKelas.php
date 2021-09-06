<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Kelas;

/**
 * CariDataKelas represents the model behind the search form about `frontend\models\Kelas`.
 */
class CariDataKelas extends Kelas
{
    public $wali_kelas;

    public function rules()
    {
        return [
            [['id', 'guru_id'], 'integer'],
            [['kelas','wali_kelas'], 'safe'],
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
        $query = Kelas::find();

        $query->joinWith('guru');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['wali_kelas'] = [
            'asc'=>['guru.nama'=>SORT_ASC],
            'desc'=>['guru.nama'=>SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'guru_id' => $this->guru_id,
        ]);

        $query->andFilterWhere(['like', 'kelas', $this->kelas])
            ->andFilterWhere(['like', 'guru.nama', $this->wali_kelas]);

        return $dataProvider;
    }
}

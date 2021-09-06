<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\DetailKelas;

/**
 * CariDetailKelas represents the model behind the search form about `backend\models\DetailKelas`.
 */
class CariDetailKelas extends DetailKelas
{

    public $nisn_siswa;
    public $nama_siswa;

    public function rules()
    {
        return [
            [['id', 'kelas_id', 'siswa_id'], 'integer'],
            [['nisn_siswa','nama_siswa'],'safe'],
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
        $query = DetailKelas::find();

        $query->joinWith('siswa');
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['nisn_siswa'] = [
            'asc'=>['siswa.nisn'=> SORT_ASC],
            'desc'=>['siswa.nisn'=> SORT_DESC],
        ];
        $dataProvider->sort->attributes['nama_siswa'] = [
            'asc'=>['siswa.nama'=> SORT_ASC],
            'desc'=>['siswa.nama'=> SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'kelas_id' => $this->kelas_id,
        ]);

        $query->andFilterWhere(['like', 'siswa.nisn', $this->nisn_siswa])
            ->andFilterWhere(['like', 'siswa.nama', $this->nama_siswa]);

        return $dataProvider;
    }
}

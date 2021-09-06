<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\JadwalPelajaran;

/**
 * CariJadwalPelajaran represents the model behind the search form about `backend\models\JadwalPelajaran`.
 */
class CariJadwalPelajaran extends JadwalPelajaran
{
    public $mata_pelajaran;
    public $guru_pengajar;

    public function rules()
    {
        return [
            [['id', 'kelas_id', 'mata_pelajaran_id', 'guru_id'], 'integer'],
            [['hari', 'jam_mulai', 'jam_selesai', 'mata_pelajaran', 'guru_pengajar'], 'safe'],
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
        $query = JadwalPelajaran::find();

        $query->joinWith([
                'mataPelajaran'=> function ($q) {
                                        $q->from('mata_pelajaran mapel');
                                    },
                'guru'
        ]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['mata_pelajaran'] = [
            'asc'=>['mapel.mata_pelajaran'=> SORT_ASC],
            'desc'=>['mapel.mata_pelajaran'=> SORT_DESC],
        ];
        $dataProvider->sort->attributes['guru_pengajar'] = [
            'asc'=>['guru.nama'=> SORT_ASC],
            'desc'=>['guru.nama'=> SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'kelas_id' => $this->kelas_id,
            'mata_pelajaran_id' => $this->mata_pelajaran_id,
            'guru_id' => $this->guru_id,
            'jam_mulai' => $this->jam_mulai,
            'jam_selesai' => $this->jam_selesai,
        ]);

        $query->andFilterWhere(['like', 'hari', $this->hari])
            ->andFilterWhere(['like', 'mapel.mata_pelajaran', $this->mata_pelajaran])
            ->andFilterWhere(['like', 'guru.nama', $this->guru_pengajar]);

        return $dataProvider;
    }
}



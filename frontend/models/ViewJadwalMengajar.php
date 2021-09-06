<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "view_jadwal_mengajar".
 *
 * @property string $mata_pelajaran
 * @property integer $guru_id
 * @property integer $kelas_id
 * @property string $hari
 * @property string $jam_mulai
 * @property string $jam_selesai
 * @property string $nuptk
 * @property string $nama
 * @property string $kelas
 */
class ViewJadwalMengajar extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'view_jadwal_mengajar';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['guru_id', 'kelas_id'], 'integer'],
            [['mata_pelajaran', 'hari', 'kelas'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'mata_pelajaran' => 'Mata Pelajaran',
            'guru_id' => 'Guru ID',
            'kelas_id' => 'Kelas ID',
            'hari' => 'Hari',
            'jam_mulai' => 'Jam Mulai',
            'jam_selesai' => 'Jam Selesai',
            'nuptk' => 'Nuptk',
            'nama' => 'Nama',
            'kelas' => 'Kelas',
        ];
    }

    public function search($params)
    {
        $query = static::find()->where(['guru_id'=>Yii::$app->user->identity->id]);

        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
        ]);

        $query->andFilterWhere(['like', 'hari', $this->hari])
            ->andFilterWhere(['like', 'mata_pelajaran', $this->mata_pelajaran])
            ->andFilterWhere(['like', 'kelas', $this->kelas]);

        return $dataProvider;
    }
}


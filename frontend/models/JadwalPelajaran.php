<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "jadwal_pelajaran".
 *
 * @property integer $id
 * @property integer $kelas_id
 * @property integer $mata_pelajaran_id
 * @property integer $guru_id
 * @property string $hari
 * @property string $jam_mulai
 * @property string $jam_selesai
 *
 * @property Kelas $kelas
 * @property MataPelajaran $mataPelajaran
 * @property Guru $guru
 */
class JadwalPelajaran extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jadwal_pelajaran';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kelas_id', 'mata_pelajaran_id', 'guru_id', 'hari', 'jam_mulai', 'jam_selesai'], 'required'],
            [['kelas_id', 'mata_pelajaran_id', 'guru_id'], 'integer'],
            [['jam_mulai', 'jam_selesai'], 'safe'],
            [['hari'], 'string', 'max' => 20],
            [['kelas_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kelas::className(), 'targetAttribute' => ['kelas_id' => 'id']],
            [['mata_pelajaran_id'], 'exist', 'skipOnError' => true, 'targetClass' => MataPelajaran::className(), 'targetAttribute' => ['mata_pelajaran_id' => 'id']],
            [['guru_id'], 'exist', 'skipOnError' => true, 'targetClass' => Guru::className(), 'targetAttribute' => ['guru_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kelas_id' => 'Kelas ID',
            'mata_pelajaran_id' => 'Mata Pelajaran ID',
            'guru_id' => 'Guru ID',
            'hari' => 'Hari',
            'jam_mulai' => 'Jam Mulai',
            'jam_selesai' => 'Jam Selesai',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKelas()
    {
        return $this->hasOne(Kelas::className(), ['id' => 'kelas_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMataPelajaran()
    {
        return $this->hasOne(MataPelajaran::className(), ['id' => 'mata_pelajaran_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGuru()
    {
        return $this->hasOne(Guru::className(), ['id' => 'guru_id']);
    }
}

<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "kelas".
 *
 * @property integer $id
 * @property string $kelas
 * @property integer $guru_id
 *
 * @property DetailKelas[] $detailKelas
 * @property JadwalPelajaran[] $jadwalPelajarans
 * @property Guru $guru
 */
class Kelas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kelas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kelas', 'guru_id'], 'required'],
            [['guru_id'], 'integer'],
            [['kelas'], 'string', 'max' => 20],
            [['kelas'], 'unique'],
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
            'kelas' => 'Kelas',
            'guru_id' => 'Wali Kelas',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetailKelas()
    {
        return $this->hasMany(DetailKelas::className(), ['kelas_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJadwalPelajarans()
    {
        return $this->hasMany(JadwalPelajaran::className(), ['kelas_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGuru()
    {
        return $this->hasOne(Guru::className(), ['id' => 'guru_id']);
    }
}

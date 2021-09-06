<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "guru".
 *
 * @property integer $id
 * @property string $nuptk
 * @property string $nama
 * @property string $tempat_lahir
 * @property string $tanggal_lahir
 * @property string $alamat
 * @property string $telepon
 * @property string $foto
 * @property string $password
 *
 * @property JadwalPelajaran[] $jadwalPelajarans
 * @property Kelas[] $kelas
 */
class Guru extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'guru';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nuptk', 'nama', 'tempat_lahir', 'tanggal_lahir', 'password'], 'required'],
            [['tanggal_lahir'], 'safe'],
            [['nuptk'], 'string', 'max' => 12],
            [['nama', 'tempat_lahir'], 'string', 'max' => 50],
            [['alamat'], 'string', 'max' => 250],
            [['telepon'], 'string', 'max' => 15],
            [['foto'], 'string', 'max' => 30],
            [['password'], 'string', 'max' => 100],
            [['nuptk'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nuptk' => 'Nuptk',
            'nama' => 'Nama',
            'tempat_lahir' => 'Tempat Lahir',
            'tanggal_lahir' => 'Tanggal Lahir',
            'alamat' => 'Alamat',
            'telepon' => 'Telepon',
            'foto' => 'Foto',
            'password' => 'Password',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJadwalPelajarans()
    {
        return $this->hasMany(JadwalPelajaran::className(), ['guru_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKelas()
    {
        return $this->hasMany(Kelas::className(), ['guru_id' => 'id']);
    }

    public function getWaliKelas()
    {
        return $this->nuptk.' | '.$this->nama;
    }
}


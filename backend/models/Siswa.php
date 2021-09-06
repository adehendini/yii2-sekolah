<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "siswa".
 *
 * @property integer $id
 * @property string $nisn
 * @property string $nama
 *
 * @property DetailKelas[] $detailKelas
 */
class Siswa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'siswa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nisn', 'nama'], 'required'],
            [['nisn'], 'string', 'max' => 10],
            [['nama'], 'string', 'max' => 50],
            [['nisn'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nisn' => 'Nisn',
            'nama' => 'Nama',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetailKelas()
    {
        return $this->hasMany(DetailKelas::className(), ['siswa_id' => 'id']);
    }

    public function getDataSiswa()
    {
        return $this->nisn.' | '.$this->nama;
    }
}


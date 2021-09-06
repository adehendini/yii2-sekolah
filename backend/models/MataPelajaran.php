<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mata_pelajaran".
 *
 * @property integer $id
 * @property string $mata_pelajaran
 *
 * @property JadwalPelajaran[] $jadwalPelajarans
 */
class MataPelajaran extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mata_pelajaran';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mata_pelajaran'], 'required'],
            [['mata_pelajaran'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'mata_pelajaran' => 'Mata Pelajaran',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJadwalPelajarans()
    {
        return $this->hasMany(JadwalPelajaran::className(), ['mata_pelajaran_id' => 'id']);
    }
}

<?php

namespace frontend\models;

use Yii;
use yii\base\NotSupportedException;
use yii\base\Security;
use yii\web\IdentityInterface;

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
class Guru extends \yii\db\ActiveRecord implements IdentityInterface
{

    public static function tableName()
    {
        return 'guru';
    }

    public function rules()
    {
        return [
            [['nuptk', 'nama', 'tempat_lahir', 'tanggal_lahir', 'password'], 'required'],
            [['tanggal_lahir'], 'safe'],
            [['nuptk'], 'string', 'max' => 12],
            [['nama', 'tempat_lahir'], 'string', 'max' => 50],
            [['alamat'], 'string', 'max' => 250],
            [['telepon'], 'string', 'max' => 15],
            //[['foto'], 'string', 'max' => 30],
            [['foto'],'file','extensions'=>'jpg, jpeg, png, gif'],
            [['password'], 'string', 'max' => 100],
            [['nuptk'], 'unique'],
        ];
    }

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

    public static function namaGuru()
    {
        $guru = static::find()->where([
                'id'=>Yii::$app->user->identity->id
            ])->one();
        return $guru->nama;
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findByUsername($username)
    {
        return static::findOne(['nuptk'=>$username]);
    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function validatePassword($password)
    {
        return $this->password === sha1($password);
    }

    public function setPassword($password)
    {
        $this->password = sha1($password);
    }
    
    public static function findIdentityByAccessToken($token, $type = null){}

    public function getAuthKey(){}

    public function validateAuthKey($authKey){}

    public static function getImageFile() 
    {
        $user = Guru::findOne(['id'=>Yii::$app->user->identity->id]);
        return isset($user->foto) ? Yii::$app->basePath . '/uploads/' . $user->foto : null;
    }

    public static function getImageUrl() 
    {
        $user = Guru::findOne(['id'=>Yii::$app->user->identity->id]);
        $foto = isset($user->foto) ? $user->foto : 'default_foto.png';
        return Yii::$app->urlManager->baseUrl . '/frontend/uploads/' . $foto;
    }

}



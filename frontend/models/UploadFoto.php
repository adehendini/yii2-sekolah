<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use frontend\models\Guru;

class UploadFoto extends Guru
{
    public $image;

	public function rules()
    {
        return [
            [['image'], 'safe'],
            [['image'],'file','extensions'=>'jpg, jpeg, png, gif'],
        ];
    }
    
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
<?php 
 namespace backend\models;

 use Yii;
 use yii\base\Model;
 use backend\models\Admin;

 class UbahPassword extends Model
 {
 	public $old_password;
 	public $new_password;
 	public $repeat_password;

 	public function rules()
 	{
 		return [
 			[['old_password','new_password','repeat_password'],'required'],
 			['old_password','findPassword'],
 			['repeat_password','compare','compareAttribute'=>'new_password',
 				'message'=>'Konfirmasi Password Harus sama dengan "Password Baru"'],
            [['old_password','new_password'], 'string', 'max' => 50,'min'=>6],
 		];
 	}

 	public function attributeLabels()
 	{
 		return [
 			'old_password'=>'Password Lama',
 			'new_password'=>'Password Baru',
 			'repeat_password'=>'Konfirmasi Password',
 		];
 	}

 	public function findPassword($attribute, $params)
 	{
 		$admin = Admin::find()->where([
 				'id'=>Yii::$app->user->identity->id
 			])->one();
 		if($admin->password!=sha1($this->old_password))
 		{
 			$this->addError($attribute,'Password Lama Salah.');
 		}
 	}

 	public function ubahPassword()
 	{
 		$admin = Admin::find()->where([
 				'id'=>Yii::$app->user->identity->id
 			])->one();

 		$admin->password = sha1($this->new_password);
 		$admin->save();
 	}
 }


 
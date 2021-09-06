<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use frontend\models\Guru;

class LoginGuru extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_guru;

    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) 
        {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) 
            {
                $this->addError($attribute, 
                    'Username atau Password Salah.');
            }
        }
    }

    public function login()
    {
        if ($this->validate()) 
        {
            return Yii::$app->user->login($this->getUser(), 
                $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
    }

    protected function getUser()
    {
        if ($this->_guru === null) {
            $this->_guru = Guru::findByUsername($this->username);
        }
        return $this->_guru;
    }
}


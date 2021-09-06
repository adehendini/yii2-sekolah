<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use backend\models\Admin;

class LoginAdmin extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_admin;

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
        if ($this->_admin === null) {
            $this->_admin = Admin::findByUsername($this->username);
        }
        return $this->_admin;
    }
}


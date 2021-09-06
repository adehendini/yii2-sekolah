<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use backend\models\LoginAdmin;
use yii\filters\VerbFilter;
use backend\models\Admin;
use backend\models\UbahPassword;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'ubah-username', 'ubah-password'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'LoginLayout';
        $model = new LoginAdmin();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionUbahUsername()
    {
        $model = Admin::findOne(Yii::$app->user->identity->id);

        if($model->load(Yii::$app->request->post()) && $model->validate())
        {
            if($model->save())
            {
                Yii::$app->getSession()->setFlash('success','Username Berhasil Diubah');   
            }
        }
        return $this->render('ubah_username',[
                'model'=>$model,
            ]);
    }

    public function actionUbahPassword()
    {
        $model = new UbahPassword();
        
        if($model->load(Yii::$app->request->post()))
        {
            if($model->validate())
            {
                $model->ubahPassword();
                Yii::$app->getSession()->setFlash('success','Password Berhasil Diubah');
                return $this->redirect(['ubah-password']);
            }
        }
            return $this->render('ubah_password',[
                    'model'=>$model,
                ]);
        
    }

}

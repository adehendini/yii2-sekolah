<?php
namespace frontend\controllers;

use Yii;
use frontend\models\LoginGuru;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\UbahPassword;

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
                'only' => ['index', 'logout', 'error', 'biodata', 'ubah-password'],
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['index', 'logout', 'biodata', 'ubah-password'],
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionBiodata()
    {
        $model = \frontend\models\Guru::findOne(['id'=>Yii::$app->user->identity->id]);
        $fotoLama = $model->foto;

        $upload = \frontend\models\UploadFoto::findOne(['id'=>Yii::$app->user->identity->id]);
        if ($upload->load(Yii::$app->request->post())) 
        {
            $image = \yii\web\UploadedFile::getInstance($upload, 'image');
            
            $ext = $image->extension;

            $model->foto = trim($model->nuptk).".{$ext}";

            $path = Yii::$app->basePath . '/uploads/' . $model->foto;

            if($model->save())
            {
                $image->saveAs($path);
                return $this->redirect(['biodata']);
            }
            
        } else {
            return $this->render('biodata', [
                'model' => $model,
                'upload'=> $upload,
            ]);
        }
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

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout='LoginLayout';
        $model = new LoginGuru();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}

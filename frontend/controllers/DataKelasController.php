<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Kelas;
use frontend\models\CariDataKelas;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class DataKelasController extends Controller
{
    public function behaviors()
    {
        return [
            'access'=>[
                'class'=>AccessControl::className(),
                'only'=>['index','view'],
                'rules'=>[
                    [
                        'allow'=>true,
                        'actions'=>['index','view'],
                        'roles'=>['@'],
                    ]
                ]
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new CariDataKelas();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $model = \frontend\models\DetailKelas::find(['kelas_id'=>$id])->all();
        $kelas = $this->findModel($id);
        return $this->render('view', [
            'model' => $model,
            'kelas'=> $kelas,
        ]);
    }

    protected function findModel($id)
    {
        if (($model = Kelas::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

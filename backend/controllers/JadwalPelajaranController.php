<?php

namespace backend\controllers;

use Yii;
use backend\models\JadwalPelajaran;
use backend\models\CariJadwalPelajaran;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Kelas;
use backend\models\CariKelas;
use yii\filters\AccessControl;

/**
 * JadwalPelajaranController implements the CRUD actions for JadwalPelajaran model.
 */
class JadwalPelajaranController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','create','update','delete'],
                'rules' => [
                    [
                        'actions' => ['index', 'create','update','delete','view'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all JadwalPelajaran models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CariKelas();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single JadwalPelajaran model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $searchModel = new CariJadwalPelajaran();
        $searchModel->kelas_id = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $kelas = Kelas::findOne($id);

        return $this->render('view', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'kelas'=>$kelas,
        ]);
    }

    /**
     * Creates a new JadwalPelajaran model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new JadwalPelajaran();

        $kelas = Kelas::findOne($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->kelas_id=$id;
            $model->save();
            return $this->redirect(['view', 'id' => $id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'kelas'=> $kelas
            ]);
        }
    }

    /**
     * Updates an existing JadwalPelajaran model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $kelas = Kelas::findOne($model->kelas_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $kelas->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'kelas' => $kelas,
            ]);
        }
    }

    /**
     * Deletes an existing JadwalPelajaran model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the JadwalPelajaran model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return JadwalPelajaran the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = JadwalPelajaran::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

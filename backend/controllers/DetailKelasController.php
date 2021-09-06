<?php

namespace backend\controllers;

use Yii;
use backend\models\DetailKelas;
use backend\models\CariDetailKelas;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Kelas;
use yii\filters\AccessControl;

/**
 * DetailKelasController implements the CRUD actions for DetailKelas model.
 */
class DetailKelasController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','create','delete', 'export'],
                'rules' => [
                    [
                        'actions' => ['index', 'create','delete', 'export'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'export' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex($id)
    {
        $searchModel = new CariDetailKelas();
        $searchModel->kelas_id = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $kelas = Kelas::findOne($id);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'kelas'=> $kelas,
        ]);
    }

    public function actionCreate($id)
    {
        $model = new DetailKelas();

        $kelas = Kelas::findOne($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->kelas_id=$id;
            $model->save();
            return $this->redirect(['index','id'=>$id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'kelas' => $kelas,
            ]);
        }
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionExport($id)
    {
        $phpexcel = new \PHPExcel();
        $siswa = DetailKelas::find()->where(['kelas_id'=>$id])->all();
        $kelas = Kelas::findOne($id);

        $this->render('excel', [
            'phpexcel'=>$phpexcel,
            'siswa' => $siswa,
            'kelas'=> $kelas,
        ]);
        $filename = 'Data Kelas '.$kelas->kelas.'.xlsx';
        $type = 'Excel2007';

        ob_end_clean();
        ob_start();

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($phpexcel, $type);
        $objWriter->save('php://output');
    }

    protected function findModel($id)
    {
        if (($model = DetailKelas::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

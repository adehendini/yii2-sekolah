<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CariDetailKelas */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kelas '.$kelas->kelas;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="detail-kelas-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Masukkan Siswa', ['create','id'=>$kelas->id] , ['class' => 'btn btn-success']) ?>
        &nbsp;
        <?= Html::a('Export Excel', ['export','id'=>$kelas->id], ['data-method' => 'post', 'class'=>'btn btn-primary']); ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
            [
                'attribute'=>'nisn_siswa',
                'value'=>'siswa.nisn',
            ],
            [
                'attribute'=>'nama_siswa',
                'value'=>'siswa.nama',
            ],

            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{delete}',
            ],
        ],
    ]); ?>
</div>


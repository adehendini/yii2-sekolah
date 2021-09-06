<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CariKelas */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kelas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kelas-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Kelas', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'kelas',
            [
                'attribute'=>'wali_kelas',
                'value'=>function ($model)
                {
                    return $model->guru->nuptk.' | '.$model->guru->nama;
                },
            ],

            ['class' => 'yii\grid\ActionColumn',
                'buttons'=>[
                    'view'=>function ($url, $model)
                        {
                            return Html::a('<span class="glyphicon glyphicon-list-alt"></span>', 
                                ['detail-kelas/index','id'=>$model->id],['title'=>'view']);
                        }
                ]
            ],
        ],
    ]); ?>
</div>


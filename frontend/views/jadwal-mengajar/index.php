<?php
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Jadwal Mengajar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jadwal-mengajar-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Export PDF', ['export'], ['class'=>'btn btn-primary','target'=>'_blank']); ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'hari',
            'mata_pelajaran',
            [
            	'attribute'=>'kelas',
            	'format'=>'raw',
            	'value'=>function($model){
            		return Html::a($model->kelas, ['data-kelas/view','id'=>$model->kelas_id]);
            	}
            ],
            [
            	'attribute'=>'jam_mulai',
            	'label'=>'Waktu',
            	'value'=>function($model){
            		return substr($model->jam_mulai,0,5).' - '.substr($model->jam_selesai,0,5);
            	}
            ]
        ],
    ]); ?>
</div>



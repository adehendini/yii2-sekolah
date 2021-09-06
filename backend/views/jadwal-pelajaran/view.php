<?php
use yii\helpers\Html;
use yii\grid\GridView;
$this->title = 'Jadwal Pelajaran Kelas '.$kelas->kelas;
?>
<div class="jadwal-pelajaran-view">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Tambah Jadwal Pelajaran', ['create','id'=>$kelas->id], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute'=>'mata_pelajaran',
                'value'=>'mataPelajaran.mata_pelajaran',
            ],
            [
                'attribute'=>'guru_pengajar',
                'value'=>'guru.nama',
            ],
            'hari',
            'jam_mulai',
            'jam_selesai',
            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{update} {delete}'
            ],
        ],
    ]); ?> 
</div>


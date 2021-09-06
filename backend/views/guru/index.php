<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\export\ExportMenu;
use packageku\widgets\FormPencarian;

$this->title = Yii::t('app', 'Guru');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="guru-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Tambah Guru'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= FormPencarian::widget([
        'model'=>$searchModel,
        'action'=>['index'],
    ]); ?>
    <br><br>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],       
            'nuptk',
            'nama',
            'tempat_lahir',
            'tanggal_lahir',
            // 'alamat',
            // 'telepon',
            // 'foto',
            // 'password',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

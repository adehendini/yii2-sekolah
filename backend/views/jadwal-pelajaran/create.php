<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\JadwalPelajaran */

$this->title = 'Masukkan Jadwal Pelajaran Kelas '.$kelas->kelas;
?>
<div class="jadwal-pelajaran-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\JadwalPelajaran */

$this->title = 'Ubah Jadwal Pelajaran Kelas ' . $kelas->kelas;
?>
<div class="jadwal-pelajaran-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

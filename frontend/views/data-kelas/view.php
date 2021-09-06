<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'Siswa Kelas '.$kelas->kelas;
?>
<div class="kelas-view">
    <h1><?= Html::encode($this->title) ?></h1>
    <h4>Wali Kelas <?= $kelas->guru->nama ?></h4>
    <table class="table table-stripped table-condensed table-bordered">
        <tr>
            <th>No</th>
            <th>NISN</th>
            <th>Nama</th>
        </tr>
        <?php $no=1; ?>
        <?php foreach ($model as $siswa): ?>
        <tr>
            <td><?= $no; ?></td>
            <td><?= $siswa->siswa->nisn?></td>
            <td><?= $siswa->siswa->nama ?></td>
        </tr>
        <?php $no++; ?>
        <?php endforeach; ?>
    </table>
    <?= Html::a('Data Kelas', ['index'], ['class' => 'btn btn-default']); ?>
</div>


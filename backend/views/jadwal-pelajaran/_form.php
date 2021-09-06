<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use kartik\widgets\TimePicker;
use yii\helpers\ArrayHelper;
use backend\models\MataPelajaran;
use backend\models\Guru;
use backend\models\JadwalPelajaran;

/* @var $this yii\web\View */
/* @var $model backend\models\JadwalPelajaran */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jadwal-pelajaran-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'mata_pelajaran_id')->widget(
        Select2::classname(),[
            'data' => ArrayHelper::map(MataPelajaran::find()->all(),'id','mata_pelajaran'),
            'options' => ['placeholder' => '--Pilih Mata Pelajaran--'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>

    <?= $form->field($model, 'guru_id')->widget(
        Select2::classname(),[
            'data' => ArrayHelper::map(Guru::find()->all(),'id','nama'),
            'options' => ['placeholder' => '--Pilih Guru Pengajar--'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>

    <?= $form->field($model, 'hari')->dropDownList(JadwalPelajaran::listHari(),['prompt'=>'--Pilih Hari--']) ?>

    <?= $form->field($model, 'jam_mulai')->widget(
        TimePicker::classname(),
        [
            'pluginOptions' => [
                'showSeconds' => false,
                'showMeridian' => false,
                'minuteStep' => 1,
            ]
        ]
    ); ?>

    <?= $form->field($model, 'jam_selesai')->widget(
        TimePicker::classname(),
        [
            'pluginOptions' => [
                'showSeconds' => false,
                'showMeridian' => false,
                'minuteStep' => 1,
            ]
        ]
    ); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
